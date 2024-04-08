<?php
require_once 'user.php';

// Initialize variables for form data
$name = $email = '';
$nameErr = $emailErr = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form input
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // If no validation errors, add user
    if (empty($nameErr) && empty($emailErr)) {
        $user = new User();
        if ($user->addUser($name, $email)) {
            header("Location: users.php");
            exit();
        } else {
            echo "Failed to add user.";
        }
    }
}

// Function to sanitize form inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Add User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span><br><br>
        <input type="submit" value="Submit">
    </form>
    <br><a href="users.php">&laquo; Back to Users</a>
</body>
</html>
