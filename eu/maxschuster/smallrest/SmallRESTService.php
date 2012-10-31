<?php
/**
 * This file contains SmallRESTs main class "SmallRESTService"
 * @author Max Schuster <dev@maxschuster.eu>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package smallrest
 */

/*
 * Copyright 2012 Max Schuster 
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace eu\maxschuster\smallrest;

use eu\maxschuster\smallrest\exceptions\NoResponsibleHandlerFoundException;

/**
 * This is the main SINGLETON class of SmallREST. It reads all data from the given path to
 * make it easy readeble for request handlers. Request handlers has to be
 * registerd in this class.
 * @author Max Schuster <dev@maxschuster.eu>
 * @package smallrest
 */
class SmallRESTService {
    
    /**
     * Request type GET
     * @const TYPE_GET
     */
    const TYPE_GET = 'GET';
    
    /**
     * Request type POST
     * @const TYPE_POST
     */
    const TYPE_POST = 'POST';
    
    /**
     * Request type PUT
     * @const TYPE_PUT
     */
    const TYPE_PUT = 'PUT';
    
    /**
     * Request type DELETE
     * @const TYPE_DELETE
     */
    const TYPE_DELETE = 'DELETE';
    
    /**
     * Singleton instance
     * @var SmallRESTService
     */
    private static $_instance;

    /**
     * The given rewrite url
     * @var string
     */
    protected $url;
    
    /**
     * Request type (GET, POST, PUT, DELETE)
     * @var string
     */
    protected $type;
    
    /**
     * Requested file extension.
     * E.g. json, xml, ...
     * @var string
     */
    protected $extension;
    
    /**
     * Splited rewrite path as numeric array
     * @var array
     */
    protected $pathData;
    
    /**
     * Amount of elements inside the pathData array
     * @var int
     */
    protected $pathDataCount;
    
    /**
     * Path data as assoc array
     * @var array 
     */
    protected $pathDataKeyValue;
    
    /**
     * GET data
     * @var array
     */
    protected $getData;
    
    /**
     * POST data
     * @var array 
     */
    protected $postData;
    
    /**
     * Array containing all registerd handlers
     * @var array
     */
    protected $handler = array();

    /**
     * SmallRESTService contructor. Sets the url and defaults for type, getData
     * and postData.
     * @param string $url Rewrite path
     */
    protected function __construct($url) {
        $this->setGetData($_GET);
        $this->setPostData($_POST);
        $this->setType($_SERVER['REQUEST_METHOD']);
        $this->setUrl($url);
    }
    
    /**
     * Initializes the SmallRESTService Singleton instance.
     * @param string $url Rewrite path
     * @return SmallRESTService Singleton instance of SmallRESTService
     */
    public static function init($url) {
        self::$_instance = new SmallRESTService($url);
        return self::getInstance();
    }
    
    /**
     * Initializes the SmallRESTService Singleton instance.
     * @return SmallRESTService Singleton instance of SmallRESTService
     */
    public static function getInstance() {
        if (self::$_instance instanceof SmallRESTService) {
            return self::$_instance;
        }
    }
    
    /**
     * Gets the current rewrite url
     * @return string Rewrite url
     */
    public function getUrl() {
        return $this->url;
    }
    
    /**
     * Sets a new rewrite url. Also the extension, pathData, pathDataCount and
     * pathDataKeyValue.
     * @param string $url Rewrite url
     */
    public function setUrl($url) {
        $this->url = $url;
        $pathInfo = pathinfo($this->url);
        if (!empty($pathInfo['extension'])) {
            $this->extension = $pathInfo['extension'];
        } else {
            $this->extension = null;
        }
        $this->pathData = array();
        if (!empty($pathInfo['dirname'])) {
            $this->pathData = array_merge($this->pathData, explode('/', $pathInfo['dirname']));
        }
        if (!empty($pathInfo['filename'])) {
            $this->pathData[] = $pathInfo['filename'];
        }
        $this->pathDataCount = sizeof($this->pathData);
        unset($pathInfo);
        
        while (($key = current($this->pathData)) !== false) {
            $value = next($this->pathData);
            if ($key !== false && $value !== false) {
                $this->pathDataKeyValue[$key] = $value;
            }
            next($this->pathData);
        }
        unset($key,$value);
    }
    
    /**
     * Gets the current request type
     * @return string Request type
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Sets a new request type
     * @param string $type Request type
     */
    public function setType($type) {
        $this->type = (string)$type;
    }

    /**
     * Gets the current requested file extension
     * @return string Requested file extension
     */
    public function getExtension() {
        return $this->extension;
    }
    
    /**
     * Sets a new requested file extension
     * @param string $extension Requested file extension
     */
    public function setExtension($extension) {
        $this->extension = (string)$extension;
    }

    /**
     * Gets the current GET data
     * @return array GET data
     */
    public function getGetData() {
        return $this->getData;
    }
    
    /**
     * Sets a new array as GET data
     * @param array $getData GET data
     */
    public function setGetData(array $getData) {
        $this->getData = $getData;
    }

    /**
     * Gets the current GET data
     * @return array GET data
     */
    public function getPostData() {
        return $this->postData;
    }
    
    /**
     * Sets a new array as POST data
     * @param array $postData POST data
     */
    public function setPostData(array $postData) {
        $this->postData = $postData;
    }

    /**
     * Gets the value of the given key from the pathDataKeyValue array
     * @param string $key Key to search
     * @return mixed
     */
    public function getKey($key) {
        if (isset($this->pathDataKeyValue[$key])) {
            return $this->pathDataKeyValue[$key];
        }
        return null;
    }
    
    /**
     * Gets a list of all available keys from the pathDataKeyValue array
     * @return array
     */
    public function getKeys() {
        return array_keys($this->pathDataKeyValue);
    }
    
    /**
     * Gets the current amount of elements inside the pathData array
     * @return int Amount of elements
     */
    public function getPathDataCount() {
        return $this->pathDataCount;
    }
    
    /**
     * Gets the value for the given index from the pathData array
     * @param int $index Requested index
     * @return mixed Value of index
     */
    public function getIndex($index) {
        if (isset($this->pathData[$index])) {
            return $this->pathData[$index];
        }
        return null;
    }
    
    /**
     * Register a new request handler to the request list
     * @param HandlerInterface $handler Request handler
     */
    public function registerHandler(HandlerInterface $handler) {
        $this->handler[spl_object_hash($handler)] = $handler;
    }
    
    /**
     * Removes the given request handler from the request list
     * @param HandlerInterface $handler Request handler
     * @return boolean A handler has been removed
     */
    public function removeHandler(HandlerInterface $handler) {
        $uid = spl_object_hash($handler);
        if (isset($this->handler[$uid])) {
            unset($this->handler[$uid]);
            return true;
        }
        return true;
    }
    
    /**
     * Searches the right handler for the request. It also echos an error
     * message if something went wrong.
     * @return void Nothing...
     * @throws NoResponsibleHandlerFoundException
     */
    public function handle() {
        $message = null;
        try {
            foreach ($this->handler as $handler) {
                if ($handler->checkResponsibility()) {
                    $handler->handle();
                    return;
                }
            }
            throw new NoResponsibleHandlerFoundException();
        } catch (NoResponsibleHandlerFoundException $re) {
            $message = new errormessages\CouldNotHandleRequest();
        } catch (\Exception $e) {
            $message = new errormessages\ErrorMessage();
        }
        $message->outputMessage();
    }
    
}

?>
