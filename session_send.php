<?php

// The data to send to the API
$postData = array(
    'apiOperation' => 'PAY',
    'order' => array('amount' => '100.00', 'currency'=> 'AUD'),
    'session' => array('id' => 'SESSION0002194788687M8722997G98'),
    'sourceOfFunds' => array('type' => 'CARD')
);

// Create the context for the request
$context = stream_context_create(array(
    'http' => array(
        // http://www.php.net/manual/en/context.http.php
        'method' => 'PUT',
        'header' => "Content-Type: application/json\r\n",
        'content' => json_encode($postData)
    )
));

// Send the request
$response = file_get_contents('https://test-tyro.mtf.gateway.mastercard.com/api/rest/version/52/merchant/TYRO_294/order/{{$guid}}/transaction/{{$guid}}', FALSE, $context);

// Check for errors
if($response === FALSE){
    die('Error');
}

// Decode the response
$responseData = json_decode($response, TRUE);

// Print the date from the response
echo $responseData['published'];