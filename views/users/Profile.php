<?php
session_start();

$host = 'localhost';
$dbname = 'game-collection';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les informations utilisateur pour affichage
$id = $_SESSION['user_id'] ?? null;
if ($id) {
    try {
        $sql = "SELECT FirstName_user, Email_user, Password_user, LastName_user FROM users WHERE id_user = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            die("Aucun utilisateur trouvé avec cet ID. Veuillez vérifier vos informations.");
        }

        $Prenom = $result['FirstName_user'];
        $Email = $result['Email_user'];
        $Nom = $result['LastName_user'];
    } catch (PDOException $e) {
        die("Erreur lors de la requête : " . $e->getMessage());
    }
}

// Gestion de la mise à jour des informations utilisateur
if (isset($_POST['submit']) && $id) {
    $newPrenom = $_POST['prenom'];
    $newNom = $_POST['nom'];
    $newEmail = $_POST['email'];
    $newPassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    try {
        $updateSql = "UPDATE users SET Email_user = :email, FirstName_user = :prenom, LastName_user = :nom";

        // Ajouter la mise à jour du mot de passe uniquement s'il est fourni
        if ($newPassword) {
            $updateSql .= ", Password_user = :password";
        }

        $updateSql .= " WHERE id_user = :id";

        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $updateStmt->bindParam(':prenom', $newPrenom, PDO::PARAM_STR);
        $updateStmt->bindParam(':nom', $newNom, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($newPassword) {
            $updateStmt->bindParam(':password', $newPassword, PDO::PARAM_STR);
        }

        $updateStmt->execute();

        // Actualiser les informations affichées sur la page
        $Prenom = $newPrenom;
        $Nom = $newNom;
        $Email = $newEmail;

        echo "<p>Mise à jour réussie !</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
    }
}

// Gestion de la suppression de compte
if (isset($_POST['delete_account']) && $id) {
    try {
        $deleteSql = "DELETE FROM users WHERE id_user = :id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $deleteStmt->execute();

        session_destroy();
        header("Location: signup.php"); // Redirection vers la page d'inscription
        exit;
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
    }
}

// Gestion de la déconnexion
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php"); // Redirection vers la page de connexion
    exit;
}
?>

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

