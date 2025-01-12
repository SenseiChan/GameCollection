<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Accueil</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'views/tools/header.php'; ?>
<main>
    <section>
        <div id="home-page-welcome">
            <h1>
                SALUT <?php echo !empty($userFirstName) ? htmlspecialchars($userFirstName) : ''; ?> !<br>
                PRÊT À AJOUTER DES <br>
                JEUX À TA COLLECTION ?
            </h1>
        </div>
    </section>
    <section id="home-page-games">
        <h2>Mes jeux</h2>
        <div class="games-grid">
            <?php if (!empty($games)) : ?>
                <?php foreach ($games as $game) : ?>
                    <a href="/updateGame?game_id=<?php echo htmlspecialchars($game['Id_game']); ?>" class="game-card" 
                    style="background-image: url('<?php echo htmlspecialchars($game['Url_picture']); ?>');">
                        <div class="gradient-overlay">
                            <div class="game-info">
<!--                                <img src="--><?php //echo htmlspecialchars($game['url_picture']); ?><!--" alt="Image du jeu">-->
                                <h1><?php echo htmlspecialchars($game['Name_game']); ?></h1>
                                <p><?php echo htmlspecialchars($game['platforms']); ?></p>
                                <p><?php echo htmlspecialchars($game['Time_played']); ?> h</p>
                            </div>
                        </div>
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