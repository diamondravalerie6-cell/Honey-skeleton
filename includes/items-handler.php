<?php
/**
 * CRUD sécurisé pour la table `items`.
 * Toutes les requêtes utilisent des requêtes préparées (PDO)
 * pour se protéger des injections SQL.
 */
require_once __DIR__ . '/db.php';

function items_get_all(): array
{
    $pdo = get_db_connection();
    $stmt = $pdo->query('SELECT * FROM items ORDER BY created_at DESC');
    return $stmt->fetchAll();
}

function items_create(string $title, string $description, float $price): bool
{
    $pdo = get_db_connection();
    $stmt = $pdo->prepare(
        'INSERT INTO items (title, description, price) VALUES (:title, :description, :price)'
    );
    return $stmt->execute([
        ':title'       => $title,
        ':description' => $description,
        ':price'       => $price,
    ]);
}

function items_update(int $id, string $title, string $description, float $price): bool
{
    $pdo = get_db_connection();
    $stmt = $pdo->prepare(
        'UPDATE items SET title = :title, description = :description, price = :price WHERE id = :id'
    );
    return $stmt->execute([
        ':title'       => $title,
        ':description' => $description,
        ':price'       => $price,
        ':id'          => $id,
    ]);
}

function items_delete(int $id): bool
{
    $pdo = get_db_connection();
    $stmt = $pdo->prepare('DELETE FROM items WHERE id = :id');
    return $stmt->execute([':id' => $id]);
}

// ---- Traitement des actions envoyées depuis items.php ----
$item_message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title       = trim(filter_var($_POST['title'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
    $description = trim(filter_var($_POST['description'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
    $price       = filter_var($_POST['price'] ?? 0, FILTER_VALIDATE_FLOAT);

    if (isset($_POST['action_create'])) {
        if (strlen($title) < 2 || $price === false) {
            $item_message = ['success' => false, 'text' => 'Titre ou prix invalide.'];
        } else {
            items_create($title, $description, (float) $price);
            $item_message = ['success' => true, 'text' => 'Élément ajouté avec succès.'];
        }
    }

    if (isset($_POST['action_update'], $_POST['id'])) {
        if (strlen($title) < 2 || $price === false) {
            $item_message = ['success' => false, 'text' => 'Titre ou prix invalide.'];
        } else {
            items_update((int) $_POST['id'], $title, $description, (float) $price);
            $item_message = ['success' => true, 'text' => 'Élément modifié avec succès.'];
        }
    }

    if (isset($_POST['action_delete'], $_POST['id'])) {
        items_delete((int) $_POST['id']);
        $item_message = ['success' => true, 'text' => 'Élément supprimé.'];
    }
}

$items_list = items_get_all();
