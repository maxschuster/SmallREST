<?php

namespace eu\maxschuster\smallrest;

/**
 *
 * @author mschuster
 */
interface HandlerInterface {
    
    public function handle();

    public function checkResponsibility();
    
}

?>
