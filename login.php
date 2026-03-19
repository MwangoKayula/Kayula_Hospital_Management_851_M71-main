<?php
require_once 'db_config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('home.html');
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Validate input
    if (empty($username) || empty($password)) {
        redirect('index.html?error=empty');
    }
    
    try {
        // Query to find user by username or email
        $sql = "SELECT id, username, password_hash, email, role, full_name 
                FROM users 
                WHERE username = :username OR email = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        
        // Verify password
        if ($user && password_verify($password, $user['password_hash'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['login_time'] = time();
            
            // Set remember me cookie if requested (30 days)
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $expiry = time() + (30 * 24 * 60 * 60); // 30 days
                
                // Store token in database
                $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $stmt->execute([$token, $user['id']]);
                
                // Set cookie
                setcookie('remember_token', $token, $expiry, '/', '', false, true);
            }
            
            // Redirect based on user role
            if ($user['role'] == 'doctor') {
                redirect('Doctors_dashboard.html');
            } else {
                redirect('home.html');
            }
        } else {
            // Invalid credentials
            redirect('index.html?error=invalid');
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        redirect('index.html?error=system');
    }
} else {
    // If not POST request, redirect to login page
    redirect('index.html');
}
?>