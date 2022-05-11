<?php
    require 'classes/User.php';
    session_start();
    if(!isset($_COOKIE[$_GET['n']])){
        setcookie($_GET['n'], ' ');
    }
    setcookie("a", "", time() - 3600);
    //if(!isset($_COOKIE['currentXP'])){
      //  setcookie('currentXP', '');
   // }
?>
<!DOCTYPE html>
<html>
<head>
<tittle></tittle>
</head>
<body>
    <form method="POST">
        <?php
           //gasgas
            //setcookie($_GET['n'], '', -3600);
            $fileName = "quizzes_tasks/" . $_GET['n'] . ".txt";

            if (file_exists($fileName)) {
                $handle = fopen($fileName, 'r');
                $string = fread($handle, filesize($fileName));
                $questions = explode(";", $string);
                $qANDa = array();

                for ($i = 0; $i < count($questions); $i++) {
                    array_push($qANDa, explode(":", $questions[$i]));
                }

                for ($i = 0; $i < count($qANDa); $i++) {
                    for ($j = 0; $j < count($qANDa[$i]); $j++) {
                        if (preg_match('/[\d]{1}[\s]{2}/', $qANDa[$i][$j]) == true) {
                            echo "<p>" . $qANDa[$i][$j] . "</p>";
                        } else {
                            echo '<input type="radio" value="' . $j . '" name="a_' . $i . '" id="q"' . $j . '><label for="q' . $j . '" required>' . $qANDa[$i][$j] . '</label></br>';
                        }
                    }
                }
                echo '</br>';
                if (!empty($_COOKIE[$_GET['n']]) && $_COOKIE[$_GET['n']]==='done') {
                    echo "You've allready passed this test";
                    //recomendations for tests like this
                } else {
                    echo '<button name="done">send</button>';
                }
            } 

            else {
                //переадреация на страницу 404
                echo "This test doesn't exist... YET";
            }
        ?>
    </form>
</body>

<?php
    if(array_key_exists('done', $_POST) && $_COOKIE[$_GET['n']]===' '){
        array_pop($_POST);
        setcookie($_GET['n'], 'done');
        $answersFileName = "quizzes_answers/".$_GET['n'].".txt";

        $handle = fopen($answersFileName, 'r');
        $string = fread($handle, filesize($answersFileName));
        $answers = explode(';', $string);
        $mark=0;

        echo "<p>Answers</p>";
        foreach($_POST as $key=>$item){
        for($i=0; $i<count($answers); $i++){
                if(substr($key, -1) == $i){
                    if($item==$answers[$i]){
                        $mark++;
                        $n=(substr($key, -1))+1;
                        echo $n." You answered correct</br>";
                    }
                    else{
                        $n=(substr($key, -1))+1;
                        echo $n." Your answer: ".$item."  Correct answer: ".$answers[$i]."</br>";
                    }
                }
                else{
                    continue;
                }
            }
        }
            echo "</br>";
            echo "Mark: ".$mark;
            if(!empty($_SESSION['user'])){
                $user = new User();
                $user->getXp($mark);
                echo $_COOKIE['currentXP'];
                var_dump($_COOKIE);
            }
 
    }

 /*
    нужно после віполнения теста записівать его ву кукки, оценку записіваать в пользователя и еще делать проверку на регистрацию
     а так же добавить попап для подтверждения отправки(тут можно через js сделать проверку кол-ва введенных ответов)
 */


?>