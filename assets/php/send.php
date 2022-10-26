<?php 

  require("PHPMailer-Master/src/PHPMailer.php");
  require("PHPMailer-Master/src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
$username=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];


    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "trifthinqs@gmail.com";
    $mail->Password = "payxcuknujnvegld";
    $mail->SetFrom($email);
    $mail->Subject = "From: $username";
    $mail->Body = "You have received a new message from your website contact form.<br><br> <strong>name</strong>: $username <br> <strong>email</strong>: $email <br><br> <strong>Message</strong>: $message";
		
    $mail->AddAddress("trifthinqs@gmail.com");

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
				header("location:../../contact.php");
     }; ?>