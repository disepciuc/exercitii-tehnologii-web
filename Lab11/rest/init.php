<?php

// Define base path constant
define('BASE_PATH', dirname(__DIR__)."/rest");

// Load configuration settings if any
// For example: require_once(BASE_PATH . '/config.php');

// Autoload classes using a simple autoloader
// Autoload classes using a simple autoloader
spl_autoload_register(function ($class) {
    // Define an array of directories to search for class files
    $directories = [
        BASE_PATH . '/app/controllers/',
        BASE_PATH . '/app/models/',
        BASE_PATH . '/app/',
        // Add more directories as needed
    ];

    // Loop through each directory and attempt to locate the class file
    foreach ($directories as $directory) {
        $file = $directory . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require_once $file;
            return; // Stop searching once the class file is found
        }
    }
});

?>
