<?php
    $match = "test@test.com";
    if(preg_match("/[a-z0-9._]+@[a-z]{3,}\.[a-z]{3,}/", $_POST['query'])){
        echo 'Valid e-mail';
    }
    else{
        echo 'Invalid e-mail';
    }

?>