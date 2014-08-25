<?php

namespace ShardImage\lib;

include 'cURLException.php';

use ShardImage\lib\cURLException;

/**
 * cURL operation relieve class<br>
 * You can use the Config class to give default settings
 * but itself can contain such thing as you can see at $def_opts<br>
 * @example <code>
 * $curl->setOpt(array([...]))
 * $ret = $curl->get($url)->exec();
 * $curl->close();
 * </code>
 * @example <code>
 * $curl->setOpt(array([...]))
 * $ret = $curl->post(array([...]))->exec();
 * $curl->close();
 * </code>
 */
class cURL {

    /**
     * The contents of the "Cookie: " header to be used in the HTTP request.
     * Note that multiple cookies are separated with a semicolon followed
     * by a space (e.g., "fruit=apple; colour=red") 
     */
    const COOKIE = CURLOPT_COOKIE;

    /**
     * TRUE to automatically set the Referer: field in requests where it follows a Location: redirect. 
     */
    const AUTOREFERER = CURLOPT_AUTOREFERER;

    /**
     * TRUE to include the header in the output. 
     */
    const HEADER = CURLOPT_HEADER;

    /**
     * TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly. 
     */
    const RETURNTRANSFER = CURLOPT_RETURNTRANSFER;

    /**
     * FALSE to stop cURL from verifying the peer's certificate. 
     * Alternate certificates to verify against can be specified with the CURLOPT_CAINFO
     * option or a certificate directory can be specified with the CURLOPT_CAPATH option. 
     */
    const SSL_VERIFYPEER = CURLOPT_SSL_VERIFYPEER;

    /**
     * TRUE to output verbose information. Writes output to STDERR,
     * or the file specified using CURLOPT_STDERR. 	
     */
    const VERBOSE = CURLOPT_VERBOSE;

    /**
     * An alternative location to output errors to instead of STDERR. 
     */
    const STDERR = CURLOPT_STDERR;

    /**
     * The URL to fetch. This can also be set when initializing a session with curl_init(). 
     */
    const URL = CURLOPT_URL;

    /**
     * TRUE to reset the HTTP request method to GET. Since GET is the default, 
     * this is only necessary if the request method has been changed.  
     */
    const GET = CURLOPT_HTTPGET;

    /**
     * TRUE to do a regular HTTP POST. This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms. 
     */
    const POST = CURLOPT_POST;

    /**
     * TRUE to HTTP PUT a file. The file to PUT must be set with CURLOPT_INFILE and CURLOPT_INFILESIZE.  
     */
    const PUT = CURLOPT_PUT;

    /**
     * A custom request method to use instead of "GET" or "HEAD" when doing a HTTP request. This is useful for doing 
     * "DELETE" or other, more obscure HTTP requests. Valid values are things like "GET", "POST", "CONNECT" and so on;
     * i.e. Do not enter a whole HTTP request line here. For instance, entering "GET /index.html HTTP/1.0\r\n\r\n"
     * would be incorrect.
     *  	
     * Note:    
     *   Don't do this without making sure the server supports the custom request method first.  
     */
    const CUSTOMREQUEST = CURLOPT_CUSTOMREQUEST;

    /**
     * The full data to post in a HTTP "POST" operation. 
     * To post a file, prepend a filename with @ and use the full path. The filetype can be explicitly specified 
     * by following the filename with the type in the format ';type=mimetype'. This parameter can either be passed
     * as a urlencoded string like 'para1=val1&para2=val2&...' or as an array with the field name as key and field
     * data as value. If value is an array, the Content-Type header will be set to multipart/form-data. As of PHP 5.2.0,
     * value must be an array if files are passed to this option with the @ prefix. 
     */
    const POSTFIELDS = CURLOPT_POSTFIELDS;

    /**
     * An array of HTTP header fields to set, in the format array('Content-type: text/plain', 'Content-length: 100') 	
     */
    const HTTPHEADER = CURLOPT_HTTPHEADER;

    /**
     * TRUE to exclude the body from the output. Request method is then set to HEAD. Changing this to FALSE does
     * not change it to GET.  
     */
    const NOBODY = CURLOPT_NOBODY;

    /**
     * The contents of the "User-Agent: " header to be used in a HTTP request. 
     */
    const USERAGENT = CURLOPT_USERAGENT;

    /**
     * A username and password formatted as "[username]:[password]" to use for the connection. 
     */
    const USERPASSWD = CURLOPT_USERPWD;

