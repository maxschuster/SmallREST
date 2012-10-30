<?php

namespace eu\maxschuster\smallrest\errormessages;

/**
 * Description of ErrorMessage
 *
 * @author mschuster
 */
class ErrorMessage {
    
    protected $message;
    protected $statusCode;
    protected $title;
    
    public function __construct($message = 'An unkown REST Server error occured!', $title = 'Error 500: Internal Server Error', $statusCode = 500) {
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->title = $title;
    }
    
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
