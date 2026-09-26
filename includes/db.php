<?php
/**
 * Connexion PDO à la base de données MySQL/MariaDB.
 * Modifie les constantes ci-dessous selon ton environnement XAMPP.
 * Usage : $pdo = get_db_connection();
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'honey_skeleton');
define('DB_USER', 'root');
define('DB_PASS', '');       // Par défaut vide sous XAMPP
define('DB_CHARSET', 'utf8mb4');

function get_db_connection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false, // vraies requêtes préparées = protection anti-injection SQL
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // En production : logger l'erreur au lieu de l'afficher
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    return $pdo;
}
