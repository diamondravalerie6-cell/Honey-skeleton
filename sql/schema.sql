-- ==========================================================
-- Schéma de base de données - Skeleton Honey Group (Phase 2)
-- À importer via phpMyAdmin ou : mysql -u root -p < schema.sql
-- ==========================================================

CREATE DATABASE IF NOT EXISTS honey_skeleton
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE honey_skeleton;

-- Table d'exemple pour le CRUD (produits / éléments génériques)
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table pour stocker les messages du formulaire de contact
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Quelques données de test
INSERT INTO items (title, description, price) VALUES
('Produit exemple 1', 'Description courte du produit 1.', 25000),
('Produit exemple 2', 'Description courte du produit 2.', 42000);
