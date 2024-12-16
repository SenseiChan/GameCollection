<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
<main>
    <h1>Mon Profil</h1>
    <?php if ($id): ?>
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
        <form action="" method="POST">
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
