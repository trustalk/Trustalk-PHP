<?php

namespace Trustalk\Rest\Api\Calls;

use Trustalk\Util;
use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class Recordings extends Client
{
    /**
     * メンバ変数
     * @var $client
     * @var $curl
     * @var $uri
     */
    protected $client;
    protected $curl;
    protected $uri = '/calls/recordings';

    /**
     * Construct the Account
     * @return Trustalk\Rest\Api\Calls\Recordings
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

    /**
     * DELETE
     * @return json
     */
    public function delete($rsid, $timeout = null) {
        $this->uri = Util::pathParamId($this->uri, $rsid);
        return $this->curl->request(__FUNCTION__, $this->uri, $data, $timeout);
    }

}
