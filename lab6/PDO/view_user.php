<?php
require_once 'user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>User Details</h2>
    <?php
    // Check if user ID is provided in the URL
    if (isset($_GET['id'])) {
        // Get user ID from URL
        $userId = $_GET['id'];

        // Instantiate User class
        $user = new User();

        // Get user details by ID
        $userDetails = $user->getUserById($userId);

        if ($userDetails) {
            echo "<p><strong>ID:</strong> {$userDetails['id']}</p>";
            echo "<p><strong>Name:</strong> {$userDetails['name']}</p>";
            echo "<p><strong>Email:</strong> {$userDetails['email']}</p>";
            echo "<br><a href='users.php'>&laquo; Back to Users</a>";
        } else {
            echo "User not found.";
        }
    } else {
        echo "User ID not provided.";
    }
    ?>
</body>
</html>
