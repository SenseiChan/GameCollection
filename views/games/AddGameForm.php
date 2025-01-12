<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | AddGameForm</title>
    <link rel="stylesheet" href="assets/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'views/tools/header.php' ;?>
    <main>
        <h1>Ajout d'un jeu</h1>
        <form action="/addGameForm/add" method="POST">
            <label>Nom du jeu
                <input type="text" name="name" required>
            </label>
            <br>
            <label>Editeur du jeu
                <input type="text" name="publisher" required>
            </label>
            <br>
            <label>Sortie du jeu
                <input type="date" name="release_date" required>
            </label>
            <br>
            <?php foreach ($platforms as $platform): ?>
                <label>
                    <input type="checkbox" name="platforms[]" value="<?php echo htmlspecialchars($platform['id']); ?>">
                    <?php echo htmlspecialchars($platform['name']); ?>
                </label>
                <br>
            <?php endforeach; ?>
            <br>
            <label>Description du jeu
                <textarea name="description" required></textarea>
            </label>
            <br>
            <label>URL de la cover
                <input type="text" name="url_picture" required>
            </label>
            <br>
            <label>URL du site
                <input type="text" name="url_site" required>
            </label>
            <br>
            <input type="submit" name="submit" value="Ajouter">
        </form>
    </main>
    <?php include 'views/tools/footer.php'; ?>
</body>
</html>