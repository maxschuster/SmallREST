<?php

namespace eu\maxschuster\smallrest\exceptions;

use \Exception;

/**
 * Description of NoResponsibleHandlerFoundException
 *
 * @author mschuster
 */
class NoResponsibleHandlerFoundException extends SmallRESTServiceException {
    
    public function __construct($message = '', $code = 0, Exception $previous = null) {
        if (!empty($message)) {
            $message = 'No responsible handler found!';
        }
        parent::__construct($message, $code, $previous);
    }

    
}

?>
