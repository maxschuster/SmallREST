<?php

//require_once '../eu/maxschuster/smallrest/inc.smallrest.php';
require_once 'smallrest.phar';
use eu\maxschuster\smallrest\SmallRESTService;

class TestHandler implements eu\maxschuster\smallrest\HandlerInterface {
    protected $service;
    
    function __construct(\eu\maxschuster\smallrest\SmallRESTService $service) {
        $this->service = $service;
    }

    
    public function checkResponsibility() {
        if ($this->service->getIndex(0) == 'user') {
            return true;
        }
        return false;
    }

    public function handle() {
        echo "Get User for id " . $this->service->getKey('user');
    }

}

$rest = SmallRESTService::init($_GET['_REWRITE_']);
$testHandler = new TestHandler($rest);
$rest->registerHandler($testHandler);
$rest->handle();

?>