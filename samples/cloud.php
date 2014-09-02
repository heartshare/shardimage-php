<?php

include '../src/ShardImage/API.php';
include '../src/ShardImage/ShardImage.php';
include '../src/ShardImage/Cloud.php';

use ShardImage\Cloud;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $parameters = array();
        $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $cloud->index($parameters);
        break;
    case 'store':
        $time = time();
        $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $parameters = array(
            'cloud' => array(
                'name' => 'Sample ' . $time,
                'url_name' => $cloud->stringToURL('Sample ' . $time),
                'description' => 'sample description maximum 500 character',
                'enabled_domain_view' => 'example1.com,example2.com',
                'enabled_domain_upload' => 'example1.net,example15.org',
            )
        );
        $data = $cloud->store($parameters);
        break;
    case 'show':
        $parameters = array(
            'cloud_id' => 1,
        );
        $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $cloud->show($parameters);
        break;
    case 'update':
        $time = time();
        $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $parameters = array(
            'cloud_id' => 13,
            'cloud' => array(
                'name' => 'Updated Sample ' . $time,
                'url_name' => $cloud->stringToURL('Update Sample ' . $time),
                'description' => 'sample description maximum 500 character',
                'enabled_domain_view' => 'updated.example1.com,updated.example2.com',
                'enabled_domain_upload' => 'updated.example1.net,updated.example15.org',
            )
        );
        $data = $cloud->update($parameters);
        break;
    case 'delete':
        $parameters = array('cloud_id' => 22);
        $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $cloud->delete($parameters);
        break;
}

return $data;
