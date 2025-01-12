<?php

require_once 'models/User.php';

class ProfileController {
    private $pdo;
    private $userId;
    private $firstName;
    private $lastName;
    private $email;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $this->loadUserData();
    }

    public function display() {
        $userId = $this->userId;
        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $email = $this->email;

        require 'views/users/Profile.php';
    }

    // Load user data from the database
    private function loadUserData() {
        if ($this->userId) {
            $user = User::getById($this->pdo, $this->userId);
            if ($user) {
                $this->firstName = $user['FirstName_user'];
                $this->lastName = $user['LastName_user'];
                $this->email = $user['Email_user'];
            }
        }
    }

    // Handle user profile update
    public function handleUpdateProfile($data) {
        try {
            $newFirstName = trim($data['firstName']);
            $newLastName = trim($data['lastName']);
            $newEmail = trim($data['email']);
            $newPassword = trim($data['password']);
            $confirmPassword = trim($data['confirmPassword']);
        } catch (Exception $e) {
            echo "<p>Error updating profile: " . $e->getMessage() . "</p>";
        }

        if ($newPassword == $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            try {
                User::update($this->pdo, $this->userId, $newFirstName, $newLastName, $newEmail, $newPassword);

                // Update instance variables
                $this->firstName = $newFirstName;
                $this->lastName = $newLastName;
                $this->email = $newEmail;

                // Redirect to profile page with success message
                header('Location: /profile');
                exit;
            } catch (PDOException $e) {
                // Display error
                echo "<p>Error updating profile: " . $e->getMessage() . "</p>";
            }
        }
        else {
            echo "Passwords do not match";
        }
    }

    // Handle account deletion
    public function handleDeleteAccount() {
        if ($this->userId && isset($_POST['delete_account'])) {
            try {
                User::delete($this->pdo, $this->userId);

                session_destroy();
                header("Location: signup.php");
                exit;
            } catch (PDOException $e) {
                echo "<p>Error deleting account: " . $e->getMessage() . "</p>";
            }
        }
    }

    // Handle user logout
    public function handleLogout() {
        // Destroy session to log out user
        session_destroy();

        // Redirect user to login page
        header("Location: /login");
        exit;
    }

    // Get user information
//    public function getUserInfo() {
//        return [
//            'FirstName_user' => $this->firstName,
//            'LastName_user' => $this->lastName,
//            'Email_user' => $this->email
//        ];
//    }
}
?>