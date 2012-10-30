<?php

namespace eu\maxschuster\smallrest\errormessages;

/**
 * Description of CouldNotHandleRequest
 *
 * @author mschuster
 */
class CouldNotHandleRequest extends ErrorMessage {
    
    public function __construct($message = 'This REST Server does not offer the requested service!', $title = 'Error 400: Bad Request', $statusCode = 400) {
        parent::__construct($message, $title, $statusCode);
    }
    
}

?>
