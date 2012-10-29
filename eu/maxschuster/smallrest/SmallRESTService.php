<?php

namespace eu\maxschuster\smallrest;

/**
 * Description of RESTService
 *
 * @author Max Schuster <dev@maxschuster.eu>
 * @package restservice
 */
class SmallRESTService {
    
    const TYPE_GET = 'GET';
    const TYPE_POST = 'POST';
    const TYPE_PUT = 'PUT';
    const TYPE_DELETE = 'DELETE';
    
    protected $url;
    protected $type;
    protected $extension;
    protected $pathData;
    protected $pathDataCount;
    protected $pathDataKeyValue;
    protected $getData;
    protected $postData;
    protected $handler = array();

    public function __construct($url) {
        $this->url = $url;
        $this->getData = $_GET;
        $this->postData = $_POST;
        $this->type = $_SERVER['REQUEST_METHOD'];
        
        $pathInfo = pathinfo($this->url);
        if (!empty($pathInfo['extension'])) {
            $this->extension = $pathInfo['extension'];
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
    
    public function getType() {
        return $this->type;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getGetData() {
        return $this->getData;
    }

    public function getPostData() {
        return $this->postData;
    }

    public function getKey($key) {
        if (isset($this->pathDataKeyValue[$key])) {
            return $this->pathDataKeyValue[$key];
        }
        return null;
    }
    
    public function getKeys() {
        return array_keys($this->pathDataKeyValue);
    }
    
    public function getPathDataCount() {
        return $this->pathDataCount;
    }
    
    public function getIndex($index) {
        if (isset($this->pathData[$index])) {
            return $this->pathData[$index];
        }
        return null;
    }
    
    public function registerHandler(HandlerInterface $handler) {
        $this->handler[spl_object_hash($handler)] = $handler;
    }
    
    public function removeHandler(HandlerInterface $handler) {
        $uid = spl_object_hash($handler);
        if (isset($this->handler[$uid])) {
            unset($this->handler[$uid]);
            return true;
        }
        return true;
    }
    
    public function handle() {
        foreach ($this->handler as $handler) {
            if ($handler->checkResponsibility()) {
                $handler->handle();
                return;
            }
        }
        throw new NoResponsibleHandlerFoundException();
    }
    
}

?>
