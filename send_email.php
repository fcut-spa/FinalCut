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
        $mail->Username = 'fcutspa@gmail.com';  // Modifica con il tuo indirizzo Gmail
        $mail->Password = 'TUA_PASSWORD_APP';   // Devi usare una Password per le App di Google!
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // **Email all'amministratore**
        $mail->setFrom('fcutspa@gmail.com', 'Final Cut');
        $mail->addAddress('fcutspa@gmail.com');  // L'email dell'amministratore
        $mail->Subject = "Nuova Prenotazione da $name";
        $mail->Body = "Hai ricevuto una nuova prenotazione:\n\nNome: $name\nEmail: $email\nServizio: $service\nData: $date";

        $mail->send(); // Invia la mail all'amministratore

        // **Email di conferma all'utente**
        $mail->clearAddresses();
        $mail->addAddress($email);  // Invia all'utente
        $mail->Subject = "Conferma Prenotazione - Final Cut";
        $mail->Body = "Ciao $name,\n\nAbbiamo ricevuto la tua prenotazione per il servizio '$service' in data $date.\n\nGrazie per aver scelto Final Cut!";

        $mail->send(); // Invia la mail all'utente

        // **Reindirizza alla pagina di conferma**
        header("Location: conferma.html");
        exit();
    } catch (Exception $e) {
        echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
    }
}
?>