    /**
     * A username and password formatted as "[username]:[password]" to use for the connection. 
     */
    const USERPWD = CURLOPT_USERPWD;

    /**
     * TRUE to follow any "Location: " header that the server sends as part of the HTTP header 
     * (note this is recursive, PHP will follow as many "Location: " headers that it is sent, unless CURLOPT_MAXREDIRS is set). 
     */
    const FOLLOWLOCATION = CURLOPT_FOLLOWLOCATION;

    /**
     * TRUE to prepare for an upload.  
     */
    const UPLOAD = CURLOPT_UPLOAD;

    /**
     * The file that the transfer should be read from when uploading. 
     */
    const INFILE = CURLOPT_INFILE;

    /**
     * The expected size, in bytes, of the file when uploading a file to a remote site. Note that using this option 
     * will not stop libcurl from sending more data, as exactly what is sent depends on CURLOPT_READFUNCTION. 
     */
    const INFILESIZE = CURLOPT_INFILESIZE;

    /**
     * The file that the transfer should be written to. The default is STDOUT (the browser window).  
     */
    const FILE = CURLOPT_FILE;

    /**
     * The file that the transfer should be written to. The default is STDOUT (the browser window).  
     * @uses FILE
     */
    const OUTFILE = CURLOPT_FILE;

    /**
     * The file that the header part of the transfer is written to.  
     */
    const WRITEHEADER = CURLOPT_WRITEHEADER;

    /**
     * The file that the header part of the transfer is written to.  
     * @uses WRITEHEADER
     */
    const HEADEROUTFILE = CURLOPT_WRITEHEADER;

    /**
     * The number of milliseconds to wait while trying to connect. Use 0 to wait indefinitely. If libcurl is built to 
     * use the standard system name resolver, that portion of the connect will still use full-second resolution for 
     * timeouts with a minimum timeout allowed of one second.  
     */
    const CONNECTTIMEOUT_MS = CURLOPT_CONNECTTIMEOUT_MS;

    /**
     * The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.  
     */
    const CONNECTTIMEOUT = CURLOPT_CONNECTTIMEOUT;

    /**
     * The maximum number of seconds to allow cURL functions to execute.
     */
    const TIMEOUT = CURLOPT_TIMEOUT;

    /**
     * TRUE to force the connection to explicitly close when it has finished processing, and not be pooled for reuse.  
     */
    const FORBID_REUSE = CURLOPT_FORBID_REUSE;

    /**
     * TRUE to force the use of a new connection instead of a cached one.  
     */
    const FRESH_CONNECT = CURLOPT_FRESH_CONNECT;

    /**
     * CURLINFO_EFFECTIVE_URL - Last effective URL
     */
    const INFO_EFFECTIVE_URL = CURLINFO_EFFECTIVE_URL;

    /**
     * CURLINFO_HTTP_CODE - Last received HTTP code
     */
    const INFO_HTTP_CODE = CURLINFO_HTTP_CODE;

    /**
     * CURLINFO_FILETIME - Remote time of the retrieved document, if -1 is returned the time of the document is unknown
     */
    const INFO_FILETIME = CURLINFO_FILETIME;

    /**
     * CURLINFO_TOTAL_TIME - Total transaction time in seconds for last transfer
     */
    const INFO_TOTAL_TIME = CURLINFO_TOTAL_TIME;

    /**
     * CURLINFO_NAMELOOKUP_TIME - Time in seconds until name resolving was complete
     */
    const INFO_NAMELOOKUP_TIME = CURLINFO_NAMELOOKUP_TIME;

    /**
     * CURLINFO_CONNECT_TIME - Time in seconds it took to establish the connection
     */
    const INFO_CONNECT_TIME = CURLINFO_CONNECT_TIME;

    /**
     * CURLINFO_PRETRANSFER_TIME - Time in seconds from start until just before file transfer begins
     */
    const INFO_PRETRANSFER_TIME = CURLINFO_PRETRANSFER_TIME;

    /**
     * CURLINFO_STARTTRANSFER_TIME - Time in seconds until the first byte is about to be transferred
     */
    const INFO_STARTTRANSFER_TIME = CURLINFO_STARTTRANSFER_TIME;

    /**
     * CURLINFO_REDIRECT_TIME - Time in seconds of all redirection steps before final transaction was started
     */
    const INFO_REDIRECT_TIME = CURLINFO_REDIRECT_TIME;

