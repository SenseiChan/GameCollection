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
    <?php include 'views/tools/header.php' ;?>
    <main>
        <div id="form_profile">
        <h1>Mon Profil</h1>
            <form action="/profile/handleUpdateProfile" method="POST">
                <label> Prénom :
                    <input type="text" name="firstName" value="<?php echo !empty($firstName) ? htmlspecialchars($firstName) : ''; ?>">
                </label>
                <br>
                <label> Nom :
                    <input type="text" name="lastName" value="<?php echo !empty($lastName) ? htmlspecialchars($lastName) : ''; ?>">
                </label>
                <br>
                <label> Email :
                    <input type="email" name="email" value="<?php echo !empty($email) ? htmlspecialchars($email) : ''; ?>">
                </label>
                <br>
                <label> Mot de passe :
                    <input type="password" name="password">
                </label>
                <br>
                <label> Confirmation du mot de passe :
                    <input type="password" name="confirmPassword">
                </label>
                <br>
                <input type="submit" name="submit" value="Modifier">
            </form>
            <form action="/profile/handleDeleteAccount" method="POST">
                <input type="submit" name="delete_account" value="Supprimer mon compte">
            </form>
            <form action="/profile/handleLogout" method="POST">
                <input type="submit" name="delete_account" value="Se déconnecter">
            </form>
        </div>
    </main>
    <?php include 'views/tools/footer.php'; ?>
</body>
</html>

