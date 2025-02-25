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
        $mail->Username = 'fcutspa@gmail.com';  // Usa l'email corretta
        $mail->Password = 'TUA_PASSWORD_APP';  // Usa una password per app di Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email per l'amministratore
        $mail->setFrom('fcutspa@gmail.com', 'Final Cut');
        $mail->addAddress('fcutspa@gmail.com'); // Email dell'amministratore
        $mail->Subject = "Prenotazione per $name";
        $mail->Body = "Prenotazione ricevuta per il giorno $date.\nServizio scelto: $service.";

        $mail->send();

        // Email di conferma all'utente
        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->Subject = "Conferma Prenotazione - Final Cut";
        $mail->Body = "Ciao $name,\n\nLa tua prenotazione per il servizio '$service' è stata registrata con successo per il giorno $date.\n\nGrazie per aver scelto Final Cut!";

        $mail->send();

        // Reindirizzamento alla pagina di conferma
        header("Location: conferma.html");
        exit();
    } catch (Exception $e) {
        echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
    }
}
?>
