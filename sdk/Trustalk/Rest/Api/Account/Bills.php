<?php

namespace Trustalk\Rest\Api\Account;

use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class Bills extends Client
{
    protected $client;
    protected $curl;
    protected $uri = '/account/bills';
    /**
     * Construct the Bills
     * @return Trustalk\Rest\Api\Account\Bills
     */
    public function __construct(Client $client) {
        $this->curl = new CurlClient($client->credentials);
    }

    public function get($data = null) {
        return $this->curl->request(__FUNCTION__, $this->uri, $data, 60);
    }
}
