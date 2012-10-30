<?php

/**
 * This file contains the exception "NoResponsibleHandlerFoundException".
 * @author Max Schuster <dev@maxschuster.eu>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package smallrest
 */

/*
 * Copyright 2012 Max Schuster 
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace eu\maxschuster\smallrest\exceptions;

use \Exception;

/**
 * This exception will be thrown if no matching handler was found for the
 * requested service. 
 * @author Max Schuster <dev@maxschuster.eu>
 * @package smallrest
 */
class NoResponsibleHandlerFoundException extends SmallRESTServiceException {
    
    /**
     * Construct the exception
     * @param string $message [optional]
     * @param int $code [optional]
     * @param Exception $previous [optional]
     */
    public function __construct($message = '', $code = 0, Exception $previous = null) {
        if (!empty($message)) {
            $message = 'No responsible handler found!';
        }
        parent::__construct($message, $code, $previous);
    }

    
}

?>
