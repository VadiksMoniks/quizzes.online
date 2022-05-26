<?php

    session_start();

    if(array_key_exists('user', $_SESSION)==0){
        header('Location:quizzes.online.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
<body>
    <?php
        echo '<div><button value="username" class="btn">Username</button></div>';
        echo '<div><button value="email" class="btn">E-mail</button></div>';
        echo '<div><button value="password" class="btn">Password</button></div>';
        echo '<p id="answer"></p>';
    ?>
</body>


<script>
    $(document).ready(function(){
        $(document).on('click','.btn',function(){
                var query = $(this).val();
                var name = '<?=$_SESSION['user']?>';
                    $.ajax({
                        url:'sendMail.php',
                        method:'POST',
                        data:{query:query, name:name},
                        success:function(data){
                            $('#answer').fadeIn();
                            $('#answer').html(data);
                        }
                    });
            });
    });
</script> 
</html>