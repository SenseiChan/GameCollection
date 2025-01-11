<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php include 'views/tools/header.php' ;?>
    <main>
        <!-- Message de bienvenue -->
        <section>
            <h1>
                SALUT <?php echo !empty($prenom) ? $prenom : ''; ?> !<br>
                PRÊT À AJOUTER DES JEUX À TA COLLECTION ?
            </h1>
        </section>

        <!-- Section Mes jeux -->
        <section>
            <h2>Mes jeux</h2>
            <div class="game-collection">
                <?php if (!empty($jeux)) : ?>
                    <?php foreach ($jeux as $jeu) : ?>
                        <div class="game-card">
                            <img src="<?php echo htmlspecialchars($jeu['image_url']); ?>" alt="Image du jeu">
                            <h3><?php echo htmlspecialchars($jeu['title']); ?></h3>
                            <p><?php echo htmlspecialchars($jeu['platform']); ?></p>
                            <p><?php echo htmlspecialchars($jeu['playtime']); ?> h</p>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Aucun jeu ajouté pour le moment.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php include 'views/tools/footer.php'; ?>
</body>
</html>
