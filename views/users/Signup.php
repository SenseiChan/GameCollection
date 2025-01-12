<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Inscription</title>
    <link rel="stylesheet" href="assets/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div id="form-container">
    <h1>Inscription</h1>
    <form action="/signup?controller=signup&action=handleSignup" method="POST">
            <label>Nom :
                <input type="text" name="name">
            </label>
            <label>Prénom :
                <input type="text" name="first_name">
            </label>
            <label>Email :
                <input type="email" name="email">
            </label>
            <label>Mot de passe :
                <input type="password" name="password">
            </label>
            <label>Confirmation du mot de passe :
                <input type="password" name="confirmation_password">
            </label>
            <input type="submit" name="submit" value="S'inscrire">
        </form>
    <button name="login" onclick="window.location.href='Login'">Se connecter</button>
    </div>
</main>
<?php include 'views/tools/footer.php'; ?>
</body>
</html>

