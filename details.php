<?php
include("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins" />
    <title>Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .detailsMainContainer {
            width: 100%;
            height: 100vh;
            /* background-color: aquamarine; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .detailsContainer {
            /* background-color: antiquewhite; */
            width: 80%;
            height: 85vh;
            display: flex;
        }

        .detailsContainer .pdtImg {
            width: 50%;
            object-fit: cover;
        }

        .pdtDetails .title {
            font-family: "Abril Fatface", serif;
            font-size: 46px;
            text-align: center;
            margin: 10px 0;
        }

        .pdtDetails .price {
            font-size: 36px;
            color: #45a1a1;
            margin: 10px 0;
            margin-left: 25px;
        }

        .pdtDetails .desc {
            overflow-y: hidden;
            overflow-wrap: normal;
            font-family: Poppins, sans-serif;
            font-size: 16px;
            margin: 10px 25px;
            margin-bottom: 30px;
        }

        .pdtDetails .btn {
            font-family: Poppins, sans-serif;
            text-decoration: none;
            position: absolute;
            bottom: 5%;
            left: 70%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #5c8374;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            /* border-radius: 5px; */
        }

        .pdtDetails .btn:hover,
        .packageContainer .btn:hover {
            background-color: #092635;
        }
    </style>
</head>

<body>
    <div class="detailsMainContainer">
        <?php
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

                echo " <div class='detailsContainer'>
            <img src='admin_area/package_images/$pack_image' alt='pdtImg' class='pdtImg' />
            <div class='pdtDetails'>
                <h2 class='title'>$pack_title</h2>
                <h3 class='price'>\$$pack_price</h3>
                <p class='desc'>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci
                    sed ullam hic sapiente suscipit eligendi minima labore velit ipsum
                    odit? Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Adipisci sed ullam hic sapiente suscipit eligendi minima labore
                    velit ipsum odit?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci
                    sed ullam hic sapiente suscipit eligendi minima labore velit ipsum
                    odit? Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Adipisci sed ullam hic sapiente suscipit eligendi minima labore
                    velit ipsum odit?
                </p>
                <a href='cart.php?pack_id=$pack_id' class='btn'>Book Now</a>
            </div>
        </div>";
            }
            echo "
            </div>";
        }

        ?>
