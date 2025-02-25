<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'fcutspa@gmail.com';  // Sostituisci con il tuo indirizzo Gmail
    $mail->Password = 'TUA_PASSWORD_APP';   // Inserisci qui la password per le app di Google
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPDebug = 2; // ATTIVA DEBUG SMTP (VEDRAI I MESSAGGI DI ERRORE)

    $mail->setFrom('fcutspa@gmail.com', 'Final Cut');
    $mail->addAddress('iltuotestemail@gmail.com'); // Inserisci qui un'email di prova

    $mail->Subject = 'Test SMTP';
    $mail->Body = 'Se stai leggendo questa email, la configurazione SMTP funziona!';

    if ($mail->send()) {
        echo 'Email inviata con successo!';
    } else {
        echo 'Errore: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
}
?>
