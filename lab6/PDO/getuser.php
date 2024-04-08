<?php
// Include database configuration
require_once '../config.php';

try {
    // Check if username is provided in the URL
    if(isset($_GET['name'])) {
        // Retrieve username from GET parameter
        $username = $_GET['name'];

        // Establish database connection using PDO
        $dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME;
        $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Construct SQL query
        $sql = "SELECT * FROM users WHERE name = :username";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind parameter
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch all rows from the result set
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if user exists
        if ($rows) {
            // Loop through the rows
            foreach ($rows as $row) {
                // Output user details
                echo "User ID: " . $row['id'] . "<br>";
                echo "Name: " . $row['name'] . "<br>";
                echo "Email: " . $row['email'] . "<br>";
                echo "<br>";
            }
        } else {
            throw new Exception("User not found.");
        }

        // Close connection
        $pdo = null;
    } else {
        throw new Exception("Please provide a username in the URL.");
    }
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
