<?php

namespace eu\maxschuster\smallrest;

use \Exception;

/**
 * Description of RESTServiceException
 *
 * @author mschuster
 */
class SmallRESTServiceException extends Exception {
    
    public function __construct($message = '', $code = 0, Exception $previous = null) {
        if (!empty($message)) {
            $message = 'An unknowen RESTService Error occured!';
        }
        parent::__construct($message, $code, $previous);
    }

    
}

?>
