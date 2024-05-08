<?php

$country = $_GET['country'];


// Format data as needed
$response = [
    'dogImage' => getDogImage()['message'],
    'catFact' => getCatFact($country)['fact'],
];

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

function getDogImage() {
    // This function should return the capital city of the provided country

    $url = "https://dog.ceo/api/breeds/image/random";

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($curl);

    // Close cURL session
    curl_close($curl);
    
    // Decode JSON response
    return json_decode($response, true);
}

function getCatFact($country) {
    // This function should return the capital city of the provided country

    $url = "https://catfact.ninja/fact";

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($curl);

    // Close cURL session
    curl_close($curl);
    
    // Decode JSON response
    return json_decode($response, true);
}

?>
