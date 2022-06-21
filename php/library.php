<?php

function filter_string_polyfill(string $string): string
{
    $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
    return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
}

function test_input($data)
{
    $data = trim($data);
    $data = filter_string_polyfill($data);
    return $data;
}

function isLocalHost()
{
    $whitelist = array('127.0.0.1', '::1');
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

function extractPath($url)
{
    $path = parse_url($url, PHP_URL_PATH);
    $parts = explode("/", $path);
    array_pop($parts);
    $justPath = implode("/", $parts) . "/";
    return $justPath;
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }
    return $ip;
}
