<?php
  
require 'eu/maxschuster/rest/inc.rest.php';

use eu\maxschuster\rest\RESTRequest;

$req = new RESTRequest('hatschie/schnief/reusber/hust/grummel.json');

var_dump($req->keywordValue('hatschie',1), $req->keywordValue('hatschie', array(2,3)));

?>