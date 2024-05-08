<?php

require __DIR__ . '/vendor/autoload.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

error_reporting(E_ALL ^ E_WARNING);




function getCatsArray() {
    // Specify file path
        $filePath = 'cats.json';

        // Check if the file exists
    if (file_exists($filePath)) {
        // Read JSON file contents
        $jsonData = file_get_contents($filePath);

        // Decode JSON data to PHP array
         return json_decode($jsonData, true);

    } else {
        return null;
    }
}

function writeCatsArray($cats) {
    // New array

// Convert array to JSON format
$jsonData = json_encode($cats);

// Specify file path
$filePath = 'cats.json';

// Open file for writing (override)
$file = fopen($filePath, 'w');

// Write JSON data to file
if ($file) {
    fwrite($file, $jsonData);
    fclose($file);
    echo "New array has been successfully written to file and has overridden the previous content.";
} else {
    echo "Error opening file!";
}
}




try {

    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'cat' => [
                'type' => Type::string(),
                'args' => [
                    'id' => ['type' => Type::int()],
                ],
                'resolve' => function ($root, $args) {
                    $catsArray = getCatsArray();
                    return $catsArray[$args['id']-1];
                },
            ],
            'cats' => [
                'type' => Type::string(),
                'fields' => [
                    'id' => Type::nonNull(Type::id()),
                    'name' => Type::string(),
                ],
                'resolve' => function ($root, $args) {
                    $catsArray = getCatsArray();
                    return json_encode($catsArray);
                },
            ],
        ],
    ]);

    $mutationType = new ObjectType([
        'name' => 'Mutation',
        'fields' => [
            'create_cat' => [
                'type' => Type::int(),
                'args' => [
                    'id' => ['type' => Type::int()],
                ],
                'resolve' => function ($root, $args) {
                    $catsArray = getCatsArray();
                    $catsArray[] = "Cat ". $args['id'];
                    writeCatsArray($catsArray);
                    return $args['id'];
                    // Sa se completeze codul lipsa
                }
            ],
//            'update_cat' => [
//                  // Sa se completeze codul lipsa
//            ],
//            'delete_cat' => [
//                  // Sa se completeze codul lipsa
//            ]
        ],
    ]);


    $schema = new Schema([
        'query' => $queryType,
        'mutation' => $mutationType,
    ]);



    $server = new StandardServer([
        'schema' => $schema
    ]);

    $server->handleRequest();
} catch (Exception $e) {
    StandardServer::send500Error($e);
}