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
 * Clouds management implementation.
 * list of clouds
 * create cloud
 * gave datas back to filters
 * refresh cloud
 * delete cloud
 *
 * examples
 *
 * list of clouds
 * $parameters = [];
 * 
 * $cloud = new Cloud($api_key, $api_secret);
 * $clouds = $cloud->index($parameters);
 * 
 * create cloud
 * 
 * $parameters = [
 *      'cloud' => [
 *          'name' => 'Sample',
 *          'url_name' => $cloud->stringToURL('Sample'),
 *          'description' => 'Sample description',
 *          'enabled_domain_view' => 'The list of these domain names which allowed to serve images.',
 *          'enabled_domain_upload' => 'The list of these domain names which allowed from upload images.',
 *      ]
 * ];
 * $cloud = new Cloud($api_key, $api_secret);
 * $data = $cloud->store($parameters);
 * $data // return message or data of created cloud
 * 
 * showing cloud:
 * $parameters = ['cloud_id' => $cloud_id];
 * $cloud = new Cloud($api_key, $api_secret);
 * $data = $cloud->show($parameters);
 * 
 * edit cloud
 * 
 * 
 * $parameters = [
 *      'cloud_id' => $cloud_id,
 *      'cloud' => [
 *          'name' => 'Sample',
 *          'url_name' => $cloud->stringToURL('Sample'),
 *          'description' => 'Sample description',
 *          'enabled_domain_view' => ' 'The list of these domain names which allowed to serve images.',
 *      'enabled_domain_upload' => 'The list of these domain names which allowed from upload images.',
 *      ]
 * ];
 * $cloud = new Cloud($api_key, $api_secret);
 * $data = $cloud->update($parameters);
 * $data // return message and data from the created cloud
 *
 * delete cloud
 *
 * $parameters = ['cloud_id' => $cloud_id];
 * $cloud = new Cloud;
 * $data = $cloud->delete($parameters);
 * $data // return message about the deleting status
 */
class Cloud extends ShardImage {

    const URI = '/api-cloud';

    /**
     * List clouds.
     * @param array $parameters
     * @return boolean|array
     */
    public function index($parameters) {
        $options = [];
        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI, $parameters, $options);
        return $result;
    }

    /**
     * Save new cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function store($parameters) {
        $options = [];

        $uri = $this->_createURI(self::URI, $parameters);
        $result = $this->api->call(API::REQUEST_TYPE_POST, $uri, $parameters, $options);
        return $result;
    }

    /**
     * Show cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function show($parameters) {
        $options = [];

        $uri = $this->_createURI(self::URI, $parameters);
        $result = $this->api->call(API::REQUEST_TYPE_GET, $uri, $parameters, $options);
        return $result;
    }

    /**
     * Update cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function update($parameters) {
        $options = [];

        $uri = $this->_createURI(self::URI, $parameters);
        $result = $this->api->call(API::REQUEST_TYPE_PUT, $uri, $parameters, $options);
        return $result;
    }

    /**
     * Delete cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function delete($parameters) {
        $options = [];

        $uri = $this->_createURI(self::URI, $parameters);
        $result = $this->api->call(API::REQUEST_TYPE_DELETE, $uri, $parameters, $options);
        return $result;
    }

    /**
     * 
     * @param string $uri [/cloud]
     * @param array $parameters [cloud_id => \d, ...]
     * @param string $postfix [/store, update, /delete]
     * @return string
     */
    private function _createURI($uri, $parameters, $postfix = '') {
        if (isset($parameters['cloud_id'])) {
            return $uri . '/' . $parameters['cloud_id'] . $postfix;
        }

        return $uri . $postfix;
    }

}
