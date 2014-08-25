<?php

include '../src/shardimage-php/API.php';
include '../src/shardimage-php/ShardImage.php';
include '../src/shardimage-php/Web.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
use ShardImage\Web;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $parameters = [];
        $web = new Web($api_key, $api_secret);
        $web->properties = [
            'frameborder' => 0,
        ];
        $data = $web->getFrame($parameters);
        break;

}
return $data;
