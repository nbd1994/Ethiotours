<?php
session_start();
include("db.php");
include("../functions/functions.php");
// define("ROOT_PATH", "http://localhost/Websites/EthioTours/");s
global $con;

$email_error = "";
$pass_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $c_email = mysqli_real_escape_string($con, $_POST['email']);
    // $c_pass = mysqli_real_escape_string($con, $_POST['pass']);

    $c_email = $_POST['email'];
    $c_pass =  $_POST['pass'];

    // var_dump($c_email);
    // var_dump($c_pass);
    // Validate email
    if (empty($c_email)) {
        $email_error = "Email is required.";
    } elseif (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format.";
    }

    // Validate password
    if (empty($c_pass)) {
        $pass_error = "Password is required.";
    }

    if (empty($email_error) && empty($pass_error)) {
        $sel_c = "SELECT * FROM customers WHERE customer_email='$c_email'";
        $run_c = mysqli_query($con, $sel_c);
        $check_customer = mysqli_num_rows($run_c);
        $row = mysqli_fetch_array($run_c, MYSQLI_ASSOC);

        // var_dump($run_c);
        // var_dump($row);
        if ($row) {
            $db_pass = $row['customer_pass'];

            // Verify password
            if (!password_verify($c_pass, $db_pass)) {
                $email_error = "Email or Password is incorrect.";
            } else {
                $ip = getIp();
                $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
                $run_cart = mysqli_query($con, $sel_cart);
                $check_cart = mysqli_num_rows($run_cart);

                if (!$check_cart) {
                    $_SESSION['customer_email'] = $c_email;
                    header("Location:".ROOT_PATH."customer/my_account.php?e=$c_email");
                    exit();
                } else {
                    $_SESSION['customer_email'] = $c_email;
                    header("Location: checkout.php");
                    exit();
                }
            }
        } else {
            $email_error = "Email or Password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EthioTours : Sign in</title>

    <style>
        .signForm {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
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
    <?php include("navbar.php"); ?>

    <form class="signForm" action="signin.php" style="border:1px solid #ccc" enctype="multipart/form-data" method="post">
        <div class="container">
            <h1>Sign In</h1><br>
            
            <label for="email"><b>Email</b></label><span class="error"> *<?php echo $email_error; ?></span>
            <input type="text" placeholder="Enter email" name="email">

            <label for="pass"><b>Password</b></label><span class="error"> *<?php echo $pass_error; ?></span>
            <input type="password" placeholder="Enter Password" name="pass">

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="window.location.href = '../index.php'">Cancel</button>
                <button type="submit" class="signupbtn" name="signin" value="login">Sign In</button>
            </div>
        </div>
    </form>
    <?php include("footer.php"); ?>
    <script src="../js/js.js"></script>
</body>

</html>