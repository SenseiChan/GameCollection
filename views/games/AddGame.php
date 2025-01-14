<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | AddGame</title>
    <link rel="stylesheet" href="assets/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'views/tools/header.php' ;?>
    <main id="add-game-main">
        <h1>Ajouter un jeu à sa bibliothèque</h1>
        <form method="GET" action="/addGame">
            <input type="text" name="search" placeholder="Rechercher un jeu" />
            <button type="submit">Rechercher</button>
        </form>
        <button name="addGameForm" onclick="window.location.href='AddGameForm'">Ajouter un nouveau jeu</button>
        <section class="results">
            <h2>Résultats de la recherche</h2>
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p style="color: green;">Le jeu a été ajouté à votre bibliothèque avec succès !</p>
            <?php endif; ?>
            <div class="games-grid">
                <?php if (!empty($games)) {
                    foreach ($games as $game): ?>
                    <div class="game-card" style="background-image: url('<?php echo $game['Url_picture']; ?>');">
                        <div class="gradient-overlay">
                            <div class="game-info">
                                <h1><?php echo htmlspecialchars($game['Name_game']); ?></h1>
                                <p><?php echo htmlspecialchars($game['platforms'] ?? 'Aucune plateforme'); ?></p>
                                <form method="POST" action="/addGame/addToLibrary">
                                    <input type="hidden" name="game_id" value="<?php echo htmlspecialchars($game['Id_game']); ?>">
                                    <button type="submit">Ajouter à la bibliothèque</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                } ?>
            </div>
        </section>
    </main>
    <?php include 'views/tools/footer.php'; ?>
</body>
</html>