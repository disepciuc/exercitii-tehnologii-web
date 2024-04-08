<?php
require_once 'user.php';


// Instantiate User class
$user = new User();

// Get users from database
$users = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Users</h2>
    <?php if ($users): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
                <a href="view_user.php?id=<?php echo $user['id']; ?>" class="btn">View</a>
                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn">Edit</a>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>No users found.</p>
    <?php endif; ?>
    <a href="add_user.php" class="btn">Add User</a>
</body>
</html>
