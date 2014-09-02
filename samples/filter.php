<?php

include '../src/ShardImage/API.php';
include '../src/ShardImage/ShardImage.php';
include '../src/ShardImage/Filter.php';

use ShardImage\Filter;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $parameters = array();
        $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $filter->index($parameters);
        break;
    case 'store':
        $time = time();
        $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $parameters = array(
            'filter' => array(
                'cloud_id' => 25,
                'name' => 'Sample ' . $time,
                'url_name' => $filter->stringToURL('Sample ' . $time),
                'data' => 'widen(200)_grayscale_invert',
            )
        );
        
        $data = $filter->store($parameters);
        break;
    case 'show':
        $parameters = array(
            'filter_id' => 17,
        );
        $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $filter->show($parameters);
        break;
    case 'update':
        $time = time();
        $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $parameters = array(
            'filter_id' => 17,
            'filter' => array(
                'name' => 'Update Sample ' . $time,
                'url_name' => $filter->stringToURL('Update Sample ' . $time),
                'data' => 'widen(200)_grayscale_invert',
            )
        );
        $data = $filter->update($parameters);
        break;
    case 'delete':
        $parameters = array('filter_id' => 17);
        $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $filter->delete($parameters);
        break;
}

return $data;
