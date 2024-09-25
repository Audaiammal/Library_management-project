<?php
session_start();
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        die("Username and password are required.");
    }

    // Check in the member table
    $stmt_member = $conn->prepare("SELECT * FROM member WHERE username = ?");
    $stmt_member->bind_param("s", $username);
    $stmt_member->execute();
    $result_member = $stmt_member->get_result();

    if ($result_member->num_rows > 0) {
        $student = $result_member->fetch_assoc();
        // Check password directly (no hashing)
        if ($password === $student['password']) {
            $_SESSION['member_id'] = $student['member_id']; // Store member ID in session
            $_SESSION['username'] = $student['username'];
            $_SESSION['role'] = 'student'; 
            header("Location: member_dashboard.php");
            exit();
        } else {
            die("Invalid username or password.");
        }
    }

    // Check in the user table
    $stmt_user = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows === 0) {
        die("Invalid username or password.");
    }

    $user = $result_user->fetch_assoc();
    // Check password directly (no hashing)
    if ($password !== $user['password']) {
        die("Invalid username or password.");
    }
    
    $_SESSION['user_id'] = $user['user_id']; // Store user ID in session
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: user_dashboard.php");
    }
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
