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
 * Clouds management implementation.
 * list of clouds
 * create cloud
 * gave datas back to filters
 * refresh cloud
 * delete cloud
 * 
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 *
 * examples
 *
 * list of clouds
 * $parameters = array();
 * 
 * $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $clouds = $cloud->index($parameters);
 * 
 * create cloud
 * 
 * $parameters = array(
 *      'cloud' => array(
 *          'name' => 'Sample',
 *          'url_name' => $cloud->stringToURL('Sample'),
 *          'description' => 'Sample description',
 *          'enabled_domain_view' => 'The list of these domain names which allowed to serve images.',
 *          'enabled_domain_upload' => 'The list of these domain names which allowed from upload images.',
 *      )
 * );
 * $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $cloud->store($parameters);
 * $data // return message or data of created cloud
 * 
 * showing cloud:
 * $parameters = array('cloud_id' => $cloud_id);
 * $cloud = new Cloud($api_key, $api_secret);
 * $data = $cloud->show($parameters);
 * 
 * edit cloud
 * 
 * 
 * $parameters = array(
 *      'cloud_id' => $cloud_id,
 *      'cloud' => array(
 *          'name' => 'Sample',
 *          'url_name' => $cloud->stringToURL('Sample'),
 *          'description' => 'Sample description',
 *          'enabled_domain_view' => ' 'The list of these domain names which allowed to serve images.',
 *      'enabled_domain_upload' => 'The list of these domain names which allowed from upload images.',
 *      )
 * );
 * $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $cloud->update($parameters);
 * $data // return message and data from the created cloud
 *
 * delete cloud
 *
 * $parameters = array('cloud_id' => $cloud_id);
 * $cloud = new Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $cloud->delete($parameters);
 * $data // return message about the deleting status
 */
class Cloud extends ShardImage {

    const URI = '/api-cloud';
    const KEY = 'cloud_id';

    /**
     * List clouds.
     * @param array $parameters
     * @return boolean|array
     */
    public function index($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_GET, $parameters);
    }

    /**
     * Save new cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function store($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_POST, $parameters);
    }

    /**
     * Show cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function show($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_GET, $parameters);
    }

    /**
     * Update cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function update($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_PUT, $parameters);
    }

    /**
     * Delete cloud.
     * @param array $parameters
     * @return boolean|array
     */
    public function delete($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_DELETE, $parameters);
    }

}
