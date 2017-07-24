<?php

namespace Trustalk\Rest\Api\Calls;

use Trustalk\Util;
use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class Logs extends Client
{
    /**
     * メンバ変数
     * @var $client
     * @var $curl
     * @var $uri
     */
    protected $client;
    protected $curl;
    protected $uri = '/calls/logs';

    /**
     * Construct the Account
     * @return Trustalk\Rest\Api\Calls\Logs
     */
    public function __construct(Client $client) {
        $this->curl = new CurlClient($client->credentials);
    }

    /**
     * GET
     * @return json
     */
    public function get($data = null, $timeout = null) {
        return $this->curl->request(__FUNCTION__, $this->uri, $data, $timeout);
    }

}
