<?php

require_once 'eu/maxschuster/smallrest/inc.smallrest.php';

class TestHandler implements eu\maxschuster\smallrest\HandlerInterface {
    protected $service;
    
    function __construct(\eu\maxschuster\smallrest\SmallRESTService $service) {
        $this->service = $service;
    }

    
    public function checkResponsibility() {
        return true;
    }

    public function handle() {
        echo "Isch Händel dat!";
    }

}

$rest = new \eu\maxschuster\smallrest\SmallRESTService($_GET['_REWRITE_']);
$testHandler = new TestHandler($rest);
$rest->registerHandler($testHandler);
//$rest->removeHandler($testHandler);

try {
    $rest->handle();
} catch (\eu\maxschuster\smallrest\NoResponsibleHandlerFoundException $re) {
    http_response_code(400);
}
?>