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
                <!--<li>Blog</li>-->
                <?php
                
                    if(empty($_SESSION['user'])){
                       
                        echo'<li>';
                        echo'Join Us';
                        echo'<ul>';
                        echo '<form action="autorize.php" method="GET">';
                        echo'<a href="autorize.php?s=In"><li class="last">Sign In</li></a>';
                        echo'<a href="autorize.php?s=Up"><li class="last">Sign Up</li></a>';
                        echo "</form>";
                        echo'</ul>';  
                        echo'</li>';
                       
                    }
                    else if(!empty($_SESSION['user'])){

                        //$user = new User();

                        echo'<li>';
                        echo $_SESSION['user'];
                        echo'<ul>';
                        echo' <a href = "profile.php"><li class="last">Profile</li></a>';
                        echo' <a href ="settings.php"><li class="last">Settings</li></a>';
                        echo' <a href="logOut.php"><li class="last">Sign Out</li></a>';
                        echo'</ul>';
                        echo'</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="main-content">
        
    </div>
</body>
</html>
<?php

?>