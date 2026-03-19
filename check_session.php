<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'logged_in' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? $_SESSION['username'],
            'role' => $_SESSION['user_role']
        ]
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>