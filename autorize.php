<?php
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
//var_dump($_SESSION);
    echo '<form method="POST" action="autorize.php">';

        if(array_key_exists('sU', $_GET)){
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
            if(isset($_SESSION['message'])){
                $_SESSION['message'];
            }
        
        }

        else if(array_key_exists('sI', $_GET)){
            echo '<div class="form__group">';
            echo '<input type="text" placeholder="User Login" class="form__input" name="userlogin" />';
            echo '</div>';
            echo '<div class="form__group">';
            echo '<input type="password" placeholder="User Password" class="form__input" name="userpassword" />';
            echo '</div>';
            echo '<input class="btn" type="submit" name="In" value="send">';
            if(isset($_SESSION["message"])){
                echo $_SESSION["message"];
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
                header("Location: quizzes.online.php");
            }
            else{
                $_SESSION['message']==$r;
                header("Location:quizzes.online.php?sU=Up");
            }

        }

        else{
            $user = new User();
            $r = $user->signIn($_POST['userlogin'], $_POST['userpassword']);
            //echo $r;
            if($r=='done'){
                header("Location:quizzes.online.php");
            }
            else{
                echo $r;
                if(!isset( $_SESSION["message"])){
                    $_SESSION["message"]==$r;
                }
                
                header("Location:autorize.php?sI=In");
            }
           // header("Location: quizzes.online.php");
        }
    }
   
        
?>
</body>