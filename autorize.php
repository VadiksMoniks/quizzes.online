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
    <link rel="stylesheet" href="./styles/forForms.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    </head>
<body>
    <div class="formDiv">
<?php
//var_dump($_COOKIE);
    echo '<form method="POST" action="autorize.php">';

        if($_GET['s']=='Up'){
         //   echo '<div class="form__group">';
            echo '<input type="text" placeholder="Username" class="form__input" name="username" />';
            echo '<br>';
          //  echo '</div>';
           // echo '<div class="form__group">';
            echo '<input type="email" placeholder="Email" class="form__input" name="userlogin" id="email"/>';
            echo '<span id="answer"></span>';
            echo '<br>';
          //  echo '</div>';

           // echo '<div class="form__group">';
            echo '<input type="password" placeholder="Password" class="form__input" name="userpassword" />';
            echo '<br>';
           // echo '</div>';
            echo '<input class="btn" type="submit" name="Up" value="send">';
            if(array_key_exists('message', $_COOKIE) && $_COOKIE['message']!='none'){
                echo $_COOKIE["message"];
            }
        
        }

        else if($_GET['s']=="In"){
           // echo '<div class="form__group">';
            echo '<input type="text" placeholder="User Login" class="form__input" name="userlogin" />';
            echo '<br>';
            //echo '</div>';
            //echo '<div class="form__group">';
            echo '<input type="password" placeholder="User Password" class="form__input" name="userpassword" />';
            echo '<br>';
           // echo '</div>';
            echo '<input class="btn" type="submit" name="In" value="send">';
            if(array_key_exists('message', $_COOKIE) && $_COOKIE['message']!='none'){
                echo $_COOKIE["message"];
            }
        }

    echo '</form>';

?>
    </div>

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
<script>
    $(document).ready(function(){
        $('#email').keyup(function(){
            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url:'validEmail.php',
                    method:'POST',
                    data:{query:query},
                    success:function(data){
                        $('#answer').fadeIn();
                        $('#answer').html(data);
                    }
                });
            }
           else{
                $('#answer').fadeOut();
            }
        });
       /* $(document).on('click', 'li', function(){
            $('#quizName').val($(this).text());
            $('#quizList').fadeOut();
        });*/
    });
</script> 
</body>
</html>