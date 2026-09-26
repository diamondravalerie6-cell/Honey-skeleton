<?php
/**
 * items.php - Démonstration CRUD (Phase 2)
 * Liste, ajoute et supprime des éléments dans la base MySQL.
 */
require 'includes/items-handler.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Honey Group - Gestion des éléments</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <section class="section">
        <div class="container">
            <h2>Gestion des éléments (CRUD MySQL)</h2>

            <?php if ($item_message): ?>
                <p class="form-message" style="color: <?php echo $item_message['success'] ? 'green' : '#c0392b'; ?>">
                    <?php echo htmlspecialchars($item_message['text']); ?>
                </p>
            <?php endif; ?>

            <!-- Formulaire d'ajout -->
            <form class="contact-form" method="POST" action="items.php" style="margin-bottom:48px;">
                <div>
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>
                <div>
                    <label for="price">Prix (Ar)</label>
                    <input type="number" step="0.01" id="price" name="price" required>
                </div>
                <button type="submit" name="action_create" class="btn">Ajouter</button>
            </form>

            <!-- Liste des éléments -->
            <div class="card-grid">
                <?php foreach ($items_list as $item): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <p><strong><?php echo number_format((float) $item['price'], 0, ',', ' '); ?> Ar</strong></p>
                        <form method="POST" action="items.php" style="margin-top:12px;">
                            <input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>">
                            <button type="submit" name="action_delete" class="btn" style="background:#c0392b;color:#fff;">
                                Supprimer
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($items_list)): ?>
                    <p>Aucun élément pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
