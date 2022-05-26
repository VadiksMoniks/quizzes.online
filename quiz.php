<?php
    require 'classes/User.php';
    session_start();
    if(!isset($_COOKIE[$_GET['n']])){
        setcookie($_GET['n'], ' ');
    }
    //if(!isset($_COOKIE['currentXP'])){
      //  setcookie('currentXP', '');
   // }
?>
<!DOCTYPE html>
<html>
<head>
<tittle></tittle>
<link rel="stylesheet" href="./styles/quizPage.css">
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  
</head>
<body>
    <a href="allQuizzes.php">Back</a>
    <div id="questionsBlock">
        <h2><?php echo $_GET['n']?></h2>
        <form method="POST">
        <?php
           // setcookie($_GET['n'], '', -3600);
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
                            echo '<input type="radio" value="' . $j . '" name="a_' . $i . '" id="q"' . $j . '><label for="q' . $j . '">' . $qANDa[$i][$j] . '</label></br>';
                        }
                    }  
                }
                echo '</br>';
                if (!empty($_COOKIE[$_GET['n']]) && $_COOKIE[$_GET['n']]==='done') {
                    echo "You've allready passed this test";
                    //recomendations for tests like this
                } else {
                    echo '<button name="done" id="complete">send</button>';
                }
            } 

            else {
                //переадреация на страницу 404
                echo "This test doesn't exist... YET";
            }
        ?>
     </form>
    </div>
<div id="results">
    <button id="close">close</button>

<?php
    if(array_key_exists('done', $_POST) && $_COOKIE[$_GET['n']]===' '){
        array_pop($_POST);
        setcookie($_GET['n'], 'done', time() + (3600 * 24 * 30));
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
        
        $percantageCorrect= ($mark*100)/count($answers);

        if($percantageCorrect>70 && $percantageCorrect<100){
            echo 'Keep it up! You answered correctly for '.$percantageCorrect.' of all questions';
        }

        else if($percantageCorrect>85 && $percantageCorrect<100){
            echo 'Well done! You answered correctly for '.$percantageCorrect.' of all questions';
        }

        else if($percantageCorrect==100){
            echo 'AMAZING!!! You answered correctly for ALL questions';
        }
            echo "</br>";
            echo "</br>";
            echo "Mark: ".$mark;
            echo "</br>";


            if(!empty($_SESSION['user'])){
                $user = new User();
                $user->getXp($mark);
                //echo $_COOKIE['currentXP'];
                //var_dump($_COOKIE);
            }
 
    }

?>
   
        <button class="evaluate" value="like">Like</button>
        <button class="evaluate" value="dislike">Dislike</button>
    
</div>

<script>
    $(document).ready(function(){
       /* $(document).on('click', '#complete',function(){
            $('#results').css('visibility','visible');
            $('#results').css('opacity','1');
        });*/

   /*     $(document).on('click', '#close',function(){
            $('#results').css('visibility','hidden');
            $('#results').css('opacity','0');
        });*/

        $(document).on('click', '.evaluate', function(){
            $('.btn').setAttribute('disabled', true);
            var query = $(this).val();
            var name = '<?=$_GET['n']?>';
            console.log(name);
            console.log(query);
            if(query!=''){
                $.ajax({
                    url:'rate.php',
                    method:'POST',
                    data:{query:query,name:name},
                    success:function(data){
                        
                        $('#quizList').fadeIn();
                        $('#quizList').html(data);
                    }
                });
            }
        });
    });
</script>
</div>
</body>