<?php

/**
 * This file contains the interface "HandlerInterface" for all request handlers
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

namespace eu\maxschuster\smallrest;

/**
 * Interface for all request handlers
 * @author Max Schuster <dev@maxschuster.eu>
 * @package smallrest
 */
interface HandlerInterface {
    
    /**
     * Function that gets triggered if this handler is responsible for the
     * current request.
     */
    public function handle();

    /**
     * Checks if this handler is responsible for the current request
     * @return bool Is responsible?
     */
    public function checkResponsibility();
    
}

?>
