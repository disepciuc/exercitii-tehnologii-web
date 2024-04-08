<?php
// Include database configuration
require_once '../config.php';

class UserQuery {
    private $pdo;

    public function __construct() {
        try {
            // Establish database connection using PDO
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME;
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

            // Set PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle database connection error
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function getUserByName($name) {
        try {
            // Construct SQL query
            $sql = "SELECT * FROM users WHERE name = :name";

            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($sql);

            // Bind parameter
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            // Execute the prepared statement
            $stmt->execute();

            // Fetch user data
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        } catch (PDOException $e) {
            // Handle database query error
            throw new Exception("Error fetching user: " . $e->getMessage());
        }
    }

    public function __destruct() {
        // Close connection
        $this->pdo = null;
    }
}

try {
    // Check if username is provided in the URL
    if(isset($_GET['name'])) {
        // Instantiate UserQuery class
        $userQuery = new UserQuery();

        // Sanitize and retrieve username from GET parameter
        $username = $_GET['name'];

        //SQL Injection
        //name=' OR '1'='1

        // Get user by name
        $users = $userQuery->getUserByName($username);

        // Check if user exists
        if (!empty($users)) {
            // Loop through the result set
            foreach ($users as $user) {
                // Output user details
                echo "User ID: " . $user['id'] . "<br>";
                echo "Name: " . $user['name'] . "<br>";
                echo "Email: " . $user['email'] . "<br>";
                echo "<br>";
            }
        } else {
            throw new Exception("User not found.");
        }
    } else {
        throw new Exception("Please provide a username in the URL.");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
