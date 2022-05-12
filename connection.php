<?php

    $host = "localhost";
    $userLog = "root";
    $passwordUser = "";
    $dbname = "quizonline";
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;
    $pdo = new PDO($dsn, $userLog, $passwordUser);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>