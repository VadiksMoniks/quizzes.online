<?php
    //session_start();
    require_once 'classes/User.php';
    //fgdfh
?>

<!DOCTYPE HTML PUBLIC>
<!DOCTYPE html>
<html>
<head>
<tittle></tittle>
<meta charset="utf-8">
<link href="styles/mainPageStyles.css" rel="stylesheet" type="text/css">
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
    <body>
    <div class="menuBar">
        <div class="Punkts">
            <ul class="menuPunkts">
                <a href="quizzes.online.php"><li class="menuP" >Main</li></a>
                <a href="allQuizzes.php"><li class="menuP" >All Quizzes</li></a>
                <a href=""><li class="menuP" >Quizzes for ME!</li></a>
                
  
                
            <?php  
                echo '<div class="dropdown">';

                if(empty($_SESSION['user'])){
                    echo '<li class="menuP dropbtn" id="subHov">Join our FAMILY!</li>';
                }
                else{
                    echo '<li class="menuP dropbtn"" id="subHov">'.$_SESSION['user'].'</li>';
                }
               
                echo '<div class="dropdown-content">';
                echo '<ul vlass="subMenuPunkts"></ul>';
                    if(!empty($_SESSION['user'])){
                    
                        echo '<li id="userName" class="subPunckt">'.$_SESSION['user']."</li>";
                        echo        '<li class="subPunckt">Personal Cabinet</li>';
                        echo        '<a href = "#" id="logut"><li class="subPunckt">Log Out'.User::logOut().'</li></a>';
                    
                    
                    } 
                        
                    else{
                        echo '<a href="#"><li class="subPunckt popup-link">Log In</li></a>';
                        echo '<a href="#"><li class="subPunckt popup-linkR">Registrate for FREE</li></a>';

                        
                    }    
                    echo '</div>';   
                    echo '</div>';
            ?>  

            </ul>
          </div>
    </div>
    <div id="popup" class="popup">
    <div class="popup_body">
        <div class="popup_content">
            <button class="popup_close">close</button>
            <div class="popup_title"></div>
            <div class='popup_text'>
                <form method="POST"> 
                    <?php 
                        echo '<input type="text" placeholder="login" required name="userlogin"></br>';
                        echo '<input type="password" placeholder="password" required name="userpassword"></br>';
                        echo '<input type="submit" value="send">';
                        if(!empty($_POST['userlogin'])&&!empty($_POST['userlogin'])){
                            User::loginUser($_POST["userlogin"], $_POST["userpassword"]); 
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>

    <div id="popupR" class="popupR">
    <div class="popup_body">
        <div class="popup_content">
            <button class="popup_closeR">close</button>
            <div class="popup_title"></div>
            <div class='popup_text'>
                <form method="POST"> 
                    <?php 
                        echo '<input type="text" placeholder="username" required name="username"></br>';
                        echo '<input type="text" placeholder="login" required name="userlogin"></br>';
                        echo '<input type="password" placeholder="password" required name="userpassword"></br>';
                        echo '<input type="submit" value="send">';
                        if(!empty($_POST['userlogin'])&&!empty($_POST['userlogin'])&&!empty($_POST['username'])){
                            User::registrate($_POST["username"],$_POST["userlogin"], $_POST["userpassword"]); 
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
        $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
        $('.popup-link').click(function(){
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
</script>
<script>
        $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
        $('.popup-linkR').click(function(){
         $('.popupR').css('visibility' ,'visible');
         $('.popupR').css('opacity','1');
      })
    });

    $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
        $('.popup_closeR').click(function(){
         $('.popupR').css('visibility' ,'hidden');
         $('.popupR').css('opacity','0');
      })
    }); 
</script>
    </body>