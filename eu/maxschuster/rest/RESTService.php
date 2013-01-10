<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace eu\maxschuster\rest;

/**
 * Description of RESTService
 *
 * @author mschuster
 */
class RESTService {
    
    /**
     * Standard response for successful HTTP requests. The actual response will
     * depend on the request method used. In a GET request, the response will
     * contain an entity corresponding to the requested resource. In a POST
     * request the response will contain an entity describing or containing the
     * result of the action.
     * @const STATUS_OK
     */
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_ACCEPTED = 202;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    
    /**
     * Collection of controllers
     * @var RESTServiceControllerInterface[]
     */
    protected $controllers = array();
    
    /**
     * Parsed request
     * @var RESTRequest
     */
    protected $request;

    public function __construct($uri) {
        $this->request = new RESTRequest($uri,$_SERVER['REQUEST_METHOD']);
    }
    
    /**
     * Adds one or multible controllers to the service
     * @param RESTServiceControllerInterface $controller
     * Controller for the RESTService that implements
     * the RESTServiceControllerInterface interface.
     * @param RESTServiceControllerInterface $_ [optional]
     * Additional controllers...
     * @throws \UnexpectedValueException
     */
    public function addController() {
        $n = func_num_args();
        for ($i = 0; $i < $n; $i++) {
            $c = func_get_arg($i);
            if ($c instanceof RESTServiceControllerInterface) {
                $this->controllers[get_class($c)] = $c;
                continue;
            }
            throw new \UnexpectedValueException('All controllers must implement RESTServiceControllerInterface!');
        }
    }
    
    /**
     * Get parsed request
     * @return RESTRequest Parsed request
     */
    public function getRequest() {
        return $this->request;
    }

    
}

?>
