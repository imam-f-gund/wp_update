<?php
$tujuan = "imameks02@gmail.com";
include "classes/class.phpmailer.php";
        // email
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com"; //host email
        $mail->SMTPDebug = 2;
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = "imamf0000@gmail.com"; //user email server
        $mail->Password = "gundemmmmM"; //password email server
        $mail->SetFrom("imamf0000@gmail.com", "Mail send"); //set email pengirim / server
        $mail->Subject = "Mail Notif"; //subyek email
        $mail->AddAddress($tujuan);  // email tujuan
        $mail->MsgHTML("Hello word");


        if (!$mail->Send()) {
           
            echo "<script> alert('error'); </script>";
            exit;
        } else {
            echo "<script> alert('berhasil'); </script>";
            
        }
        // end email
?>

<!-- Elseif Channel -->