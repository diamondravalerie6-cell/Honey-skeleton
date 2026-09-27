<?php
/**
 * Traitement sécurisé du formulaire de contact.
 * - Valide et nettoie les entrées côté serveur (indispensable même
 *   si le JS valide déjà côté client).
 * - Enregistre le message en base MySQL (table `messages`).
 * - Retourne un tableau ['success' => bool, 'message' => string].
 */
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/mailer.php';

function save_message_to_db(string $name, string $email, string $message): bool
{
    $pdo = get_db_connection();
    $stmt = $pdo->prepare(
        'INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)'
    );
    return $stmt->execute([
        ':name'    => $name,
        ':email'   => $email,
        ':message' => $message,
    ]);
}

function handle_contact_form(array $post): array
{
    $name    = trim(filter_var($post['name'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
    $email   = trim(filter_var($post['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $message = trim(filter_var($post['message'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));

    if (strlen($name) < 2) {
        return ['success' => false, 'message' => 'Le nom est invalide.'];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => "L'adresse email est invalide."];
    }

    if (strlen($message) < 10) {
        return ['success' => false, 'message' => 'Le message est trop court.'];
    }

    try {
        save_message_to_db($name, $email, $message);
    } catch (PDOException $e) {
        return ['success' => false, 'message' => "Erreur lors de l'enregistrement, veuillez réessayer."];
    }

    // L'échec de l'envoi d'email n'empêche pas le message d'être enregistré en base.
    send_contact_email($name, $email, $message);

    return ['success' => true, 'message' => 'Merci ' . htmlspecialchars($name) . ', votre message a bien été reçu.'];
}

$contact_result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $contact_result = handle_contact_form($_POST);
}
