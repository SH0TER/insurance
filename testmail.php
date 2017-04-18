<?php
//$to      = 'admin@mercedes-benz.in.ua';
$to      = 'eugene.cherkassky@gmail.com';
$to      = 'tatiana.petrunya@mercedes-benz.od.ua';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: info@e-insurance.in.ua' . "\r\n" .
    'Reply-To: info@e-insurance.in.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

echo mail($to, $subject, $message, $headers);