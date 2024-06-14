<?php
// session_start();
// include("functions/functions.php");
include("includes/db.php");
// global $con;

$package_name_error = "";
$package_image_error = "";
$package_category_error = "";
$package_type_error = "";
$package_price_error = "";
$package_desc_error = "";
$package_keywords_error = "";

if (isset($_POST['insert'])) {
    // $ip = getIp();
    $package_title = mysqli_real_escape_string($con, $_POST['package_title']);
    $package_image = $_FILES['package_image']['name'];
    $package_image_tmp = $_FILES['package_image']['tmp_name'];
    $package_cat = mysqli_real_escape_string($con, $_POST['package_cat']);
    $package_type = mysqli_real_escape_string($con, $_POST['package_type']);
    $package_price = mysqli_real_escape_string($con, $_POST['package_price']);
    $package_desc = mysqli_real_escape_string($con, $_POST['package_desc']);
    $package_keywords = mysqli_real_escape_string($con, $_POST['package_keywords']);

    // Validate name
    if (empty($package_title)) {
        $package_name_error = "Name is required.";
    }

    // Validate image
    if (empty($package_image)) {
        $package_image_error = "Image is required.";
    }

    // Validate cat
    if (empty($package_cat)) {
        $package_category_error = "Category is required.";
    }

    // Validate type
    if (empty($package_type)) {
        $package_type_error = "Type is required.";
    }

    // Validate price
    if (empty($package_price)) {
        $package_price_error = "Price is required.";
    } else if (!is_numeric($package_price)) {
        $package_price_error = "invalid Price input";
    } else {
        $package_price = (float)$package_price;
    }

    // Validate desc
    if (empty($package_desc)) {
        $package_desc_error = "Description is required.";
    }
    if (empty($package_keywords)) {
        $package_keywords_error = "Keywords is required.";
    }
    // If all inputs are valid, insert the package data
    if (
        empty($package_name_error) && empty($package_category_error) && empty($package_desc_error) && empty($package_image_error) &&
        empty($package_price_error) && empty($package_type_error) && empty($package_keywords_error)
    ) {
        move_uploaded_file($package_image_tmp, "package_images/$package_image");

        $insert_package = "insert into packages (package_cat, package_type, package_title, package_price, package_desc, package_image, package_keywords) values ('$package_cat','$package_type','$package_title','$package_price','$package_desc','$package_image','$package_keywords')";

        $insert_pack = mysqli_query($con, $insert_package);

        if ($insert_pack) {
            echo "<script>alert('Package has been inserted!')</script>";
            echo "<script>window.open('index.php?insert_package','_self')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>admin: inserting Package</title>

    <style>
        .signForm {
            font-family: Arial, Helvetica, sans-serif;
            /* background-color: #04AA6D; */
            width: 100%;
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

        .signupbtn {
            padding: 14px 20px;
            background-color: #1B4242;
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
            max-width: 100%;
            margin: 0 auto;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .error {
            color: red;
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

    <form class="signForm" action="index.php?insert_package" style="border:1px solid #ccc" enctype="multipart/form-data" method="post">
        <div class="container">
            <h1>Inserting a Package</h1><br>
            <hr>
            <label for="package_title"><b>Package Name</b></label><span class="error"> *<?php echo $package_name_error; ?></span>
            <input type="text" placeholder="Package Name" name="package_title">

            <label for="package_image"><b>Package Image</b></label><span class="error"> *<?php echo $package_image_error; ?></span><br>
            <input type="file" name="package_image">


            <label for="c_country"><b>Package Type</b></label><span class="error"> *<?php echo $package_type_error; ?></span><br>
            <select name="package_type">
                <?php $get_types = "select * from types";
                $run_types = mysqli_query($con, $get_types);
                while ($row_types = mysqli_fetch_array($run_types)) {
                    $type_id = $row_types['type_id'];
                    $type_title = $row_types['type_title'];
                    echo "<option value='$type_id'>$type_title</option>";
                } ?>
            </select>

            <label for="c_country"><b>Package Category</b></label><span class="error"> *<?php echo $package_category_error; ?></span><br>
            <select name="package_cat">
                <?php $get_cats = "select * from categories";
                $run_cats = mysqli_query($con, $get_cats);
                while ($row_cats = mysqli_fetch_array($run_cats)) {
                    $cat_id = $row_cats['cat_id'];
                    $cat_title = $row_cats['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                } ?>
            </select>

            <label for="package_price"><b>Package Price</b></label><span class="error"> *<?php echo $package_price_error; ?></span>
            <input type="text" placeholder="Package Price" name="package_price">

            <label for="package_desc"><b>Package Description</b></label><span class="error"> *<?php echo $package_desc_error; ?></span><br>
            <textarea name="package_desc" cols=100 rows="10"></textarea><br><br>

            <label for="package_price"><b>Package Keywords</b></label><span class="error"> *<?php echo $package_keywords_error; ?></span>
            <input type="text" placeholder="Package keywords" name="package_keywords">

            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="window.location.href = 'index.php'">Cancel</button>
                <button type="submit" class="signupbtn" name="insert" value="Insert Package">Insert</button>
            </div>
        </div>
    </form>
    <script src="./js/js.js"></script>
</body>

</html>