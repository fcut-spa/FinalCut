<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $date = $_POST["date"];

    $recipient1 = "fcutspa@gmail.com";
    $recipient2 = "altromail@gmail.com"; // Cambia con la seconda email

    $subject = "Prenotazione per $name";
    $message = "Prenotazione avvenuta con successo per il giorno $date.";

    $headers = "From: noreply@tuodominio.com\r\n";
    $headers .= "Reply-To: noreply@tuodominio.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Invia la prima email
    mail($recipient1, $subject, $message, $headers);
    
    // Invia la seconda email
    mail($recipient2, $subject, $message, $headers);

    // Reindirizza alla pagina di conferma
    header("Location: conferma.html");
    exit();
} else {
    echo "Errore nell'invio della prenotazione.";
}
?>
