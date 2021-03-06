<?php

namespace Trustalk\Rest\Api\Calls\Response;

use Trustalk\Rest\Client;
use Trustalk\Exceptions\TrustalkException;
use Trustalk\ClassPath;

class ResponseList extends Client
{
    /**
     * Construct the Account
     * @return Trustalk\Rest\Api\Calls\Response\Actions
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * Magic method for create instance of property like.
     */
    public function __get($name) {
        $className = ClassPath::getThirdNest($name);
        if (class_exists($className)) {
            return new $className($this->client);
        }
        throw new TrustalkException('Unknown domain ' . $name);
    }
}
