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
 * Treatment of filter
 * list of filter
 * create filter
 * gave datas back to filter
 * refresh filter
 * delete filter
 * 
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 *
 * examples
 * 
 * list of filters
 * $parameters = array();
 * $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $filters = $filter->index($parameters);
 *
 * create filter
 * 
 * $parameters = array(
 *      'filter' => array(
 *          'cloud_id' => $cloud_id,
 *          'name' => 'Sample',
 *          'url_name' => $filrer->stringToURL('Sample'),
 *          'data' => 'List of image manipulation what need to be taken.'
 *      )
 * );
 * 
 * $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $filter->sotre($parameters);
 * $data // return message and datas of the created filter
 *
 *  display filter
 * $parameters = array('filter_id' => $filter_id);
 * $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $filter->show($parameters);
 *
 * refresh filter:
 * 
 * $parameters = array(
 *      'filter_id' => $filter_id,
 *      'filter' => array(
 *          'cloud_id' => $cloud_id,
 *          'name' => 'Sample',
 *          'url_name' => $filrer->stringToURL('Sample'),
 *          'data' => 'List of image manipulation what need to be taken.'
 *      )
 * );
 * 
 * $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $filter->update($parameters);
 * $data // return message and datas of the created filter
 * 
 * delete filter
 * $parameters = array('filter_id' => $filter_id);
 * $filter = new Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $filter->delete($parameters);
 * $data // return message about the deleting status
 * 
 */
class Filter extends ShardImage {

    const URI = '/api-filter';
    const KEY = 'filter_id';

    /**
     * List filters.
     * @param array $parameters
     * @return boolean|array
     */
    public function index($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_GET, $parameters);
    }

    /**
     * Save new filter.
     * @param array $parameters
     * @return boolean|array
     */
    public function store($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_POST, $parameters);
    }

    /**
     * Show filter.
     * @param array $parameters
     * @return boolean|array
     */
    public function show($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_GET, $parameters);
    }

    /**
     * Update filter.
     * @param array $parameters
     * @return boolean|array
     */
    public function update($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_PUT, $parameters);
    }

    /**
     * Delete filter.
     * @param array $parameters
     * @return boolean|array
     */
    public function delete($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_DELETE, $parameters);
    }

}
