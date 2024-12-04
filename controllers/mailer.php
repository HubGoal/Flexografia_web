<?php
use PHPMailer\PHPMailer\{PHPMailer,SMTP,Exception}; 
    class Mailer{
        function enviarEmail($email,$asunto,$cuerpo)
        {
        require_once '..//models/config.php';    
        require_once '..//phpmailer/src/PHPMailer.php';
        require_once '..//phpmailer/src/SMTP.php';
        require_once '..//phpmailer/src/Exception.php';
        
        $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = MAIL_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = MAIL_USER;                     //SMTP username
    $mail->Password   = MAIL_PASS;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(MAIL_USER, 'Admin');
    $mail->addAddress($email);     //Add a recipient


    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = utf8_encode($cuerpo);
    $mail->AltBody = 'Se le envio el codigo de activacion de su cuenta';
    $mail->setLanguage('es','..//phpmailer/language/phpmailer.lang-es.php');
    
    if($mail->send()){
        return true;
    }else {
        return false;
    }
} catch (Exception $e) {
    echo "Error al enviar correo de activacion. Mailer Error: {$mail->ErrorInfo}";
    return false;
}


        }
        
    }

?>