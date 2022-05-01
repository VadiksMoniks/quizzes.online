<?php

    session_start();

    $host = "localhost";
    $userLog = "root";
    $passwordUser = "";
    $dbname = "quizonline";
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;
    $pdo = new PDO($dsn, $userLog, $passwordUser);
    
    if(!empty($_GET['t'])){
        $sql = $pdo->prepare("SELECT `quizname` FROM `quizzes` WHERE `type` = ?");
        $sql->execute([$_GET['t']]);
    }
    else{
        $sql = $pdo->prepare("SELECT `quizname` FROM `quizzes`");
        $sql->execute();
    }

    if($sql->rowCount()>0){

            for($i=0; $i<$sql->rowCount(); $i++){
                $result = $sql->fetch();
                echo "<a href=quiz.php?n=".basename($result->quizname);
            }
    }
    else{
        echo "No such category";
    }


?>
    
    