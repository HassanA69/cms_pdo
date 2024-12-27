<?php

// get base url
function base_url($path = '')
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];

    $baseUrl = $protocol . $host;
    return $baseUrl . '/' . ltrim($path, '/');
}


// base path
function base_path($path = '')
{
    $rootPath = dirname(__DIR__);
    return $rootPath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
}

// upload path
function upload_path($filename = '')
{
    return base_path('uploads' . DIRECTORY_SEPARATOR . $filename);
}

// upload url
function upload_url($filename = '')
{
    return base_path('uploads/' . ltrim($filename, DIRECTORY_SEPARATOR));
}

// assets url
function asset_url($path)
{
    return base_url('assets/') . ltrim($path, '/');
}

// redirect

function redirect($url)
{
    header('Location: ' . base_url($url));
    exit;
}
