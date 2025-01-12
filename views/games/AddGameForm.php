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
        <?php if (isset($id) && $id): ?>
            <form action="/profile/handleUpdateProfile" method="POST">
                <label>Nom du jeu :
                    <input type="text" name="Nom du jeu">
                </label>
                <br>
                <label>Éditeur du jeu :
                    <input type="text" name="editeur">
                </label>
                <br>
                <label>Sortie du jeu :
                    <input type="date" name="date de sortie">
                </label>
                <br>
                <label>a faire :
                    <input type="text" name="Nom du jeu">
                </label>
                <br>
                <label>Description :
                    <input type="text" name="description">
                </label>
                <br>
                <label>Url de la cover :
                    <input type="text" name="URL1">
                </label>
                <br>
                <label>Url du site :
                    <input type="text" name="URL site">
                </label>
                <br>
                <input type="submit" name="submit" value="Ajouter">
        <?php else: ?>
            <p>Vous n'êtes pas connecté. Veuillez vous connecter pour accéder au formulaire d'ajout d'un jeu.</p>
            <button name="login" onclick="window.location.href='Login'">Se connecter</button>
        <?php endif; ?>
    </main>
    <?php include 'views/tools/footer.php'; ?>
</body>
</html>