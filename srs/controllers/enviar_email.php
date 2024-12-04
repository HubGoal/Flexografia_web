<?php

use PHPMailer\PHPMailer\{PHPMailer,SMTP,Exception}; 

    
    require_once '..//phpmailer/src/PHPMailer.php';
    require_once '..//phpmailer/src/SMTP.php';
    require_once '..//phpmailer/src/Exception.php';

    
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //SMTP::DEBUG_OFF                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jeseoz33@gmail.com';                     //SMTP username
    $mail->Password   = '..';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('jeseoz33@gmail.com', 'Admin');
    $mail->addAddress('alberto.lopez@unipolidgo.edu.mx', 'Jesus');     //Add a recipient
    $mail->addReplyTo('jeseoz33@gmail.com', 'Information');


    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Activacion de Correo';
    $cuerpo = '<h2>Bienvenido a 23 Publicidad</h2>';
    $cuerpo .= '<p></p>';
    $mail->Body    = utf8_encode($cuerpo);
    $mail->AltBody = 'Se le envio el codigo de activacion de su cuenta';
    $mail->setLanguage('es','..//phpmailer/language/phpmailer.lang-es.php');
    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar correo de activacion. Mailer Error: {$mail->ErrorInfo}";
}
?>