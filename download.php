<?php
    header("Content-Type: application/force-download");
    header('Content-Description: File Transfer');
    header('Content-disposition: attachment; filename=smallrest.phar');
    $f = fopen('phar/smallrest.phar', 'r');
    fpassthru($f);
?>