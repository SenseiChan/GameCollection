<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Profil</title>
    <link rel="stylesheet" href="assets/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <h1>Mon Profil</h1>
    <?php if (isset($id) && $id): ?>
        <form action="" method="POST">
            <label> Prénom :
                <input type="text" name="prenom" value="<?php echo htmlspecialchars($Prenom); ?>">
            </label>
            <br>
            <label> Nom :
                <input type="text" name="nom" value="<?php echo htmlspecialchars($Nom); ?>">
            </label>
            <br>
            <label> Email :
                <input type="email" name="email" value="<?php echo htmlspecialchars($Email); ?>">
            </label>
            <br>
            <label> Mot de passe :
                <input type="password" name="password">
            </label>
            <br>
            <input type="submit" name="submit" value="Mettre à jour">
        </form>
        <form action="" method="POST">
            <button type="submit" name="delete_account">Supprimer le compte</button>
        </form>
        <form action="/profile/handleLogout" method="POST">
            <button type="submit" name="logout">Se déconnecter</button>
        </form>
    <?php else: ?>
        <p>Vous n'êtes pas connecté. Veuillez vous connecter pour accéder à votre profil.</p>
        <form action="connection.php" method="GET">
            <button type="submit">Se connecter</button>
        </form>
    <?php endif; ?>
</main>
</body>
</html>

