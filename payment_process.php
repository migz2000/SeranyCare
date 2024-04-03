<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get donation amount from form submission
    $amount = $_POST['amount'];

    

    // Initialize GuzzleHttp\Client
    require_once('vendor/autoload.php');
    
    // Instantiate GuzzleHttp\Client
    $client = new \GuzzleHttp\Client();

    try {
        // Remove decimal point
        $amountWithoutDecimal = str_replace('.', '', $amount);
    
        // Make API request to create payment link
        $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
            'body' => '{"data":{"attributes":{"amount":' . $amountWithoutDecimal . ',"description":"Donation"}}}',
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF80bnFVUmlMTWRhSGNzYjZXNjdRYkdFN246dGVzdA==',
                'content-type' => 'application/json',
            ],
        ]);

        // Decode the JSON response
        $responseData = json_decode($response->getBody(), true);

        // Get the payment URL from the response
        $paymentUrl = $responseData['data']['attributes']['checkout_url'];

        // Redirect the user to the payment gateway
        header("Location: $paymentUrl");
        exit();
    } catch (Exception $e) {
        // Handle any exceptions
        echo 'Error: ' . $e->getMessage();
    }
}
?>
