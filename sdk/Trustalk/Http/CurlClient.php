<?php

namespace Trustalk\Http;

use Trustalk\Http\Client as HttpClient;
use Trustalk\Rest\Client;
use Trustalk\Config;
use Trustalk\Exceptions\EnvironmentException;

class CurlClient implements HttpClient {

    const DEFAULT_TIMEOUT = 60;
    protected $credentials;
    protected $headers;

    public function __construct(array $credentials) {
        $this->credentials = $credentials;
        $this->headers = [
            "Accept" => "application/json",
            "Content-Type" => "application/json"
        ];
    }

    public function request($method, $url, $data = null, $timeout = null) {
        $options = $this->options($method, $url, $data, $timeout);
        try {

            if (!$curl = curl_init()) {
                throw new EnvironmentException('Unable to initialize cURL');
            }

            if (!curl_setopt_array($curl, $options)) {
                throw new EnvironmentException(curl_error($curl));
            }

            if (!$response = curl_exec($curl)) {
                throw new EnvironmentException(curl_error($curl));
            }

            $parts = explode("\r\n\r\n", $response, 3);
            list($head, $body) = ($parts[0] == 'HTTP/1.1 100 Continue')
                               ? array($parts[1], $parts[2])
                               : array($parts[0], $parts[1]);

            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $responseHeaders = array();
            $headerLines = explode("\r\n", $head);
            array_shift($headerLines);
            foreach ($headerLines as $line) {
                list($key, $value) = explode(':', $line, 2);
                $responseHeaders[$key] = $value;
            }

            curl_close($curl);

            if (isset($buffer) && is_resource($buffer)) {
                fclose($buffer);
            }

            return $body;
        } catch (\Exception $e) {
            if (isset($curl) && is_resource($curl)) {
                curl_close($curl);
            }

            if (isset($buffer) && is_resource($buffer)) {
                fclose($buffer);
            }

            throw $e;
        }
    }

    public function options($method, $url, $data = array(), $timeout = null) {

        $timeout = is_null($timeout)
            ? self::DEFAULT_TIMEOUT
            : $timeout;

        $options = array(
            CURLOPT_URL => Config::baseUrl().$url,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_INFILESIZE => -1,
            CURLOPT_HTTPHEADER => array(),
            CURLOPT_TIMEOUT => $timeout,
        );

        foreach ($this->headers as $key => $value) {
            $options[CURLOPT_HTTPHEADER][] = "$key: $value";
        }

        if ($this->credentials['username'] && $this->credentials['password']) {
            $options[CURLOPT_HTTPHEADER][] = 'x-api-key:' . $this->credentials['password'];
        }

        switch (strtolower(trim($method))) {
            case 'get':
                $body = $this->buildQuery($data);
                if ($body) {
                    $options[CURLOPT_URL] .= '?' . $body;
                }
                $options[CURLOPT_HTTPGET] = true;
                break;
            case 'post':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
                break;
            case 'put':
                $options[CURLOPT_PUT] = true;
                if ($data) {
                    if ($buffer = fopen('php://memory', 'w+')) {
                        $dataString = json_encode($data);
                        fwrite($buffer, $dataString);
                        fseek($buffer, 0);
                        $options[CURLOPT_INFILE] = $buffer;
                        $options[CURLOPT_INFILESIZE] = strlen($dataString);
                    } else {
                        throw new EnvironmentException('Unable to open a temporary file');
                    }
                }
                break;
            case 'head':
                $options[CURLOPT_NOBODY] = true;
                break;
            default:
                $options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
        }

        return $options;
    }

    public function buildQuery($params) {
        $parts = array();

        $params = $params ?: array();

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $parts[] = urlencode((string)$key) . '=' . urlencode((string)$item);
                }
            } else {
                $parts[] = urlencode((string)$key) . '=' . urlencode((string)$value);
            }
        }

        return implode('&', $parts);
    }
}
