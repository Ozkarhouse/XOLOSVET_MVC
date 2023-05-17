<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '661342d5b39050';
        $mail->Password = 'e4c237d388b9f7';

        $mail->setFrom('cuentas@referenciasjurisdiccion1.com');
        $mail->addAddress('cuentas@referenciasjurisdiccion1.com', 'RYC.com');
        $mail->Subjet = 'Confirma tu cuentas';


        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre . "</strong> Has creado tu cuenta en referencias y contrarreferencias, solo debes confirmarla presionado el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/public/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

    public function enviarInstrucciones(){
        //crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '661342d5b39050';
        $mail->Password = 'e4c237d388b9f7';

        $mail->setFrom('cuentas@referenciasjurisdiccion1.com');
        $mail->addAddress('cuentas@referenciasjurisdiccion1.com', 'RYC.com');
        $mail->Subjet = 'Reestablece tu password';


        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el sigueinte enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/public/recuperar?token=" . $this->token . "'>Reestablecer Password</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}