<?php

    session_start();

    $host = "localhost";
    $userLog = "root";
    $passwordUser = "";
    $dbname = "quizonline";
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;
    $pdo = new PDO($dsn, $userLog, $passwordUser);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    if(!empty($_GET['category'])){
        $sql = $pdo->prepare("SELECT `quizname` FROM `quiz` WHERE `category` = ?");
        $sql->execute([$_GET['t']]);

        if($sql->rowCount()>0){

            for($i=0; $i<$sql->rowCount(); $i++){
                $result = $sql->fetch();
                echo "<a href=quiz.php?n=".$result->quizname.">.$result->quizname.</a>";
            }
        }
        else{
            echo "No such category";
        }

    }
    else{
        $sql = $pdo->prepare("SELECT `quizname` FROM `quiz`");
        $sql->execute();
        for($i=0; $i<$sql->rowCount(); $i++){
            $result = $sql->fetch();
            echo "<a href=quiz.php?n=".$result->quizname.">.$result->quizname.</a>";
        }
    }

?>
    
    