<?php

    $host = "localhost";
    $userLog = "root";
    $passwordUser = "";
    $dbname = "quizonline";
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;
    $pdo = new PDO($dsn, $userLog, $passwordUser);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $query = $_POST['query'];
    $sql = $pdo->prepare('SELECT * FROM `quiz` WHERE `quizname` LIKE ?');
    $sql->execute(["%$query%"]);
    $result = $sql->fetchAll();
    $output = '<ul>';

    if(count($result)!=0){
        foreach($result as $name){
            $output.='<a href="quiz.php?n='.$name->quizname.'"><li>'.$name->quizname.'</li></a>';
        }
    }
    else{
        $output.='<li>No quizes found</li>';
    }

    $output.'</ul>';
    echo $output;
?>