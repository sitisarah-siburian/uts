<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../config/database.php';

class AuthController {
    public function login() {
        global $pdo;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User($pdo);
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /books');
                exit;
            } else {
                $error = 'Username atau password salah!';
            }
        }

        $title = 'Login - Perpustakaan Digital';

        ob_start();
        require __DIR__ . '/../../views/pages/auth/login.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../views/layouts/main.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}