    /**
     * CURLINFO_SIZE_UPLOAD - Total number of bytes uploaded
     */
    const INFO_SIZE_UPLOAD = CURLINFO_SIZE_UPLOAD;

    /**
     * CURLINFO_SIZE_DOWNLOAD - Total number of bytes downloaded
     */
    const INFO_SIZE_DOWNLOAD = CURLINFO_SIZE_DOWNLOAD;

    /**
     * CURLINFO_SPEED_DOWNLOAD - Average download speed
     */
    const INFO_SPEED_DOWNLOAD = CURLINFO_SPEED_DOWNLOAD;

    /**
     * CURLINFO_SPEED_UPLOAD - Average upload speed
     */
    const INFO_SPEED_UPLOAD = CURLINFO_SPEED_UPLOAD;

    /**
     * CURLINFO_HEADER_SIZE - Total size of all headers received
     */
    const INFO_HEADER_SIZE = CURLINFO_HEADER_SIZE;

    /**
     * CURLINFO_HEADER_OUT - The request string sent. For this to work, add the CURLINFO_HEADER_OUT option to the handle by calling curl_setopt()
     */
    const INFO_HEADER_OUT = CURLINFO_HEADER_OUT;

    /**
     * CURLINFO_REQUEST_SIZE - Total size of issued requests, currently only for HTTP requests
     */
    const INFO_REQUEST_SIZE = CURLINFO_REQUEST_SIZE;

    /**
     * CURLINFO_SSL_VERIFYRESULT - Result of SSL certification verification requested by setting CURLOPT_SSL_VERIFYPEER
     */
    const INFO_SSL_VERIFYRESULT = CURLINFO_SSL_VERIFYRESULT;

    /**
     * CURLINFO_CONTENT_LENGTH_DOWNLOAD - content-length of download, read from Content-Length: field
     */
    const INFO_CONTENT_LENGTH_DOWNLOAD = CURLINFO_CONTENT_LENGTH_DOWNLOAD;

    /**
     * CURLINFO_CONTENT_LENGTH_UPLOAD - Specified size of upload
     */
    const INFO_CONTENT_LENGTH_UPLOAD = CURLINFO_CONTENT_LENGTH_UPLOAD;

    /**
     * CURLINFO_CONTENT_TYPE - Content-Type: of the requested document, NULL indicates server did not send valid Content-Type: header
     */
    const INFO_CONTENT_TYPE = CURLINFO_CONTENT_TYPE;

    /**
     * Content-type header 
     */
    const H_CONTENT_TYPE = 'Content-type';

    /**
     * X-HTTP-Method-Override header 
     */
    const H_X_HTTP_METHOD_OVERRIDE = 'X-HTTP-Method-Override';

    /**
     * CUSTOMREQUEST curlopt for PUT request
     */
    const CUSTOMREQUEST_PUT = 'PUT';

    /**
     * CUSTOMREQUEST curlopt for HEAD request
     */
    const CUSTOMREQUEST_HEAD = 'HEAD';

    /**
     * CUSTOMREQUEST curlopt for DELETE request
     */
    const CUSTOMREQUEST_DELETE = 'DELETE';

    /**
     * curl connection
     * @var resource
     */
    private $ch = null;

    /**
     * Default settings
     * @var array 
     */
    private $def_opt = array(
        self::RETURNTRANSFER => true,
        self::HEADER => false,
        self::COOKIE => '',
        self::AUTOREFERER => true,
    );

    /**
     * The current connection settings
     * @var array
     */
    private $opt = array();

    /**
     * cURL class instantiation using the default settings 
     * @param string|null $url this url will be used to connect if you give that here
     */
    public function __construct($url = null) {
        $this->resetOpts();
        if ($url) {
            $this->setOpt(self::URL, $url);
        }
    }

    /**
     * Destructor 
     */
    public function __destruct() {
        $this->close();
    }

    /**
     * Retrieve $url or the adjusted url by CURLOPT_URL Retrieve $url or the adjusted url by CURLOPT_URL 
     * If the request fails, exception will be throw
     * 
     * @param string $url
     * @throws cURLException
     * @return string 
     */
    public function exec($url = null) {
        if ($url) {
            $this->setOpt(self::URL, $url);
        }

        $this->init();

        curl_setopt_array($this->ch, $this->opt);

        $ret = curl_exec($this->ch);

        if (curl_errno($this->ch)) {
            throw new cURLException(curl_error($this->ch), curl_errno($this->ch));
        }

        return $ret;
    }

