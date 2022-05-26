<?php

    require __DIR__.'/vendor/autoload.php';
    require 'classes/User.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    session_start();
   // setcookie('type', '');
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
    //echo bin2hex($_SESSION['user'].".email");
    if(array_key_exists('user', $_SESSION) && !empty($_SESSION['user'])){
        
        if(array_key_exists('param', $_GET)&& !empty($_GET['param'])){

            if(hex2bin($_GET['param'])==$_SESSION['user'].".pass"){
                
                    // echo '<div>
                     echo   '<input type="text" placeholder="New password" name = newPass id="ps2" class="inputs">';
                    // </div>';
     
             
             }
     
             else if(hex2bin($_GET['param'])==$_SESSION['user'].".name"){
                
                    // echo '<div>
                     echo   '<input type="text" placeholder="Username" name = newUsername id="name" class="inputs">';
                      //</div>';
           
             }  
     
             else if(hex2bin($_GET['param'])==$_SESSION['user'].".email"){
               
                    // echo '<div>
                     echo  '<input type="text" placeholder="Email" name = newEmail id="email" class="inputs">';
                     echo  '<span id="answer"></span>';
                     //echo  '</br>';
                    // </div>';
        
             }  
     
         }

        /* else if(count($_GET)==0){
            
            echo '<div><button value="username" class="btn">Username</button></div>';
            echo '<div><button value="email" class="btn">E-mail</button></div>';
            echo '<div><button value="password" class="btn">Password</button></div>';
            echo '<p id="#answer"></p>';
        }*/


    }

    else{
        header("Location:quizzes.online.php");
    }

?>
    
    <button id="send">send</button>
    
</div>
</body>
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
        $(document).on('click','#send',function(){
                var param = $('.inputs').attr('name');
                var value = $('.inputs').val();
                var name = '<?=$_SESSION['user']?>';
                    $.ajax({
                        url:'InfoChanging.php',
                        method:'POST',
                        data:{param:param, value:value, name:name},
                        success:function(data){
                            console.log('dfs');
                            $('#answer').fadeIn();
                            $('#answer').html(data);
                        }
                    });
            });
    });
</script> 
</html>