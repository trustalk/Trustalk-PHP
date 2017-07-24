<?php

namespace Trustalk\Rest\Api\Connections;

use Trustalk\Util;
use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class Tracks extends Client
{
    /**
     * メンバ変数
     * @var $client
     * @var $curl
     * @var $uri
     */
    protected $client;
    protected $curl;
    protected $uri = '/connections/tracks';

    /**
     * Construct the Account
     * @return Trustalk\Rest\Api\Account\AccountList
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
     * POST
     * @return json
     */
    public function post($data = null, $timeout = null) {
        return $this->curl->request(__FUNCTION__, $this->uri, $data, $timeout);
    }

    /**
     * PUT
     * @return json
     */
    public function put($id, $data = null, $timeout = null) {
        $this->uri = Util::pathParamId($this->uri, $id);
        return $this->curl->request(__FUNCTION__, $this->uri, $data, $timeout);
    }

    /**
     * DELETE
     * @return json
     */
    public function delete($id, $timeout = null) {
        $this->uri = Util::pathParamId($this->uri, $id);
        return $this->curl->request(__FUNCTION__, $this->uri, $data, $timeout);
    }
}
