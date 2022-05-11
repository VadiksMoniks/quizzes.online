<?php
    if(!session_id()){
        session_start();
    }
    //var_dump($_SESSION);
    require_once 'classes/User.php';
    //fgdfh
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
    <link rel="stylesheet" href="./css/style.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <div class="nav-bar">
            <ul class="nav-list">
                <li>Home</li>
                <li>
                    Portfolio
                    <ul>
                        <li>Web Design</li>
                        <li>Web Development</li>
                        <li>Illustrations</li>
                    </ul>
                </li>
                <li>About</li>
                <li>Blog</li>
                <?php
                
                    if(empty($_SESSION['user'])){
                       
                        echo'<li>';
                        echo'Join Us';
                        echo'<ul>';
                        echo '<form action="autorize.php" method="GET">';
                        echo'<li class="last popup_open" ><button class="btn" name="s" value="In">Sign In</button></li>';
                        echo'<li class="last popup_open"><button class="btn" name="s" value="Up">Sign Up</button></li>';
                        echo "</form>";
                        echo'</ul>';  
                        echo'</li>';
                       
                    }
                    else if(!empty($_SESSION['user'])){

                        $user = new User();

                        echo'<li>';
                        echo $_SESSION['user'];
                        echo'<ul>';
                        echo' <li class="last">Personal cabinet</li>';
                        echo' <li class="last">Settings</li>';
                        //echo' <a href="#"><li class="last">'.$user->signOut().'</li></a>';
                        echo'</ul>';
                        echo'</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class='popup'>
            <form class="form " method="POST">
                <div class="form__group">
                    <button class="popup_close">close</button>
                </div>
                
                    <?php 
                    //var_dump($_POST);
                        //if($_POST['target']=='signUp')
                       // {   
                            //unset($_POST);
                            echo '<form method="POST">';
                            echo '<div class="form__group">';
                            echo '<input type="text" placeholder="Username" class="form__input" name="username" />';
                            echo '</div>';
                            echo '<div class="form__group">';
                            echo '<input type="email" placeholder="Email" class="form__input" name="userlogin" />';
                            echo '</div>';

                            echo '<div class="form__group">';
                            echo '<input type="password" placeholder="Password" class="form__input" name="userpassword" />';
                            echo '</div>';
                            echo '<button class="btn" type="button" name="Up">Sign Up</button>';
                            echo '</form>';
                            //User::signUp($_POST['username'], $_POST['userlogin'], $_POST['userpassword']);
                      //  }

                        /*else if($_POST['target']=='signIn'){
                            unset($_POST);
                            echo '<div class="form__group">';
                            echo '<input type="text" placeholder="User Login" class="form__input" name="userlogin" />';
                            echo '</div>';
                            echo '<div class="form__group">';
                            echo '<input type="text" placeholder="User Password" class="form__input" name="userpassword" />';
                            echo '</div>';
                            echo '<button class="btn" type="button" name="In">Sign In</button>';
                        }*/
                    ?>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
            $('.popup_open').click(function(){
            $('.popup').css('visibility' ,'visible');
            $('.popup').css('opacity','1');
            })
        }); 
        $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
        $('.popup_close').click(function(){
            $('.popup').css('visibility' ,'hidden');
            $('.popup').css('opacity','0');
            })
        });

       /* $(document).ready(function(){
       // var id;
        $('.btn').on('click', function(){
            
            var value = $(this).val();
            //console.log(
            console.log($(this).val());
            $.ajax({
            type: "POST",
            url: 'quizzes.online.php',
            data: {target: value},
            })
            .done(function(msg) {
              //  alert( "Data Saved: " + msg);
            });
        })
    });*/
</script>
</body>
</html>
<?php

    /*if(array_key_exists('Up', $_POST)){
        User::signUp($_POST['username'], $_POST['userlogin'], $_POST['userpassword']);
    }
    else if(array_key_exists('In', $_POST)){
        User::signIn($_POST['userlogin'], $_POST['userpassword']);
    }*/

?>