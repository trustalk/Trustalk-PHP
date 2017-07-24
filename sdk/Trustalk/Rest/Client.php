<?php

namespace Trustalk\Rest;

use Trustalk\Exceptions\TrustalkException;
use Trustalk\ClassPath;

/**
 * A client for accessing the Trustalk API.
 *
 * @property \Trustalk\Rest\Api\Account\Account account
 * @property \Trustalk\Rest\Api\Connections\Tracks connections
 * @property \Trustalk\Rest\Api\Calls\Response\Actions actions
 * @property \Trustalk\Rest\Api\Calls\Response\Expiration expiration
 * @property \Trustalk\Rest\Api\Calls\Response\Before before
 * @property \Trustalk\Rest\Api\Calls\Logs logs
 * @property \Trustalk\Rest\Api\Calls\Recordings recordings
 */
class Client
{
    protected $credentials;

    /**
     * Construct the client.
     */
    public function __construct($username = null, $password = null)
    {
        $this->credentials = [
            'username' => $username,
            'password' => $password
        ];
    }

    /**
     * Magic method for create instance of property like.
     */
    public function __get($name) {
        $className = ClassPath::getFirstNest($name);
        if (class_exists($className)) {
            return new $className($this);
        }
        throw new TrustalkException('Unknown domain ' . $name);
    }
}
