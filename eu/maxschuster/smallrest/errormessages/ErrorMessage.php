<?php

/**
 * This file contains the error message "ErrorMessage" which is the basic error
 * message for SmallREST.
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
 * The basic error message for SmallREST.
 * @author Max Schuster <dev@maxschuster.eu>
 * @package smallrest
 */
class ErrorMessage {
    /**
     * Message
     * @var string
     */
    protected $message;
    
    /**
     * HTTP Status code
     * @var int
     */
    protected $statusCode;
    
    /**
     * Message title
     * @var string
     */
    protected $title;
    
    /**
     * ErrorMessage constructor
     * @param string $message [optional]
     * @param string $title [optional]
     * @param int $statusCode [optional]
     */
    public function __construct($message = 'An unkown REST Server error occured!', $title = 'Error 500: Internal Server Error', $statusCode = 500) {
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->title = $title;
    }
    
    /**
     * Output the message.
     */
    public function outputMessage() {
        ob_clean();
        header(':', true, $this->statusCode);
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>$this->title</title>
    </head>
    <body>
        <h1>$this->title</h1>
        <p>
            $this->message
        </p>
    </body>
</html>";
    }


}

?>
