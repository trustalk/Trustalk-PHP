<?php

namespace Trustalk;

class Util
{
    public static function pathParamId($uri, $id) {
        return "{$uri}/{$id}";
    }
}
