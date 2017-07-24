<?php

namespace Trustalk\Rest\Api\Analytics;

use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class SpeechToText extends Client
{
    protected $client;
    protected $curl;
    protected $uri = '/analytics/speech_to_text';
    /**
     * Construct the SpeechToText
     * @return Trustalk\Rest\Api\Account\SpeechToText
     */
    public function __construct(Client $client) {
        $this->curl = new CurlClient($client->credentials);
    }

    public function get($data = null) {
        return $this->curl->request(__FUNCTION__, $this->uri, $data, 60);
    }
}
