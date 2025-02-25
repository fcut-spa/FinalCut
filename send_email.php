<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $service = htmlspecialchars($_POST["service"]);
    $date = htmlspecialchars($_POST["date"]);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iltuoaccount@gmail.com';  // Sostituisci con il tuo account Gmail
        $mail->Password = 'iltuopassword';  // Usa una password per app di Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email per l'amministratore
        $mail->setFrom('iltuoaccount@gmail.com', 'Final Cut');
        $mail->addAddress('fcutspa@gmail.com');
        $mail->Subject = "Prenotazione per $name";
        $mail->Body = "Prenotazione avvenuta con successo per il giorno $date.\nServizio scelto: $service.";

        $mail->send();

        // Email di conferma all'utente
        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->Subject = "Conferma Prenotazione";
        $mail->Body = "Ciao $name,\n\nAbbiamo ricevuto la tua prenotazione per il giorno $date.\n\nGrazie per averci scelto!";
        $mail->send();

        echo "Prenotazione inviata con successo!";
    } catch (Exception $e) {
        echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
    }
}
?>
