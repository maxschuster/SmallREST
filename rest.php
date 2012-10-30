<?php

require_once 'eu/maxschuster/smallrest/inc.smallrest.php';

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
        echo "Isch Händel dat!";
    }

}

$rest = new \eu\maxschuster\smallrest\SmallRESTService($_GET['_REWRITE_']);
$testHandler = new TestHandler($rest);
$rest->registerHandler($testHandler);
//$rest->removeHandler($testHandler);
$rest->handle();

?>