<?php
/**
 * @link http://shardimage.com/
 * @copyright Copyright (c) 2014 ShardImage
 * @license https://github.com/shardimage/shardimage-php/blob/master/LICENCE.md
 */

namespace ShardImage;

use ShardImage\API;

/**
 * This is the main SDK class for the ShardImage SDK.
 *
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 */
class ShardImage {

    /**
     * ping uri.
     */
    const URI = '';
    const KEY = '';
    const POSTFIX_CREATE = '/create';
    const POSTFIX_STORE = '/store';
    const POSTFIX_EDIT = '/edit';
    const POSTFIX_UPDATE = '/update';
    const POSTFIX_DELETE = '/delete';

    /**
     *
     * @var API
     */
    protected $api;

    /**
     * 
     * @param array $configs array('api_key' => $api_key, 'api_secret' => $api_secret)
     */
    public function __construct($configs = array()) {
        $this->api = new API();

        if (isset($configs['api_key'])) {
            $this->api->api_key = $configs['api_key'];
        }

        if (isset($configs['api_secret'])) {
            $this->api->api_secret = $configs['api_secret'];
        }
    }

    /**
     * Set Api Key
     * @param integer $api_key
     */
    public function setApiKey($api_key) {
        $this->api->api_key = $api_key;
    }

    /**
     * Set Api Secret.
     * @param string $api_secret
     */
    public function setApiSecret($api_secret) {
        $this->api->api_secret = $api_secret;
    }

    /**
     * 
     * @return boolean|array
     */
    public function ping() {
        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI);

        return $result;
    }

    /**
     * Text formatting url properly
     * The separator element can be any caracter except letter from English alphabet and number
     * The capital letters will be replaced by lowercases automatically
     *
     * @param string $string
     * @param string $join
     * @param boolean $uppercase
     * @return string
     */
    public function stringToURL($string, $join = '-', $uppercase = false) {
        $patterns = [
            '/Á/u', '/á/u', '/Ö|Ó|Ő/u', '/ö|ő|ó/u', '/É/u', '/é/u', '/Í/u', '/í/u', '/Ü|Ú|Ű/u', '/ü|ú|ű/u'
            // 1. destruction of accentuated letters or non-English alphabet letters
            , '/(_|[\W])+/u'                // 2. changing one or more not number character or non-English alphabet letters to a separator element
            , '/^(_|[\W])|(_|[\W])$/u'      // 3. delete first and last separator elements
        ];
        $replaces = [
            'A', 'a', 'O', 'o', 'E', 'e', 'I', 'i', 'U', 'u'    // 1.
            , $join                                             // 2.  --> separator element
            , ''                                                // 3.
        ];
        $ret = preg_replace($patterns, $replaces, $string);
        return $uppercase ? $ret : strtolower($ret);
    }

    /**
     * 
     * @param type $request_type
     * @param type $parameters
     * @param type $options
     * @return boolean|array
     */
    protected function apiCall($request_type, $parameters, $options = array()) {
        $uri = $this->createURI($parameters);
        return $this->api->call($request_type, $uri, $parameters, $options);
    }

    /**
     * 
     * @param string $parameters
     * @return string
     */
    protected function createURI($parameters) {
        if (isset($parameters[static::KEY])) {
            return static::URI . '/' . $parameters[static::KEY];
        }

        return static::URI;
    }

}
