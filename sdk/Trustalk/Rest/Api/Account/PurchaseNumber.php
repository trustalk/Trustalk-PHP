<?php

namespace Trustalk\Rest\Api\Account;

use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class PurchaseNumber extends Client
{
    protected $client;
    protected $curl;
    protected $uri = '/account/purchase_number';
    /**
     * Construct the PurchaseNumber
     * @return Trustalk\Rest\Api\Account\PurchaseNumber
     */
    public function __construct(Client $client) {
        $this->curl = new CurlClient($client->credentials);
    }

    public function post($data = null) {
        return $this->curl->request(__FUNCTION__, $this->uri, $data, 60);
    }
}
