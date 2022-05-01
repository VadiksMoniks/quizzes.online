<?php

    class User{

       private static $login;
       private static $password;
       private static $username;
       private static $LvL;

        public static function connection(){
            $host = "localhost";
            $userLog = "root";
            $passwordUser = "";
            $dbname = "quizonline";
            $dsn = 'mysql:host='.$host.';dbname='.$dbname;
            $pdo = new PDO($dsn, $userLog, $passwordUser);
            return $pdo;
        }  

        public static function loginUser($login, $password){
            $pdo = User::connection();
            User::$login = $login;
            User::$password = $password;

            $sql = $pdo->prepare("SELECT * FROM `users` WHERE `userlogin`=?");
            $sql->execute([User::$login]);
            $result = $sql->fetch();

            if($result==NULL){
                return "No such user";
            }

            else{
                if(password_verify($password, $result->password)==1){
                    session_start();
                    $_SESSION['user'] = $result->username;
                    header("Location: quizzes.online.php");

                }
                else{
                    return "Wrong login or password";
                }
            }
        }

        public static function registrate($username, $login, $password){
            $pdo = User::connection();
            User::$login = $login;
            User::$password = password_hash($password, PASSWORD_DEFAULT);
            User::$username = $username;

            $sql = $pdo->prepare("SELECT * FROM `users` WHERE `userlogin`=?");
            $sql->execute([User::$login]);
            $result = $sql->fetch();

            if($result==NULL){
                User::$LvL = 1;
                $sql = $pdo->prepare("INSERT INTO `users` VALUES(null, ?, ?, ?, ?, null)");
                $sql->execute([User::$username, User::$login, User::$password, User::$LvL]);

                session_start();
                $_SESSION['user'] = User::$username;
                header("Location: quizzes.online.php");
            }
            else{
                return "Such user is allready exist";
            }
        }

        public static function logOut(){
            if(!empty($_SESSION["user"])){
                unset($_SESSION["user"]);
                session_destroy();
                header("Location: quizzes.online.php");
            }
        }

        public static function getXp($mark){
            //добавить ограничение для макс уровня пусть будет 10
            if(!empty($_SESSION['user'])){
                $pdo = User::connection();
                $sql=$pdo->prepare("SELECT `userlvl` FROM `users` WHERE `username` = ?");
                $sql->execute([$_SESSION['user']]);
                $result = $sql->fetch();

                $xpToNextLvL = (($result->userlvl)+1)*20;
                
                if(!empty($_COOKIE['currentXP'])){
                    setcookie('currentXP', $_COOKIE['currentXP']+$mark);
                }
                else{
                    setcookie('currentXP', $mark);
                }

                if($_COOKIE['currentXP']>$xpToNextLvL){
                    setcookie('currentXP', $_COOKIE['currentXP']-$xpToNextLvL);
                    $sql=$pdo->prepare("UPDATE `users` WHERE `username` = ? SET `userlvl` = ?");
                    $sql->execute([$_SESSION['user'], $result->userlvl+1]);
                }
            }
        }
    }

?>