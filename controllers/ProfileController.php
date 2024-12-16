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

$id = $_SESSION['user_id'] ?? null;
$Prenom = $Email = $Nom = null;

if ($id) {
    try {
        $sql = "SELECT FirstName_user, Email_user, Password_user, LastName_user FROM users WHERE id_user = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $Prenom = $result['FirstName_user'];
            $Email = $result['Email_user'];
            $Nom = $result['LastName_user'];
        }
    } catch (PDOException $e) {
        die("Erreur lors de la requête : " . $e->getMessage());
    }
}

if (isset($_POST['submit']) && $id) {
    $newPrenom = $_POST['prenom'];
    $newNom = $_POST['nom'];
    $newEmail = $_POST['email'];
    $newPassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    try {
        $updateSql = "UPDATE users SET Email_user = :email, FirstName_user = :prenom, LastName_user = :nom";

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

        $Prenom = $newPrenom;
        $Nom = $newNom;
        $Email = $newEmail;

        echo "<p>Mise à jour réussie !</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la mise à jour : " . $e->getMessage() . "</p>";
    }
}

if (isset($_POST['delete_account']) && $id) {
    try {
        $deleteSql = "DELETE FROM users WHERE id_user = :id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $deleteStmt->execute();

        session_destroy();
        header("Location: signup.php");
        exit;
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: Login.php");
    exit;
}
?>