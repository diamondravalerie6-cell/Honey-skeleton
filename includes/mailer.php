<?php
/**
 * Envoi d'email via PHPMailer + SMTP Gmail.
 * ⚠️ Remplace SMTP_USERNAME et SMTP_APP_PASSWORD par tes propres identifiants
 *    (adresse Gmail + mot de passe d'application à 16 caractères).
 */

require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ---- Identifiants à configurer ----
define('SMTP_USERNAME', 'diamondravalerie6@gmai.com');   // Ton adresse Gmail
define('SMTP_APP_PASSWORD', 'bodokely');    // Le code à 16 caractères (sans espaces)
define('SMTP_TO_EMAIL', 'diamondravalerie6@gmail.com');   // Où recevoir les messages (peut être la même adresse)

/**
 * Envoie un email via Gmail SMTP.
 * Retourne true si l'envoi a réussi, false sinon.
 */
function send_contact_email(string $fromName, string $fromEmail, string $messageBody): bool
{
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_APP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // Expéditeur / destinataire
        $mail->setFrom(SMTP_USERNAME, 'Site Honey Group');
        $mail->addAddress(SMTP_TO_EMAIL);
        $mail->addReplyTo($fromEmail, $fromName);

        // Contenu
        $mail->isHTML(false);
        $mail->Subject = 'Nouveau message de contact - ' . $fromName;
        $mail->Body    = "Nom : $fromName\nEmail : $fromEmail\n\nMessage :\n$messageBody";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // En production : logger l'erreur au lieu de l'ignorer
        error_log('Erreur envoi email : ' . $mail->ErrorInfo);
        return false;
    }
}
