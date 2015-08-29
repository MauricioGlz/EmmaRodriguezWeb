<?php

require_once('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();

if( isset( $_POST['template-contactform-submit'] ) AND $_POST['template-contactform-submit'] == 'submit' ) {
    if( $_POST['template-contactform-name'] != '' AND $_POST['template-contactform-email'] != '' AND $_POST['template-contactform-message'] != '' ) {

        $name = $_POST['template-contactform-name'];
        $direc = $_POST['template-contactform-direc'];
        $email = $_POST['template-contactform-email'];
        $phone = $_POST['template-contactform-phone'];
        $cel = $_POST['template-contactform-cel'];
        $service = $_POST['template-contactform-service'];
        $grado = $_POST['template-contactform-grado'];
        $message = $_POST['template-contactform-message'];

        $subject = 'Nuevo mensaje de contacto';

        $botcheck = $_POST['template-contactform-botcheck'];

        $toemail = 'l.studiodeemmar@gmail.com'; // Your Email Address
        $toname = 'Emma Rodríguez'; // Your Name

        if( $botcheck == '' ) {

            $mail->CharSet = "UTF8";
            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;

            $name = isset($name) ? "Nombre: $name<br><br>" : 'Nombre';
            $direc = isset($email) ? "Dirección: $direc<br><br>" : 'Dirección';
            $phone = isset($phone) ? "Teléfono: $phone<br><br>" : 'Teléfono';
            $cel = isset($service) ? "Celular: $cel<br><br>" : 'Celular';
            $email = isset($email) ? "Email: $email<br><br>" : 'Email';
            $grado = isset($grado) ? "Grado de estudios: $grado<br><br>" : 'Grado';
            $service = isset($service) ? "Programa de estudios: $service<br><br>" : 'Estudios';
            $message = isset($message) ? "Message: $message<br><br>" : 'Mensaje';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Este formulario fue enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $direc $phone $cel $email $grado $service $message $referrer";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ) {
                echo 'Gracias por ponerse en contacto';
            } else {
                    echo 'Lo sentimos, no hemos podido enviar su mensaje. Por favor intente más tarde.<br /><br /><strong>Error:</strong><br />' . $mail->ErrorInfo . '';
            }
        } else {
            echo 'Error, refresca la ventana del navegador y vuelva a intentarlo';
        }
    } else {
        echo 'Por favor <strong>Rellenar</strong> todos los Campos y Volver a Intentar.';
    }
} else {
    echo 'Un <strong>error inesperado</strong> ha ocurrido. Por favor intentelo después.';
}

?>

