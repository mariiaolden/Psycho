<?php
    session_start();
    $err = array();

    include './registration.php';

    foreach($array as $key => $val) {
        echo $val;
    }

 include './login.html';
?>
