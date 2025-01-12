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
    <main>
        <h1>Ajouter un jeu à sa bibliothèque</h1>
        <form method="GET" action="/addGame">
            <input type="text" name="search" placeholder="Rechercher un jeu" />
            <button type="submit">Rechercher</button>
        </form>
        <button name="addGameForm" onclick="window.location.href='AddGameForm'">Ajouter un nouveau jeu</button>
        <section class="results">
            <h2>Résultats de la recherche</h2>
            <div class="games-grid">
                <?php foreach ($games as $game): ?>
                <div class="game-card" style="background-image: url('<?php echo $game['image_url']; ?>');">
                    <div class="game-info">
                        <h3><?php echo htmlspecialchars($game['name']); ?></h3>
                        <p><?php echo htmlspecialchars($game['platform']); ?></p>
                        <form method="POST" action="/library/add">
                            <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                            <button type="submit">Ajouter à la bibliothèque</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php include 'views/tools/footer.php'; ?>
</body>
</html>