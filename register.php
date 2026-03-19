<?php
require_once 'db_config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('home.html');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'patient';
    $terms = isset($_POST['terms']);
    
    // Validate input
    $errors = [];
    
    if (empty($fullname)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (!$terms) {
        $errors[] = "You must agree to the terms and conditions";
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        try {
            // Check if username or email already exists
            // Generate username from email (part before @)
            $username = explode('@', $email)[0];
            $baseUsername = $username;
            $counter = 1;
            
            // Check if username exists and generate unique one
            while (true) {
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
                $stmt->execute([$username]);
                if (!$stmt->fetch()) {
                    break;
                }
                $username = $baseUsername . $counter;
                $counter++;
            }
            
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = "Email already registered";
                throw new Exception("Email exists");
            }
            
            // If no conflicts, insert new user
            if (empty($errors)) {
                // Hash password
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                
                // Begin transaction
                $pdo->beginTransaction();
                
                // Insert into users table
                $sql = "INSERT INTO users (username, password_hash, email, role, full_name, phone, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, NOW())";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $password_hash, $email, $role, $fullname, $phone]);
                
                $userId = $pdo->lastInsertId();
                
                // If user is patient, insert into patients table
                if ($role == 'patient') {
                    $sql = "INSERT INTO patients (user_id, full_name, phone, email, created_at) 
                            VALUES (?, ?, ?, ?, NOW())";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$userId, $fullname, $phone, $email]);
                }
                
                // If user is doctor, insert into doctors table
                if ($role == 'doctor') {
                    $sql = "INSERT INTO doctors (user_id, full_name, phone, email, created_at) 
                            VALUES (?, ?, ?, ?, NOW())";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$userId, $fullname, $phone, $email]);
                }
                
                // Commit transaction
                $pdo->commit();
                
                // Redirect to login page with success message
                redirect('index.html?success=registered');
            }
            
        } catch (Exception $e) {
            // Rollback transaction if started
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log("Registration error: " . $e->getMessage());
            
            if (empty($errors)) {
                $errors[] = "Registration failed. Please try again later.";
            }
        }
    }
    
    // If there are errors, redirect back with error messages
    if (!empty($errors)) {
        $errorString = implode(', ', $errors);
        redirect('index.html?error=registration&message=' . urlencode($errorString));
    }
} else {
    // If not POST request, redirect to registration page
    redirect('index.html');
}
?>