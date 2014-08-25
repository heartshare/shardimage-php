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

use ShardImage\API;

class ShardImage {

    /**
     * ping uri.
     */
    const URI = '';
    const POSTFIX_CREATE = '/create';
    const POSTFIX_STORE = '/store';
    const POSTFIX_EDIT = '/edit';
    const POSTFIX_UPDATE = '/update';
    const POSTFIX_DELETE = '/delete';

    /**
     *
     * @var string
     */
    public $api_key;

    /**
     *
     * @var string
     */
    public $api_secret;

    /**
     *
     * @var API
     */
    protected $api;

    /**
     * 
     * @param string $api_key
     * @param string $api_secret
     */
    public function __construct($api_key = null, $api_secret = null) {
        if ($api_key === null || $api_secret === null) {
            $configs = include 'config/config.php';
            foreach ($configs as $key => $value) {
                if ($value !== null) {
                    $this->$key = $value;
                }
            }
        } else {
            $this->api_key = $api_key;
            $this->api_secret = $api_secret;
        }

        $this->api = new API($this->api_key, $this->api_secret);
        file_put_contents('/work/log/sdapi.log', var_export($this, true) . "\n\n\n", FILE_APPEND);
    }

    /**
     * 
     * @return boolean|array
     */
    public function ping() {
        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI, [], []);

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

}