    /**
     * Beállít egy cURL opciót
     * @see az osztály nem INFO_ kezdetű konstansai
     * @param int $key
     * @param mixed $val 
     * @return \cURL
     */
    public function setOpt($key, $val = false) {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->setOpt($k, $v);
            }
        } else {
            $this->opt[$key] = $val;
        }
        return $this;
    }

    /**
     * beállított cURL opciót adja vissza, vagy a második paraméterben megadott default-ot
     * @see az osztály nem INFO_ kezdetű konstansai
     * @param int $key
     * @param mixed $default visszatérési érték, alapértelmezetten false
     * @return mixed 
     */
    public function getOpt($key, $default = false) {
        return isset($this->opt[$key]) ? $this->opt[$key] : $default;
    }

    /**
     * cURL opció törlése
     * @see az osztály nem INFO_ kezdetű konstansai
     * @param int $key 
     */
    public function delOpt($key) {
        unset($this->opt[$key]);
    }

    /**
     * Minden opció visszaállítása az alapértelmezettre 
     * @return \cURL
     */
    public function resetOpts() {
//        $this->opt = Config::get('CURL', '', $this->def_opt);
        return $this;
    }

    /**
     * Minden beállított opciót visszaad
     * @return array
     */
    public function getOpts() {
        return $this->opt;
    }

    /**
     * Információt ad a curl transferről.
     * @see INFO_ kezdetű konstansok
     * @param mixed $key
     * @return mixed 
     */
    public function getInfo($key = null) {
        if ($this->isValid()) {
            return curl_getinfo($this->ch, $key);
        }
    }

    /**
     * A HTTP Auth user/pass-t állíthatod be
     * @param string $user
     * @param string $pass 
     * @return \cURL
     */
    public function setUserPass($user, $pass) {
        $this->setOpt(self::USERPASSWD, "$user:$pass");
        return $this;
    }

    /**
     * Cookie-t adhatsz a kéréshez
     * @param string $key
     * @param string $val 
     * @return \cURL
     */
    public function setCookie($key, $val) {
        $cookie = explode('; ', $this->getOpt(self::COOKIE));
        if (!in_array($key . '=' . $val, $cookie)) {
            array_push($cookie, $key . '=' . $val);
        }

        return $this->setOpt(self::COOKIE, implode('; ', $cookie));
    }

    /**
     * Visszaállítja a cookie-t az alapértelmezett beállításokra
     * @return \cURL
     */
    public function resetCookie() {
        $this->opt[self::COOKIE] = $this->def_opt[self::COOKIE];
        return $this;
    }

    /**
     * Fix Useragent beállítása
     * @param string $user_agent 
     * @return \cURL
     */
    public function setUserAgent($user_agent) {
        $this->setOpt(self::USERAGENT, $user_agent);
        return $this;
    }

    /**
     * Egy lépésből beállítja a HEAD kérést
     * @return \cURL
     */
    public function head() {
        $this->delOpt(self::POST);
        $this->delOpt(self::GET);
        $this->setOpt(self::CUSTOMREQUEST, 'HEAD');
        $this->setOpt(self::NOBODY, true);
        return $this;
    }

    /**
     * Egy lépésből GET típusúra állítja a lekérést
     * @return \cURL 
     */
    public function get() {
        $this->delOpt(self::POST);
        $this->delOpt(self::POSTFIELDS);
        $this->setOpt(self::GET, true);
        return $this;
    }

    /**
     * Egy lépésből beállítja a POST mezőket, és a kérést POST típusúra állítja
     * @param array|string $fields 
     * @return \cURL
     */
    public function post($fields = array()) {
        $this->setOpt(self::POST, true);
        $this->setOpt(self::POSTFIELDS, $fields);
        return $this;
    }

    /**
     * Egy lépésből beállítja a POST mezőket, és a kérést PUT típusúra állítja
     * @param array|string $fields 
     * @return \cURL
     */
    public function put($fields = array()) {
        $this->delOpt(self::POST);
        $this->delOpt(self::GET);
        $this->setOpt(self::CUSTOMREQUEST, self::CUSTOMREQUEST_PUT);
        $this->setOpt(self::POSTFIELDS, $fields);
        return $this;
    }

    /**
     * Egy lépésből delete-re állítja a küldés metódusát
     * @return \cURL 
     */
    public function delete() {
        $this->delOpt(self::POST);
        $this->delOpt(self::GET);
        $this->setOpt(self::CUSTOMREQUEST, self::CUSTOMREQUEST_DELETE);
        return $this;
    }

    /**
     * A kérést X-HTTP-Method-Override-al DELETE típusúra állítja, majd a kéréshez beállítja a
     * post fieldeket. Valójában POST kérés fog lefutni.
     * @link http://blogs.plexibus.com/2009/01/15/rest-esting-with-curl/ 
     * @param array $fields 
     * @return \cURL 
     */
    public function deleteWithPost($fields = array()) {
        $this->addHeader(self::H_X_HTTP_METHOD_OVERRIDE, self::CUSTOMREQUEST_DELETE);
        $this->post($fields);
        return $this;
    }

    /**
     * A kérést X-HTTP-Method-Override-al PUT típusúra állítja, majd a kéréshez beállítja a
     * post fieldeket. Valójában POST kérés fog lefutni.
     * @link http://blogs.plexibus.com/2009/01/15/rest-esting-with-curl/ 
     * @param array $fields 
     * @return \cURL 
     */
    public function putWithPost($fields = array()) {
        $this->addHeader(self::H_X_HTTP_METHOD_OVERRIDE, self::CUSTOMREQUEST_PUT);
        $this->post($fields);
        return $this;
    }

    /**
     * A kérést PUT típusúra állítja a CURLOPT_PUT opció beállításával, majd beállítja a CURLOPT_INFILE és 
     * CURLOPT_INFILESIZE konstansokat a $filename paraméterből. A CURLOPT_INFILESIZE paramétert csak akkor állítja be,
     * ha is_readable($filename)!
     * @param string $filename 
     * @return \cURL
     */
    public function putFile($filename) {
        $this->setOpt(self::PUT, true);
        $this->setOpt(self::INFILE, $filename);
        if (is_readable($filename)) {
            $this->setOpt(self::INFILESIZE, filesize($filename));
        }
    }

    /**
     * Header hozzáadása a kéréshez
     * @param string $key
     * @param string $value 
     * @return \cURL
     */
    public function addHeader($key, $value) {
        $headers = $this->getOpt(self::HTTPHEADER, array());
        $header_replaced = false;
        foreach ($headers as $i => $h) {
            list($k, $v) = explode(':', $h);
            $k = trim($k);
            $v = trim($v);
            if (strtolower($k) == strtolower($key)) {
                $headers[$i] = $key . '=' . $value;
                $header_replaced = true;
            }
        }

        if (!$header_replaced) {
            array_push($headers, $key . '=' . $value);
        }

        return $this->setOpt(self::HTTPHEADER, $headers);
    }

    /**
     * Töröl egy megadott headert
     * @param string $key 
     * @return \cURL
     */
    public function removeHeader($key) {
        $headers = $this->getOpt(self::HTTPHEADER, array());
        foreach ($headers as $i => $h) {
            list($k, $v) = explode(':', $h);
            $k = trim($k);
            $v = trim($v);
            if (strtolower($k) == strtolower($key)) {
                unset($headers[$i]);
            }
        }

        return $this;
    }

    /**
     * Kapcsolat inicializálása
     * @param string $url 
     */
    private function init() {
        if (!function_exists('curl_init')) {
            trigger_error("A cURL osztaly a curl php extension-t hasznalja", E_USER_ERROR);
        }

        if (!$this->isValid()) {
            $this->ch = curl_init();
        }
    }

    /**
     * A kérés CURLOPT_FORBID_REUSE és a CURLOPT_FRESH_CONNECTION opciók TRUE-ra állításával fog futni
     * @return \cURL
     */
    public function forceNotReuse() {
        $this->setOpt(self::FORBID_REUSE, true);
        $this->setOpt(self::FRESH_CONNECT, true);
        return $this;
    }

    /**
     * cURL kapcsolat lezárása
     * @return bool
     */
    public function close() {
        if (!$this->isValid()) {
            return false;
        }

        curl_close($this->ch);
        return true;
    }

    /**
     * Lezárja a kapcsolatot, majd beállítja a CURLOPT_FORBID_REUSE és a CURLOPT_FRESH_CONNECTION opciókat, hogy a következő
     * kérés már friss kapcsolattal induljon 
     * @return bool
     */
    public function closeAndForceNotReuse() {
        $this->forceNotReuse();
        return $this->close();
    }

    /**
     * Sikeres-e a curl kapcsolat inicializálása
     * @return bool
     */
    private function isValid() {
        return is_resource($this->ch);
    }

}
