<?php

// How To Make cURL HTTP Request Example

// Make GET Request

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://example.com",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    	// Set Here Your Requesred Headers
        'Content-Type: application/json',
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    print_r(json_decode($response));
}

// Make POST Request

// Make Post Fields Array
$data1 = [
    'data1' => 'value_1',
    'data2' => 'value_2',
];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://example.com",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data2),
    CURLOPT_HTTPHEADER => array(
    	// Set here requred headers
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    print_r(json_decode($response));
}