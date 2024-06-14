<?php
session_start();
include("includes/db.php");

if (isset($_GET['pack_id'])) {
    $package_id = $_GET['pack_id'];
    $get_pack = "select * from packages where package_id='$package_id'";

    $run_pack = mysqli_query($con, $get_pack);

    while ($row_pack = mysqli_fetch_array($run_pack)) {
        $pack_id = $row_pack['package_id'];
        $pack_title = $row_pack['package_title'];
        $pack_price = $row_pack['package_price'];
        $pack_image = $row_pack['package_image'];
        $pack_desc = $row_pack['package_desc'];
    }

    if (isset($_SESSION['customer_email'])) {
        $user = $_SESSION['customer_email'];
        $get_customer = "select * from customers where customer_email='$user'";

        $run_customer = mysqli_query($con, $get_customer);

        $row_customer = mysqli_fetch_array($run_customer);

        $c_id = $row_customer['customer_id'];
        $name = $row_customer['customer_name'];
        $email = $row_customer['customer_email'];
        $pass = $row_customer['customer_pass'];
        $passport = $row_customer['c_passport'];
        $country = $row_customer['customer_country'];
        $city = $row_customer['customer_city'];
        $image = $row_customer['customer_image'];
        $contact = $row_customer['customer_contact'];
        $address = $row_customer['customer_address'];
    } else {
        echo "<script>window.location.href='includes/signin.php';</script>";
        die();
    }
}


// Example trigger point: User submits a payment form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect payment details from the form or session
    $amount = $_POST['amount']; // Example: retrieve amount from form
    $email = $_POST['email']; // Example: retrieve email from form
    $name = $_POST['first_name'];
    $contact  = $_POST['phone'];
    // Initialize cURL
    $curl = curl_init();

    // Prepare the payload with dynamic data
    $ref = uniqid('ref_', true);
    $postData = json_encode([
        "amount" => $amount,
        "currency" => "ETB",
        "email" => $email,
        "first_name" => $name,
        // "last_name" => "Gizachew",
        "phone_number" => $contact,
        // "tx_ref" => "chewatatest-6669",
        "tx_ref" => $ref,
  "callback_url" => "http://localhost/Websites/EthioTours/verify_payment.php?ref=$ref&email=$email&pack_id=$pack_id",
  "return_url" => "http://localhost/Websites/EthioTours/verify_payment.php?ref=$ref&email=$email&pack_id=$pack_id",
//   "return_url" => "http://localhost/Websites/EthioTours/index.php?pay=ok",
        "customization" => [
            "title" => "Ethio Tours ",
            "description" => "Package Order."
        ]
    ]);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer CHASECK_TEST-F09lgWh6CB04TeIIJhgvkY1BqzcHChKu',
            'Content-Type: application/json'
        ),
    ));

// Execute the request and handle the response
$response = curl_exec($curl);
if (curl_errno($curl)) {
    // If cURL error occurs, print the error
    echo 'cURL Error:' . curl_error($curl);
} else {
    // Attempt to decode the response
    $decodedResponse = json_decode($response, true);
    if ($decodedResponse === null) {
        // If decoding fails, print the raw response for debugging
        echo 'Failed to decode JSON response: ' . $response;
    } else {
        $_SESSION['pack_id'] = $pack_id;
        $_SESSION['email'] = $email;
        $paymentUrl = $decodedResponse['data']['checkout_url'];    
        header('Location: ' . $paymentUrl);
        // Print the decoded response to debug
        echo 'Response: ';
        print_r($decodedResponse);
    }
}
curl_close($curl);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c4c4c4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #283ba7;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #150f6b;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form method="POST" onsubmit="handleSubmit(event)">
            <h2>Payment Form</h2>
            <div class="form-group">
                <label for="fname">Name</label>
                <input type="text" id="fname" name="first_name" value="<?= $name ?>" readonly>
            </div>
            <!-- <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="last_name" required>
            </div> -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $email ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" value="<?= $contact ?>" readonly>
            </div>
            <div class="form-group">
                <label for="fname">Package Name</label>
                <input type="text" id="fname" name="first_name" value="<?= $pack_title ?>" readonly>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="amount" value="<?= $pack_price ?>" readonly>
            </div>

            <!-- Hidden Chapa fields -->
            <input type="hidden" name="public_key" value="CHAPUBK_TEST-wC9rJ7sXg3w4JFPydLWx2UhEG6ZMXFpl">
            <input type="hidden" name="tx_ref" id="tx_ref" value="">
            <input type="hidden" name="currency" value="ETB">
            <input type="hidden" name="description" value="Paying with Confidence with cha">
            <input type="hidden" name="title" value="Let us do this">
            <input type="hidden" name="logo" value="https://chapa.link/asset/images/chapa_swirl.svg">
            <input type="hidden" name="callback_url" value="https://example.com/callbackurl">
            <input type="hidden" name="meta[title]" value="test">

            <!-- Hidden fields dynamically populated -->
            <input type="hidden" id="hidden_email" name="email" value="">
            <input type="hidden" id="hidden_first_name" name="first_name" value="">
            <!-- <input type="hidden" id="hidden_last_name" name="last_name" value=""> -->
            <input type="hidden" id="hidden_amount" name="amount" value="">

            <button type="submit" name="submit" value="submit">Pay</button>
        </form>
    </div>


    <script>
        function handleSubmit(event) {
            const txRef = 'tx-' + Date.now();
            document.getElementById('tx_ref').value = txRef;

            // Populate hidden fields
            document.getElementById('hidden_email').value = document.getElementById('email').value;
            document.getElementById('hidden_first_name').value = document.getElementById('fname').value;
            // document.getElementById('hidden_last_name').value = document.getElementById('lname').value;
            document.getElementById('hidden_amount').value = document.getElementById('price').value;

        }
    </script>
</body>

</html>