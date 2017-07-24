<?php

namespace Trustalk\Rest\Api\Account;

use Trustalk\Rest\Client;
use Trustalk\Http\CurlClient;

class PhoneNumbers extends Client
{
    protected $client;
    protected $curl;
    protected $uri = '/account/phone_numbers';
    /**
     * Construct the PhoneNumbers
     * @return Trustalk\Rest\Api\Account\PhoneNumbers
     */
    public function __construct(Client $client) {
        $this->curl = new CurlClient($client->credentials);
    }

    public function get($data = null) {
        return $this->curl->request(__FUNCTION__, $this->uri, $data, 60);
    }
}
