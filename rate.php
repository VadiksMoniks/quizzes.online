<?php

    include 'connection.php';
    //$_POST['name']='test';
    //$_POST['query']='like';
    //нужно сюда как-то получить имя теста и дописать sql query
    $sql = $pdo->prepare("SELECT `rating` FROM `quiz` WHERE `quizname` = ?");
    $sql->execute([$_POST['name']]);
    $result = $sql->fetch();
    //$result->rating = settype($result->rating, 'integer');
    if($_POST['query']=='like'){
        $sql = $pdo->prepare("UPDATE `quiz` SET `rating` = ? WHERE `quizname` = ? ");
        $sql->execute([$result->rating+=1,$_POST['name']]);
    }
    else if($_POST['query']=='dislike'){
        $sql = $pdo->prepare("UPDATE `quiz` SET `rating` = ? WHERE `quizname` = ? ");
        $sql->execute([$result->rating-=1,$_POST['name']]);
    }
    echo $ans = "Thank You. Your oppinion is very important for us!";

?>