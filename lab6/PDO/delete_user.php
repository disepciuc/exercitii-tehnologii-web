<?php
require_once 'user.php';

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
    // Get user ID from URL
    $id = $_GET['id'];

    // Instantiate User class
    $user = new User();

    // Delete user by ID
    if ($user->deleteUser($id)) {
        header("Location: users.php");
        exit();
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "User ID not provided.";
}
?>
