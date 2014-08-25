<?php

/*
 * This file is part of the ShardImage API.
 *
 * (c) Lajos Molnar <lajos.molnar@shardimage.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ShardImage;

use ShardImage\ShardImage;
use ShardImage\API;

/**
 * Uploading files
 * 
 * example:
 * $upload = new Upload($api_key, $api_secret);
 * $data = $upload->upload($_FILES['uploadfile'], $cloud_id);
 * $data // return message and data about the saved picture
 */
class Upload extends ShardImage {

    const URI = '/upload';

    /**
     * Image upload function.
     * @param array $files $_FILES array example: $_FILES['uploadfile']
     * @param integer $cloud_id
     * @return boolean|array
     */
    public function upload($files, $cloud_id) {

        $curl_file = curl_file_create($files['tmp_name'], $files['type'], $files['name']);

        $parameters = [
            'files' => $curl_file,
            'cloud_id' => $cloud_id,
        ];

        $options = [];

        $api = new API($this->api_key, $this->api_secret);
        $api->api_key = $this->api_key;
        $api->api_secret = $this->api_secret;
        $result = $this->api->call(API::REQUEST_TYPE_UPLOAD, self::URI, $parameters, $options);
        file_put_contents('/work/log/upload.log', var_export($result, true), FILE_APPEND);
        return $result;
    }

}
