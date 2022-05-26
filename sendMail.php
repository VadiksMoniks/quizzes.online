<?php

    require __DIR__.'/vendor/autoload.php';
    require 'classes/User.php';
    require 'connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    session_start();

    function sendMail($param, $email){
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
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        return "Check your E-mail and follow the instructions";
    }

    $param = bin2hex($_POST['name'].'.'.$_POST['query']);
    $sql = $pdo->prepare("SELECT `userlogin` FROM `users` WHERE `username` = ?");
    $sql->execute([$_POST['name']]);
    $result = $sql->fetch();


    echo $ans = sendMail($param, $result->userlogin);

?>