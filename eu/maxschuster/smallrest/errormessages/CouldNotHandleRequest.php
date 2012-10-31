<?php

/**
 * This file contains the error message "CouldNotHandleRequest".
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

namespace eu\maxschuster\smallrest\errormessages;

/**
 * Description of CouldNotHandleRequest
 * @author Max Schuster <dev@maxschuster.eu>
 * @package smallrest
 */
class CouldNotHandleRequest extends ErrorMessage {
    
    /**
     * ErrorMessage constructor
     * @param string $message [optional]
     * @param string $title [optional]
     * @param int $statusCode [optional]
     */
    public function __construct($message = 'This REST Server does not offer the requested service!', $title = 'Error 400: Bad Request', $statusCode = 400) {
        parent::__construct($message, $title, $statusCode);
    }
    
}

?>
