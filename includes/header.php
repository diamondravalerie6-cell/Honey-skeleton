<?php
/**
 * Composant Header
 * Barre de navigation responsive réutilisable sur toutes les pages.
 * Usage : <?php include 'includes/header.php'; ?>
 */
?>
<header class="site-header">
    <div class="container header-inner">
        <a href="index.php" class="logo">
            <img src="images/logo.png" alt="Logo Honey Group" onerror="this.style.display='none'">
            <span>Honey Group</span>
        </a>

        <button class="burger" id="burgerBtn" aria-label="Ouvrir le menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php#services">Services</a></li>
                <li><a href="index.php#produits">Produits</a></li>
                <li><a href="items.php">Gestion (CRUD)</a></li>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
