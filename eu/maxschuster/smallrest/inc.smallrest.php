<?php

/**
 * This file includes all necessary files for SmallREST
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

// Exceptions
require_once 'exceptions/SmallRESTServiceException.php';
require_once 'exceptions/NoResponsibleHandlerFoundException.php';

// Error messages
require_once 'errormessages/ErrorMessage.php';
require_once 'errormessages/CouldNotHandleRequest.php';

// Classes conaining the logic
require_once 'SmallRESTService.php';
require_once 'HandlerInterface.php';


?>
