<?php
/**
 * @link http://shardimage.com/
 * @copyright Copyright (c) 2014 ShardImage
 * @license https://github.com/shardimage/shardimage-php/blob/master/LICENCE.md
 */

namespace ShardImage;

use ShardImage\ShardImage;
use ShardImage\API;

/**
 * Uploading files
 * 
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 * 
 * example
 * 
 * $upload = new Upload(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $upload->upload($_FILES['uploadfile'], $cloud_id);
 * $data // return message and data about the saved picture
 */
class Upload extends ShardImage {

    const URI = '/upload';
    const KEY = 'image_id';

    /**
     * Image upload function.
     * @param array $parameters example: $parameters = array('file' =>  $_FILES), 'parameters' => $cloud_id)
     * @return boolean|array
     */
    public function upload($parameters) {


        if (function_exists('curl_file_create')) {
            // PHP >= 5.5
            $curl_file = curl_file_create($parameters['file']['tmp_name'], $parameters['file']['type'], $parameters['file']['name']);
        } else {
            // PHP < 5.5
            $curl_file = '@/' . realpath($parameters['file']['tmp_name']) . ';type=' . $parameters['file']['type'] . ';name=' . $parameters['file']['name'];
        }

        $parameters = array(
            'files' => $curl_file,
            'cloud_id' => $parameters['parameters']['cloud_id'],
        );

        return $this->apiCall(API::REQUEST_TYPE_UPLOAD, $parameters);
    }

}
