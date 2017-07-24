<?php

namespace Trustalk\Http;

interface Client
{
    public function request($method, $url, $data = array(), $timeout = null);
}
