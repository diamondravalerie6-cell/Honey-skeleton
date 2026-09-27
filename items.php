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
    <meta name="description" content="Honey Group - Gestion des éléments, démonstration CRUD connectée à MySQL.">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍯</text></svg>">
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

                        <button type="button" class="btn edit-toggle" data-target="edit-<?php echo (int) $item['id']; ?>" style="margin-top:12px;">
                            Modifier
                        </button>

                        <form method="POST" action="items.php" id="edit-<?php echo (int) $item['id']; ?>" class="contact-form edit-form" style="display:none; margin-top:12px; text-align:left;">
                            <input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>">
                            <div>
                                <label for="title-<?php echo (int) $item['id']; ?>">Titre</label>
                                <input type="text" id="title-<?php echo (int) $item['id']; ?>" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>
                            </div>
                            <div>
                                <label for="description-<?php echo (int) $item['id']; ?>">Description</label>
                                <textarea id="description-<?php echo (int) $item['id']; ?>" name="description" rows="2"><?php echo htmlspecialchars($item['description']); ?></textarea>
                            </div>
                            <div>
                                <label for="price-<?php echo (int) $item['id']; ?>">Prix (Ar)</label>
                                <input type="number" step="0.01" id="price-<?php echo (int) $item['id']; ?>" name="price" value="<?php echo htmlspecialchars((string) $item['price']); ?>" required>
                            </div>
                            <button type="submit" name="action_update" class="btn">Enregistrer</button>
                        </form>

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
    <script src="js/script.js?v=2"></script>
</body>
</html>
