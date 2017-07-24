<?php

namespace Trustalk;

class ClassPath {

    public static function getFirstNest($name){
        $name = ucfirst($name);
        $class_path = [
            'Account' => 'Trustalk\Rest\Api\Account\AccountList',
            'Connections' => 'Trustalk\Rest\Api\Connections\ConnectionsList',
            'Calls' => 'Trustalk\Rest\Api\Calls\CallsList',
            'Notifications' => 'Trustalk\Rest\Api\Notifications\NotificationsList',
            'Analytics' => 'Trustalk\Rest\Api\Analytics\AnalyticsList',
        ];
        return $class_path["{$name}"];
    }

    public static function getSecondNest($name){
        $name = ucfirst($name);
        $class_path = [
            'Response' => 'Trustalk\Rest\Api\Calls\Response\ResponseList',
            'Account' => 'Trustalk\Rest\Api\Account\Account',
            'Bills' => 'Trustalk\Rest\Api\Account\Bills',
            'Credit' => 'Trustalk\Rest\Api\Account\Credit',
            'PurchaseNumber' => 'Trustalk\Rest\Api\Account\PurchaseNumber',
            'ReleaseNumber' => 'Trustalk\Rest\Api\Account\ReleaseNumber',
            'PhoneNumbers' => 'Trustalk\Rest\Api\Account\PhoneNumbers',
            'Tracks' => 'Trustalk\Rest\Api\Connections\Tracks',
            'Logs' => 'Trustalk\Rest\Api\Calls\Logs',
            'Recordings' => 'Trustalk\Rest\Api\Calls\Recordings',
            'Emails' => 'Trustalk\Rest\Api\Notifications\Emails',
            'Events' => 'Trustalk\Rest\Api\Notifications\Events',
            'SpeechToText' => 'Trustalk\Rest\Api\Analytics\SpeechToText',
        ];
        return $class_path["{$name}"];
    }

    public static function getThirdNest($name){
        $name = ucfirst($name);
        $class_path = [
            'Actions' => 'Trustalk\Rest\Api\Calls\Response\Actions',
            'Expiration' => 'Trustalk\Rest\Api\Calls\Response\Expiration',
            'Before' => 'Trustalk\Rest\Api\Calls\Response\Before',
        ];
        return $class_path["{$name}"];
    }
}
