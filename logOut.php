<?php
    require 'classes/User.php';
    session_start();
    if(array_key_exists('user', $_SESSION)){
        $user = new User();
        $user->signOut();
    }
    else{
        session_destroy();
        header("Location:quizzes.online.php");
    }

?>