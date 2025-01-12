<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Modifier un jeu</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'views/tools/header.php'; ?>
<main>
    <section id="Modifier-Game">
        <h2><?php if (!empty($game)) {
                echo htmlspecialchars($game['Name_game']);
            } ?></h2>
        <div class="game-collection">
            <div class="game-specification">
                <img src="<?php echo htmlspecialchars($game['Url_picture']); ?>" alt="Image du jeu">
                <p><?php echo htmlspecialchars($game['Desc_game']); ?></p>
                <p>Temps passé : <?php echo htmlspecialchars($game['Time_played']); ?></p>
                <h3>Ajouter du temps passé sur le jeu</h3>
                <label> Temps passé sur le jeu :
                    <input type="text" name="Temps" value="<?php echo htmlspecialchars($game['Time_played']); ?>">
                </label>
                <form method="POST" action="/library/handleupdate">

                            <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                            <button type="submit">Ajouter</button>
                </form>
                <form method="POST" action="/library/handledelete">
                            <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                            <button type="submit">Supprimer le jeu de ma bibliothèque</button>
                </form>
             </div>
        </div>
    </section>
</main>
<?php include 'views/tools/footer.php'; ?>
</body>
</html>