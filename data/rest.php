<?php

require_once '../eu/maxschuster/smallrest/inc.smallrest.php';
//require_once 'smallrest.phar';
use eu\maxschuster\smallrest\SmallRESTService;

class TestHandler extends \eu\maxschuster\smallrest\HandlerAbstract {

    public function checkResponsibility() {
        if (SmallRESTService::getInstance()->getIndex(0) == 'user') {
            return true;
        }
        return false;
    }
    
    public function create() {
        return "Create not supported";
    }

    public function delete() {
         return "Create not supported";
    }

    public function get() {
        return "Get User with id \"".SmallRESTService::getInstance()->getKey('user')."\"";
    }

    public function update() {
         return "Upda not supported";
    }


}

$rest = SmallRESTService::init($_GET['_REWRITE_']);
$testHandler = new TestHandler();
$rest->registerHandler($testHandler);
$rest->handle();

?>