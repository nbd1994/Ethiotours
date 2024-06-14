<?php
// session_start();
?>
<style>
    /* nav bar style starts here */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .scrolled {
        background-color: #1B4242 !important;
        /* position: fixed; */
    }

    nav {
        height: 60px;
        width: 100%;
        font-family: "Arial", sans-serif;

        z-index: 1000;
        background-color: transparent;
    }


    nav .logo {
        fill: #9EC8B9;
        width: auto;
        height: 60px;
        margin: 0px 50px;
    }

    nav ul {
        float: right;
        margin-right: 20px;
    }

    nav ul li {
        display: inline-block;
        line-height: 60px;
        margin: 0 5px;
    }

    nav ul li a {
        color: #FFFF;
        font-size: 16px;
        padding: 7px 13px;
        text-transform: uppercase;
    }

    a:hover {
        background: #5C8374;
        transition: .5s;
    }

    .checkbtn {
        font-size: 30px;
        color: white;
        float: right;
        line-height: 80px;
        margin-right: 40px;
        cursor: pointer;
        display: none;
    }

    #check {
        display: none;
    }

    @media (max-width: 952px) {
        nav .logo {
            font-size: 30px;
            padding-left: 50px;
        }

        nav ul li a {
            font-size: 14px;
        }
    }

    @media (max-width: 858px) {
        .checkbtn {
            display: block;
        }

        ul {
            position: fixed;
            width: 100%;
            height: 100vh;
            background: #5C8374;
            top: 80px;
            left: -100%;
            text-align: center;
            transition: all .5s;
        }

        nav ul li {
            display: block;
            margin: 50px 0;
            line-height: 30px;
        }

        nav ul li a {
            font-size: 20px;
        }

        a:hover,
        a.active {
            background: none;
            color: #0082e6;
        }

        #check:checked~ul {
            left: 0;
        }
    }

    /* nav bar style ends here */
</style>
</head>
<!-- <?php define('ROOT_PATH', "http://localhost/Websites/EthioTours/"); ?> -->
<nav class="scrolled fixed">
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <a href="<?=ROOT_PATH?>index.php" class="logolink"><img src="<?= ROOT_PATH ?>images/EthioToursLogo.svg" alt="EthioTours Logo" class="logo"></a>
    <ul>
        <?php
        if (isset($_SESSION['customer_email'])) { ?>
            <li><a class="active" href="<?=ROOT_PATH?>all_packages.php">Packages</a></li>
            <li><a href="<?= ROOT_PATH ?>customer/my_account.php">Profile</a></li>
            <li><a href="<?= ROOT_PATH ?>contact.php">Contact Us</a></li>
        <?php }else{ ?>
        <li><a class="active" href="all_packages.php">Packages</a></li>
        <li><a href="<?= ROOT_PATH ?>includes/signin.php">Sign in</a></li>
        <li><a href="<?= ROOT_PATH ?>signup.php">Sign Up</a></li>
        <li><a href="<?= ROOT_PATH ?>contact.php">Contact Us</a></li>
        <li><a href="admin_area/index.php">Admin</a></li>
            <?php }?>
    </ul>
</nav>
<script src="../js/js.js"></script>