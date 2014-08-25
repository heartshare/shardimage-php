<?php

include '../src/shardimage-php/API.php';
include '../src/shardimage-php/ShardImage.php';
include '../src/shardimage-php/Filter.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
use ShardImage\Filter;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $parameters = [];
        $filter = new Filter($api_key, $api_secret);
        $data = $filter->index($parameters);
        break;
    case 'store':
        $time = time();
        $filter = new Filter($api_key, $api_secret);
        $parameters = [
            'filter' => [
                'cloud_id' => 10,
                'name' => 'Sample ' . $time,
                'url_name' => $filter->stringToURL('Sample ' . $time),
                'data' => 'widen(200)_grayscale_invert',
            ]
        ];
        
        $data = $filter->store($parameters);
        break;
    case 'show':
        $parameters = [
            'filter_id' => 7,
        ];
        $filter = new Filter($api_key, $api_secret);
        $data = $filter->show($parameters);
        break;
    case 'update':
        $time = time();
        $filter = new Filter($api_key, $api_secret);
        $parameters = [
            'filter_id' => 7,
            'filter' => [
                'name' => 'Update Sample ' . $time,
                'url_name' => $filter->stringToURL('Update Sample ' . $time),
                'data' => 'widen(200)_grayscale_invert',
            ]
        ];
        $data = $filter->update($parameters);
        break;
    case 'delete':
        $parameters = ['filter_id' => 7];
        $filter = new Filter($api_key, $api_secret);
        $data = $filter->delete($parameters);
        break;
}

return $data;
