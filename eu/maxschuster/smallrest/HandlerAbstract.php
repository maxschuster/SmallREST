<?php

namespace eu\maxschuster\smallrest;

/**
 * Description of HandlerAbstract
 *
 * @author mschuster
 */
abstract class HandlerAbstract implements HandlerInterface {
    
    public function handle() {
        $result = null;
        switch (SmallRESTService::getInstance()->getType()) {
            case SmallRESTService::TYPE_GET:
                $result = $this->get();
                break;
            case SmallRESTService::TYPE_POST:
                $result = $this->create();
                break;
            case SmallRESTService::TYPE_PUT:
                $result = $this->update();
                break;
            case SmallRESTService::TYPE_DELETE:
                $result = $this->delete();
                break;
        }
        echo json_encode($result);
    }
    
    abstract public function create();

    abstract public function delete();

    abstract public function get();

    abstract public function update();
    
}

?>
