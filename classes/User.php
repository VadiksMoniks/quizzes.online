<?php

    class User{

       private  $login;
       private  $password;
       private  $username;
       private  $LvL;

        public function connection(){
            $host = "localhost";
            $userLog = "root";
            $passwordUser = "";
            $dbname = "quizonline";
            $dsn = 'mysql:host='.$host.';dbname='.$dbname;
            $pdo = new PDO($dsn, $userLog, $passwordUser);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        }  

        public function signIn($login, $password){
            $pdo = $this->connection();
            $this->login = $login;
            $this->password = $password;

            $sql = $pdo->prepare("SELECT * FROM `users` WHERE `userlogin`=?");
            $sql->execute([$this->login]);
            $result = $sql->fetch();
            if($result==NULL){
                return "No such user";
                $_SESSION['message']=='No such user';
            }

            else{
                if(password_verify($this->password, $result->userpassword)==1){
                    //session_start();
                    $_SESSION['user'] = $result->username;
                    //header("Location: quizzes.online.php");
                    return 'done';

                }
                else{
                    return "Wrong login or password";
                    $_SESSION['message']=='Wrong login or password';
                }
            }
        }

        public function signUp($username, $login, $password){
            $pdo = $this->connection();
            $this->login = $login;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            $this->username = $username;

            $sql = $pdo->prepare("SELECT * FROM `users` WHERE `userlogin`=?");
            $sql->execute([$this->login]);
            $result = $sql->fetch();

            if($result==NULL){
                $this->LvL = 1;
                $sql = $pdo->prepare("INSERT INTO `users` VALUES(?,?, ?, ?, ?,?)");
                $sql->execute([NULL,$this->username, $this->login, $this->password, $this->LvL,NULL]);

                //session_start();
                $_SESSION['user'] = $this->username;
                //header("Location: quizzes.online.php");
                return 'done';
            }
            else{
                return "Such user is allready exist";
                $_SESSION['message']=='Such user is allready exist';
            }
        }

        public function signOut(){
            if(!empty($_SESSION["user"])){
                unset($_SESSION["user"]);
                session_destroy();
                header("Location: quizzes.online.php");
            }
        }

        public function getXp($mark){
            //добавить ограничение для макс уровня пусть будет 10
            if(!empty($_SESSION['user'])){
                $pdo = $this->connection();
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
                    $sql=$pdo->prepare("UPDATE `users` SET `userlvl` = ? WHERE `username` = ? ");
                    $sql->execute([$result->userlvl+1,$_SESSION['user']]);
                }
            }
        }
    }

        //$user = new User();
        //$user->signUp('test', 'test@test.com', 'test');
        //echo $user->signIn('test@test.com', 'tet');
        //echo $_SESSION['user'];
        //echo $user->signOut();
        //echo $_SESSION['user'];
        
?>