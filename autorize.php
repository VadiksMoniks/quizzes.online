<?php

    
        setcookie('message', 'none');
    

    if(!session_id()){
        session_start();
    }

    require 'classes/User.php';
    if(isset($_SESSION['user'])){
        header('Location:quizzes.online.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
    </head>
<body>
<?php
var_dump($_COOKIE);
    echo '<form method="POST" action="autorize.php">';

        if($_GET['s']=='Up'){
            echo '<div class="form__group">';
            echo '<input type="text" placeholder="Username" class="form__input" name="username" />';
            echo '</div>';
            echo '<div class="form__group">';
            echo '<input type="email" placeholder="Email" class="form__input" name="userlogin" />';
            echo '</div>';

            echo '<div class="form__group">';
            echo '<input type="password" placeholder="Password" class="form__input" name="userpassword" />';
            echo '</div>';
            echo '<input class="btn" type="submit" name="Up" value="send">';
            if(array_key_exists('message', $_COOKIE) && $_COOKIE['message']!='none'){
                echo $_COOKIE["message"];
            }
        
        }

        else if($_GET['s']=="In"){
            echo '<div class="form__group">';
            echo '<input type="text" placeholder="User Login" class="form__input" name="userlogin" />';
            echo '</div>';
            echo '<div class="form__group">';
            echo '<input type="password" placeholder="User Password" class="form__input" name="userpassword" />';
            echo '</div>';
            echo '<input class="btn" type="submit" name="In" value="send">';
            if(array_key_exists('message', $_COOKIE) && $_COOKIE['message']!='none'){
                echo $_COOKIE["message"];
            }
        }

    echo '</form>';

?>

<?php
//var_dump($_POST);
    if(array_key_exists('userlogin',$_POST)&&array_key_exists('userpassword',$_POST)){
        if(array_key_exists('username', $_POST)){
            $user = new User();
            $r = $user->signUp($_POST['username'], $_POST['userlogin'], $_POST['userpassword']);
            if($r=='done'){
                setcookie("message", "", time() - 3600);
                header("Location: quizzes.online.php");
            }
            else{
                setcookie('message', $r);
                header("Location:autorize.php?s=Up");
            }

        }

        else{
            $user = new User();
            $r = $user->signIn($_POST['userlogin'], $_POST['userpassword']);
            //echo $r;
            if($r=='done'){
                setcookie("message", "", time() - 3600);
                header("Location:quizzes.online.php");
            }
            else{
                //echo $r; 
                setcookie('message', $r);
                header("Location:autorize.php?s=In");
            }
           // header("Location: quizzes.online.php");
        }
    }
   
        
?>
</body>