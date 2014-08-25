<?php

include '../src/shardimage-php/API.php';
include '../src/shardimage-php/ShardImage.php';
include '../src/shardimage-php/Cloud.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
use ShardImage\Cloud;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $parameters = [];
        $cloud = new Cloud($api_key, $api_secret);
        $data = $cloud->index($parameters);
        break;
    case 'store':
        $time = time();
        $cloud = new Cloud($api_key, $api_secret);
        $parameters = [
            'cloud' => [
                'name' => 'Sample ' . $time,
                'url_name' => $cloud->stringToURL('Sample ' . $time),
                'description' => 'sample description maximum 500 character',
                'enabled_domain_view' => 'example1.com,example2.com',
                'enabled_domain_upload' => 'example1.net,example15.org',
            ]
        ];
        $data = $cloud->store($parameters);
        break;
    case 'show':
        $parameters = [
            'cloud_id' => 10,
        ];
        $cloud = new Cloud($api_key, $api_secret);
        $data = $cloud->show($parameters);
        break;
    case 'update':
        $time = time();
        $cloud = new Cloud($api_key, $api_secret);
        $parameters = [
            'cloud_id' => 10,
            'cloud' => [
                'name' => 'Updated Sample ' . $time,
                'url_name' => $cloud->stringToURL('Update Sample ' . $time),
                'description' => 'sample description maximum 500 character',
                'enabled_domain_view' => 'updated.example1.com,updated.example2.com',
                'enabled_domain_upload' => 'updated.example1.net,updated.example15.org',
            ]
        ];
        $data = $cloud->update($parameters);
        break;
    case 'delete':
        $parameters = ['cloud_id' => 10];
        $cloud = new Cloud($api_key, $api_secret);
        $data = $cloud->delete($parameters);
        break;
}

return $data;
