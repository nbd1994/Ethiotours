<?php
session_start();
include("functions/functions.php");
if(isset($_GET['pay']) && $_GET['pay'] =='ok'){
    echo '<script>alert("Payment Successful");</script>';
    unset($_GET['pay']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="./style/WhatMakesUsUnique.css" />
    <title>EthioTours</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;

            text-decoration: none;
            list-style: none;
            font-family: "Arial", sans-serif;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        html {
            scrollbar-width: none;
            /* For Firefox */
            -ms-overflow-style: none;
            /* For Internet Explorer and Edge */
        }

        /* Slideshow container */
        .slideshow-container {
            /* max-width: 1080px; */
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /*images carausel*/
        .mySlides img {
            width: 100%;
            height: 90vh;
            object-fit: cover;
            max-height: 600px;
        }

        /* Style the buttons inside the carausel*/
        .mySlides .btn {
            position: absolute;
            bottom: 5%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #5C8374;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            /* border-radius: 5px; */
        }

        .mySlides .btn:hover,
        .packageContainer .btn:hover {
            background-color: #092635;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .mySlides .text {
            color: #f2f2f2;
            font-size: 24px;
            /* padding: 8px 12px; */
            position: absolute;
            /* bottom: 8px; */
            width: 100%;
            /* text-align: center; */

            top: 50%;
            left: 10%;
            /* transform: translate(-50%, -50%); */
        }

        .mySlides .text p {
            font-size: 16px;
        }


        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .6
            }

            to {
                opacity: 1
            }
        }

        /* packageCards style starts here */
        .packageContainer {
            max-width: 1000px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .packageContainer .card {
            background-color: white;
            width: calc(33% - 30px);
            margin-bottom: 30px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            /* border-radius: 10px; */
            overflow: hidden;
        }

        .packageContainer .cardTitle {
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
        }

        .packageContainer .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .packageContainer .card-body {
            height: 250px;
            padding: 15px;
        }

        .packageContainer .card-title {
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        .packageContainer .card-text {
            height: 70%;
            overflow-y: hidden;
            overflow-wrap: normal;
            /* white-space: nowrap; */
            font-family: 'Pacifico', cursive;
            font-size: 14px;
            color: #777;
            line-height: 1.6;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .packageContainer .btn {
            margin-left: 25%;
            background-color: #5C8374;
            color: white;
            font-size: 14px;
            padding: 6px 14px;
            border: none;
            cursor: pointer;
            /* border-radius: 5px; */
        }

        /* packageCards style ends here */
    </style>
</head>


<body>
    <!-- nav bar starts here -->
    <?php include("./includes/navbar.php"); ?>
    <!-- nav bar ends here -->

    <!-- Slideshow container -->
    <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <img src="./images/propPic1.jpg">
            <div class="text">
                <h2>Discover with us</h2>
                <p>home for you personal travel</p>
            </div>
            <button class="btn" onclick="window.location.href='all_packages.php';">Explore More</button>
        </div>

        <div class="mySlides fade">
            <img src="./images/propPic2.jpg">
            <div class="text">
                <h2>Exclusively Picked For You</h2>
                <p>home for you personal travel</p>
            </div>
            <button class="btn">Explore More</button>
        </div>

        <div class="mySlides fade">
            <img src="./images/propPic3.jpg">
            <div class="text">
                <h2>See New Horizon</h2>
                <p>home for you personal travel</p>
            </div>
            <button class="btn">Explore More</button>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>


    <!-- package cards starts here -->
    <div class="packageContainer">
        <div class="cardTitle">
            <h2>Our Picks For You</h2>
        </div>
        <?php
        $get_pack = "SELECT * FROM packages";

        $run_pack = mysqli_query($con, $get_pack);
        $cnt = 6;
        while ($row_pack = mysqli_fetch_array($run_pack)) {
            if ($cnt <= 0) {
                break;
            }
            $cnt--;
            $pack_id = $row_pack['package_id'];
            $pack_title = $row_pack['package_title'];
            $pack_image = $row_pack['package_image'];
            $pack_desc = $row_pack['package_desc'];

            echo "
            <div class='card'>
                <img src='admin_area/package_images/$pack_image' alt='London'>
                <div class='card-body'>
                    <h3 class='card-title'>$pack_title</h3>
                        <div class='card-text'>
                            <p>$pack_desc</p>
                        </div>
                    <a href='details.php?pack_id=$pack_id' class='btn'>Discover place</a>
                </div>
            </div>
        ";
        }
        ?>
    </div>
    <!-- package cards ends here -->

    <!-- whhat makes us unique section starts here -->
    <section class="desalegn">
        <div class="mainContainer">
            <div class="OurValuesContainer">
                <div class="OurValues">
                    <div class="aboutValues">
                        <span class="aboutTitle">About Our Values</span>
                        <p class="par">
                            Embark on a journey of authenticity and sustainability with our
                            innovative technology, personalized just for you. Experience
                            Ethiopia seamlessly, guided by our unwavering commitment to
                            integrity and passion for excellence.
                        </p>
                    </div>
                    <div class="value1">
                        <i class="fa fa-child" style="font-size: 18px"></i>
                        <br />
                        <span class="value1Title">Authenticity</span>
                        <p class="par">
                            Authenticity is at the heart of our mission. We are dedicated to
                            showcasing the genuine beauty and culture of Ethiopia, offering
                            travelers truly immersive and meaningful experiences that
                            reflect the country's rich heritage.
                        </p>
                    </div>
                    <div class="value2">
                        <i class="fa fa-calendar-check-o" style="font-size: 18px"></i>
                        <br />
                        <span class="value2Title">Commitment</span>
                        <p class="par">
                            Our constant commitment to our work and clients forms an
                            unbreakable bond. Commitment is a cornerstone of our approach.
                            We are committed to promoting responsible travel practices,
                            supporting local communities,
                        </p>
                    </div>
                    <div class="value3">
                        <i class="fa fa-cogs" style="font-size: 18px"></i>
                        <br />
                        <span class="value3Title">Technology</span>
                        <p class="par">
                            Leveraging cutting-edge technology,We offers seamless
                            navigation, real-time updates, and user-friendly interfaces for
                            a modern and convenient travel experience.
                        </p>
                    </div>
                </div>
            </div>

            <div class="OurValues2Container">
                <div class="OurValues2">
                    <div class="value4">
                        <i class="fa fa-wrench" style="font-size: 18px"></i>
                        <br />
                        <span class="value4Title">Customization</span>
                        <p class="par">
                            We understand that every traveler is unique. That's why we offer
                            personalized itineraries and tailored recommendations, allowing
                            visitors to create their own bespoke adventures that align with
                            their individual interests and preferences.
                        </p>
                    </div>
                    <div class="value5">
                        <i class="fa fa-credit-card-alt" style="font-size: 18px"></i>
                        <br />
                        <span class="value5Title">Seamless</span>
                        <p class="par">
                            Seamless travel is our promise. From booking accommodations to
                            arranging transportation and activities, we provide a
                            streamlined and hassle-free planning process, ensuring that
                            every aspect of the journey is well-organized and stress-free.
                        </p>
                    </div>
                    <div class="OurGoal">
                        <span class="OurGoalTitle">Our Goal Statement</span>
                        <p class="par">
                            At EthioTours, we live by action, progress, and growth. Through
                            innovative technology and personalized experiences, we aim to
                            provide seamless and unforgettable journeys, driven by our
                            commitment to integrity and passion for excellence. Ready to
                            make us your travel partner? Reach out to us.
                        </p>
                        <button class="button"><span>More</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- whhat makes us unique section ends here -->


    <!-- footer starts here -->
    <?php include("./includes/footer.php"); ?>
    <!-- footer ends here -->
    <script src="./js/js.js"></script>
</body>

</html>