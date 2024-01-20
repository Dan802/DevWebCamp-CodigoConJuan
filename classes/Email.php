<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
     
        //  $mail->setFrom('info@mailtrap.io', 'Mailtrap');
        $mail->setFrom($_ENV['EMAIL_USER'], 'Tetris Coders');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en TetrisCoders; pero es necesario confirmarla</p>";
        $contenido .= "<p>Para hacerlo presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
        $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //extra
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->AltBody = "Ve al siguiente enlace:  " . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . " ";

        //Enviar el mail
        if($mail->send()){
            echo 'Message has been sent';
            return true;
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom($_ENV['EMAIL_USER'], 'Tetris Coders');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu contraseña';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        // extra
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->AltBody = "Ve al siguiente enlace: " . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . " ";

        //Enviar el mail
        //Enviar el mail
        if($mail->send()){
            echo 'Message has been sent';
            return true;
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
        
    }
}