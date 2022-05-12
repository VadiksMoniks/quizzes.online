<?php
    include 'connection.php';
    
    $sql = $pdo->prepare("SELECT * FROM `quiz`");
    $sql->execute();
    $result = $sql->fetchAll();

    $randomNumber = random_int(1, count($result));

    $sql = $pdo->prepare("SELECT `quizname` FROM `quiz` WHERE `id` = ?");
    $sql->execute([$randomNumber]);

    $result = $sql->fetch();
    if($_COOKIE[$result->quizname]!="done"){
        header("Location:quiz.php?n=".$result->quizname);
    }
    else{
        header("Location:random.php");
    }
    
?>