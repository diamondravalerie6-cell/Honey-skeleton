<?php
/**
 * index.php - Page d'accueil du Skeleton
 * Assemble les composants réutilisables : header, sections, footer.
 */
require 'includes/contact-handler.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honey Group - Skeleton</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <!-- Section Hero / bannière -->
    <section class="hero">
        <div class="container">
            <h1>Bienvenue sur le Skeleton Honey Group</h1>
            <p>Modèle de base modulaire, responsive et réutilisable pour les futurs projets web.</p>
            <a href="#contact" class="btn">Nous contacter</a>
        </div>
    </section>

    <!-- Section Services / grille de cartes -->
    <section class="section" id="services">
        <div class="container">
            <h2>Nos Services</h2>
            <div class="card-grid">
                <div class="card">
                    <h3>Développement Web</h3>
                    <p>Sites et applications sur mesure, modernes et performants.</p>
                </div>
                <div class="card">
                    <h3>Intégration Responsive</h3>
                    <p>Une expérience fluide sur mobile, tablette et ordinateur.</p>
                </div>
                <div class="card">
                    <h3>Gestion de Données</h3>
                    <p>Connexion et gestion sécurisée des bases MySQL.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section class="section" id="contact" style="background:var(--color-light)">
        <div class="container">
            <h2>Contactez-nous</h2>

            <?php if ($contact_result): ?>
                <p class="form-message" style="color: <?php echo $contact_result['success'] ? 'green' : '#c0392b'; ?>">
                    <?php echo htmlspecialchars($contact_result['message']); ?>
                </p>
            <?php endif; ?>

            <form class="contact-form" id="contactForm" method="POST" action="index.php#contact">
                <div>
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" name="contact_submit" class="btn">Envoyer</button>
            </form>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>
