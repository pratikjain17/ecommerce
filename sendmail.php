<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendOtp($email, $otp)
{


  require('PHPMailer/PHPMailer.php');

  $message_body = "OTP to reset your password is" . $otp;
  $mail = new PHPMailer();
  // $mail->addReplyTo('pratik.pj48@gmail.com', 'Pratik Jain');
  $mail->setFrom('pratik.pj48@gmail.com', 'Pratik Jain');
  $mail->addAddress($email);
  $mail->Subject = "OTP to reset password";
  $mail->msgHTML($message_body);
  $result = $mail->Send();
  if (!$result) {
    echo 'Mailer error : ' . $mail->ErrorInfo;
  } else {
    return $result;
  }
}