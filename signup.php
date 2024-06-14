<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
global $con;

$name_error = "";
$email_error = "";
$passport_error = "";
$image_error = "";
$country_error = "";
$city_error = "";
$address_error = "";
$contact_error = "";
$password_error = "";
$confirm_password_error = "";

if (isset($_POST['register'])) {
    $ip = getIp();
    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_email = mysqli_real_escape_string($con, $_POST['c_email']);
    $c_pass = mysqli_real_escape_string($con, $_POST['c_pass']);
    $c_pass_repeat = mysqli_real_escape_string($con, $_POST['c_pass_repeat']);
    $c_passport = mysqli_real_escape_string($con, $_POST['c_passport']);
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = mysqli_real_escape_string($con, $_POST['c_country']);
    $c_city = mysqli_real_escape_string($con, $_POST['c_city']);
    $c_contact = mysqli_real_escape_string($con, $_POST['c_contact']);
    $c_address = mysqli_real_escape_string($con, $_POST['c_address']);

    // Validate name
    if (empty($c_name)) {
        $name_error = "Name is required.";
    }

    // Validate email
    if (empty($c_email)) {
        $email_error = "Email is required.";
    } elseif (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format.";
    }

    // Validate passport
    if (empty($c_passport)) {
        $passport_error = "Passport ID is required.";
    }

    // Validate image
    if (empty($c_image)) {
        $image_error = "Image is required.";
    }

    // Validate country
    if (empty($c_country)) {
        $country_error = "Country is required.";
    }

    // Validate city
    if (empty($c_city)) {
        $city_error = "City is required.";
    }

    // Validate address
    if (empty($c_address)) {
        $address_error = "Address is required.";
    }

    // Validate contact
    if (empty($c_contact)) {
        $contact_error = "Contact is required.";
    }

    // Validate password
    if (empty($c_pass)) {
        $password_error = "Password is required.";
    } elseif ($c_pass != $c_pass_repeat) {
        $confirm_password_error = "Passwords do not match.";
    }
    else{
        $hashed_password = password_hash($c_pass, PASSWORD_DEFAULT);
    }

    // Check if email is already registered
    $sel_email = "SELECT * FROM customers WHERE customer_email='$c_email'";
    $run_email = mysqli_query($con, $sel_email);
    $check_email = mysqli_num_rows($run_email);
    if ($check_email > 0) {
        $email_error = "Email is already registered.";
    }

    // If all inputs are valid, insert the customer data
    if (
        empty($name_error) && empty($email_error) && empty($passport_error) && empty($image_error) &&
        empty($country_error) && empty($city_error) && empty($address_error) && empty($contact_error) &&
        empty($password_error) && empty($confirm_password_error)
    ) {
        $insert_c = "INSERT INTO customers (customer_ip,customer_name,customer_email,customer_pass,c_passport,customer_country,customer_city,customer_contact,customer_address,customer_image) VALUES ('$ip','$c_name','$c_email','$hashed_password','$c_passport','$c_country','$c_city','$c_contact','$c_address','$c_image')";
        $run_c = mysqli_query($con, $insert_c);

        move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

        $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
        $run_cart = mysqli_query($con, $sel_cart);
        $check_cart = mysqli_num_rows($run_cart);

        if ($check_cart == 0) {
            $_SESSION['customer_email'] = $c_email;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['customer_email'] = $c_email;
            header("Location: checkout.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EthioTours : Sign Up</title>

    <style>
        .signForm {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password],
        input[type=file],
        select {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button:hover {
            opacity: 1;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            padding: 14px 20px;
            background-color: #092635;
        }

        /* Float cancel and signup buttons and add an equal width */
        .cancelbtn,
        .signupbtn {
            float: left;
            width: 50%;
        }

        /* Add padding to container elements */
        .container {
            padding: 16px;
            max-width: 50%;
            margin: 0 auto;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .error{
            color:red;
        }

        /* Change styles for cancel button and signup button on extra small screens */
        @media screen and (max-width: 300px) {

            .cancelbtn,
            .signupbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include("includes/navbar.php"); ?>

    <form class="signForm" action="signup.php" style="border:1px solid #ccc" enctype="multipart/form-data" method="post">
        <div class="container">
            <h1>Sign Up</h1><br>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="c_name"><b>Full Name</b></label><span class="error"> *<?php echo $name_error; ?></span>
            <input type="text" placeholder="full name" name="c_name">

            <label for="c_email"><b>Email</b></label><span class="error"> *<?php echo $email_error; ?></span>
            <input type="text" placeholder="email" name="c_email">


            <label for="c_passport"><b>Passport ID</b></label><span class="error"> *<?php echo $passport_error; ?></span>
            <input type="text" placeholder="Passport Id" name="c_passport">


            <label for="c_image"><b>Image</b></label><span class="error"> *<?php echo $image_error; ?></span><br>
            <input type="file" name="c_image">


            <label for="c_country"><b>Country</b></label><span class="error"> *<?php echo $country_error; ?></span><br>
            <select name="c_country">
                <option value="">Select Country</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="India">India</option>
                <option value="Japan">Japan</option>
                <option value="China">China</option>
                <option value="Russia">Russia</option>
                <option value="Portugal">Portugal</option>
                <option value="England">England</option>
                <option value="USA">USA</option>
                <option value="Spain">Spain</option>
                <option value="France">France</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Croatia">Croatia</option>
                <option value="Argentina">Argentina</option>
            </select>


            <label for="c_city"><b>City</b></label><span class="error"> *<?php echo $city_error; ?></span>
            <input type="text" placeholder="city" name="c_city">


            <label for="c_address"><b>Address</b></label><span class="error"> *<?php echo $address_error; ?></span>
            <input type="text" placeholder="address" name="c_address">


            <label for="c_contact"><b>Contact</b></label><span class="error"> *<?php echo $contact_error; ?></span>
            <input type="text" placeholder="contact" name="c_contact">


            <label for="c_pass"><b>Password</b></label><span class="error"> *<?php echo $password_error; ?></span>
            <input type="password" placeholder="Enter Password" name="c_pass">

            <label for="psw-repeat"><b>Repeat Password</b></label><span class="error"> *<?php echo $confirm_password_error; ?></span>
            <input type="password" placeholder="Repeat Password" name="c_pass_repeat">

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="window.location.href = 'index.php'">Cancel</button>
                <button type="submit" class="signupbtn" name="register">Sign Up</button>
            </div>
        </div>
    </form>
    <?php include("./includes/footer.php"); ?>
    <script src="./js/js.js"></script>
</body>

</html>