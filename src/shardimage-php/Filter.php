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
 * Treatment of filter
 * list of filter
 * create filter
 * gave datas back to filter
 * refresh filter
 * delete filter
 *
 * examples
 * 
 * list of filters
 * $parameters = [];
 * $filter = new Filter($api_key, $api_secret);
 * $filters = $filter->index($parameters);
 *
 * create filter
 * 
 * $parameters = [
 *      'filter' => [
 *          'cloud_id' => $cloud_id,
 *          'name' => 'Sample',
 *          'url_name' => $filrer->stringToURL('Sample'),
 *          'data' => 'List of image manipulation what need to be taken.'
 *      ]
 * ];
 * 
 * $filter = new Filter($api_key, $api_secret);
 * $data = $filter->sotre($parameters);
 * $data // return message and datas of the created filter
 *
 *  display filter
 * $parameters = ['filter_id' => $filter_id];
 * $filter = new Filter($api_key, $api_secret);
 * $data = $filter->show($parameters);
 *
 * refresh filter:
 * 
 * $parameters = [
 *      'filter_id' => $filter_id,
 *      'filter' => [
 *          'cloud_id' => $cloud_id,
 *          'name' => 'Sample',
 *          'url_name' => $filrer->stringToURL('Sample'),
 *          'data' => 'List of image manipulation what need to be taken.'
 *      ]
 * ];
 * 
 * $filter = new Filter($api_key, $api_secret);
 * $data = $filter->update($parameters);
 * $data // return message and datas of the created filter
 * 
 * delete filter
 * $parameters = ['filter_id' => $filter_id];
 * $filter = new Filter($api_key, $api_secret);
 * $data = $filter->delete($parameters);
 * $data // return message about the deleting status
 * 
 */
class Filter extends ShardImage {

    const URI = '/api-filter';

    /**
     * List filters.
     * @param array $parameters
     * @return boolean|array
     */
    public function index($parameters) {
        $options = [];

        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI, $parameters, $options);
        return $result;
    }

    /**
     * Save new filter.
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
     * Show filter.
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
     * Update filter.
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
     * Delete filter.
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
     * @param string $postfix [/edit]
     * @return string
     */
    private function _createURI($uri, $parameters, $postfix = '') {
        if (isset($parameters['filter_id'])) {
            return $uri . '/' . $parameters['filter_id'] . $postfix;
        }

        return $uri . $postfix;
    }

}
