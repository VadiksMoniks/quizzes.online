<?php
    session_start();
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

    <input type="text" name="quizName" id="quizName" placeholder="Enter the quiz you looking for">
    <div id="quizList"></div>
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
        });
        $(document).on('click', 'li', function(){
            $('#quizName').val($(this).text());
            $('#quizList').fadeOut();
        });
    });
</script> 
<div>
<?php
    $host = "localhost";
    $userLog = "root";
    $passwordUser = "";
    $dbname = "quizonline";
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;
    $pdo = new PDO($dsn, $userLog, $passwordUser);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

     

    if(!empty($_GET['category'])){
        $sql = $pdo->prepare("SELECT `quizname` FROM `quiz` WHERE `category` = ?");
        $sql->execute([$_GET['t']]);

        if($sql->rowCount()>0){

            for($i=0; $i<$sql->rowCount(); $i++){
                $result = $sql->fetch();
                echo "<a href=quiz.php?n=".$result->quizname.">.$result->quizname.</a>";
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
            echo "<a href=quiz.php?n=".$result->quizname.">.$result->quizname.</a>";
        }
    }

?>
</div>
</body>
</html>
    
    