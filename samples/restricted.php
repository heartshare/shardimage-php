<?php

include '../src/shardimage-php/API.php';
include '../src/shardimage-php/ShardImage.php';
include '../src/shardimage-php/Restricted.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
use ShardImage\Restricted;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'store':
        $time = time();
        $restricted = new Restricted($api_key, $api_secret);
        $parameters = [
            'restricted' => [
                'cloud_id' => 2,
                'url' => 'https://www.youtube.com/watch?v=vgfLFLRXSdI'
            ]
        ];

        $data = $restricted->store($parameters);
        break;
}

return $data;
