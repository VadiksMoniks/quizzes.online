<?php
    require 'connection.php';
   // require 'classes/User.php';
    session_start();
    /*require __DIR__.'/vendor/autoload.php';
    require 'classes/User.php';
    require 'connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;*/

    /*function sendMail($param, $email){
        $link = '<a href="changeUserInfo.php?param='.$param.'">changeUserInfo.php?param='.$param.'</a>';
        $title = "Looks like you're trying to change your personal information";
        $body = "'If you're realy trying to change your personal information - follow this link otherways just ignore this letter'";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->IsHTML(true);
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'tls';
        $mail ->CharSet = 'UTF-8';
        $mail->Port = '587';
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = 'smtp';
        $mail->Username = 'andr26012k191@gmail.com';
        $mail->Password = 'eypqsamatwwmmfmb';
        $mail->Subject = $title;
        $mail->setFrom('andr26012k191@gmail.com', 'Technical Support');
        $mail->Body = $body;
        $mail->addAddress($email);
        $mail->send();
        $mail->smtpClose();
        return "Check your E-mail and follow the instructions";
    }*/

       // $changableParameter = explode('.', hex2bin('746573742e70617373'));
    $ans = 'something went wrong';
   
    if(array_key_exists('param', $_POST)){

        if($_POST['param']=='newUsername'){
            $sql = $pdo->prepare("UPDATE `users` SET `username` = ? WHERE `username` = ?");
            $sql->execute([$_POST['value'], $_POST['name']]);
            
             $ans="Your username was changed";
        }

        else if($_POST['param']=='newPass'){
            $sql = $pdo->prepare("UPDATE `users` SET `userpassword` = ? WHERE `username` = ?");
            $sql->execute([password_hash($_POST['value'], PASSWORD_DEFAULT), $_POST['name']]);
            
             $ans="Your password was changed";
        }

        else if($_POST['param']=='newEmail'){
            $sql = $pdo->prepare("UPDATE `users` SET `userlogin` = ? WHERE `username` = ?");
            $sql->execute([$_POST['value'], $_POST['name']]);
            
             $ans="Your email was changed";
        }

        echo $ans;
    }

    else{
        header('Loation:quizzes.online.php');
    }

    

?>