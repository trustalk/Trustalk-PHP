<?php

namespace Trustalk;

class Config
{
    const MAJOR = 1;
    const MINOR = 0;
    const PATCH = 0;
    const BASE_URL = 'https://trustalk.io';
    const PREFIX = '/api';
    const VERSION = '/v1';

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }

    public static function baseUrl() {
        return self::BASE_URL.self::PREFIX.self::VERSION;
    }
}
