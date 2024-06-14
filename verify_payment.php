<?php
session_start();
include('includes/db.php');

// $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
// $protocol = $isSecure ? 'https://' : 'http://';

// $host = $_SERVER['HTTP_HOST'];
// // Get the request URI
// $requestUri = $_SERVER['REQUEST_URI'];
// // Construct the full URL
// $fullUrl = $protocol . $host . $requestUri;
// echo $fullUrl;

// $queryString = parse_url($fullUrl, PHP_URL_QUERY);
// parse_str($queryString, $queryParams);

// $ref = $queryParams['ref'];
// $email = $queryParams['email'];
// $pack_id = $queryParams['pack_id'];

$pack_id = $_SESSION['pack_id'];
$email = $_SESSION['email'];

if(isset($_GET['ref'])){
$ref = $_GET['ref'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.chapa.co/v1/transaction/verify/'.$ref,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer CHASECK_TEST-F09lgWh6CB04TeIIJhgvkY1BqzcHChKu'
  ),
));

$response = curl_exec($curl);
curl_close($curl);

// Decode the JSON response
$decodedResponse = json_decode($response);

// Check if the response was successful
if ($decodedResponse && $decodedResponse->status === "success") {
    // Handle success
    // echo "Payment was successful.<br>";
    // echo "First Name: " . $decodedResponse->data->first_name . "<br>";


    // $email = $_GET['e'];
    // $pack_id = $_GET['p'];

    $stmt = "insert into booked values('$email', $pack_id)";
    mysqli_query($con, $stmt);
    echo '<script>alert("Payment Successful");</script>';
    header("Location: index.php?pay=ok");

} elseif ($decodedResponse && $decodedResponse->status === "failed") {
    // Handle failure
    echo "Payment failed or transaction not found.";
} else {
    // Handle unexpected response
    echo "Unexpected response received.";
}
}
else{
    echo "something";
}
?>