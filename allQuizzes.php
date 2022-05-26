<?php
    session_start();
    include 'connection.php';
    require 'classes/User.php';
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
                <a href = "quizzes.online.php"><li>Quizzes Online</li></a>
                <a href="allQuizzes.php"><li>
                    All Quizzes
                    <ul>
                        <a href="allQuizzes.php?category=Mathematics"><li>Mathematics</li></a>
                        <a href="allQuizzes.php?category=Philosophy"><li>Philosophy</li></a>
                        <a href="allQuizzes.php?category=Physics"><li>Physics</li></a>
                        <a href="allQuizzes.php?category=History"><li>History</li></a>
                        <a href="allQuizzes.php?category=Art"><li>Art</li></a>
                        <a href="allQuizzes.php?category=Music"><li>Music</li></a>
                        <a href="allQuizzes.php?category=Programming"><li>Programming</li></a>
                        <a href="allQuizzes.php?category=Biology"><li>Biology</li></a>
                        <a href="allQuizzes.php?category=Law"><li>Law</li></a>
                        <a href="allQuizzes.php?category=Sport"><li>Sport</li></a>
                    </ul>
                </li></a>
                <a href = "random.php"><li>Random Quiz</li></a>
                <?php
                
                if(empty($_SESSION['user'])){
                   
                    echo'<li>';
                    echo'Join Us';
                    echo'<ul>';
                    echo '<form action="autorize.php" method="GET">';
                    echo'<a href="autorize.php?s=In"><li class="last">Sign In</li></a>';
                    echo'<a href="autorize.php?s=Up"><li class="last">Sign In</li></a>';
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
                    echo' <a href="logOut.php"><li class="last">Sign Out</li></a>';
                    echo'</ul>';
                    echo'</li>';
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div id="autoComplete">
            <div>
                <input type="text" name="quizName" id="quizName" placeholder="Enter the quiz you looking for">
            </div>
            <div id="quizList"></div>
        </div>
    

    <script>
        $(document).ready(function(){
            $('#quizName').keyup(function(){
                var query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url:'search.php',
                        method:'POST',
                        data:{query:query},
                        success:function(data){
                            $('#quizList').fadeIn();
                            $('#quizList').html(data);
                        }
                    });
                }
                else{
                    $('#quizList').fadeOut();
                }
            });
            $(document).on('click', 'li', function(){
                $('#quizName').val($(this).text());
                $('#quizList').fadeOut();
            });
        });
    </script> 
<div id='quizResults'>
<?php

    if(!empty($_GET['category'])){
        $sql = $pdo->prepare("SELECT `quizname` FROM `quiz` WHERE `category` = ?");
        $sql->execute([$_GET['category']]);

        if($sql->rowCount()>0){

            for($i=0; $i<$sql->rowCount(); $i++){
                $result = $sql->fetch();
                echo '<div>';
                echo "<a href=quiz.php?n=".$result->quizname.">.$result->quizname.</a>";
                echo '</div>';
            }
        }
        else{
            echo "No such category";
        }

    }
    else{
        $sql = $pdo->prepare("SELECT `quizname` FROM `quiz`");
        $sql->execute();
        for($i=0; $i<$sql->rowCount(); $i++){
            $result = $sql->fetch();
            echo '<div style="margin-bottom:15px;">';
            echo "<a href=quiz.php?n=".$result->quizname." class='name'>".$result->quizname."</a>";
            echo '</div>';
        }
    }

?>
</div>
</div>
</body>
</html>
    
    