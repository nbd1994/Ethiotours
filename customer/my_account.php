<?php
session_start();
include("functionss/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Online Shop</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>

<body>
    <!--Main container starts here-->
    <div class="main_wrapper">
        <!--Navbar starts here-->
        <?php include("../includes/navbar.php"); ?>
        <!--Navbar ends here-->
        <!--Content starts here-->
        <div class="content_wrapper">
            <div class="sidebar">
                <div id="sidebar_title">My Account:</div>
                <ul id="cats">
                    <?php
                    global $con;
                    $user = $_SESSION['customer_email'];
                    $get_img = "select * from customers where customer_email='$user'";
                    $run_img = mysqli_query($con, $get_img);
                    $row_img = mysqli_fetch_array($run_img);

                    $c_image = $row_img['customer_image'];
                    $c_name = $row_img['customer_name'];
                    echo "<p style='text-align: center;'><img src='customer_images/$c_image' width='150' height'150'/></p>";
                    ?>
                    <li><a href="my_account.php?orders">My Orders</a></li>
                    <li><a href="my_account.php?edit_account">Edit Account</a></li>
                    <li><a href="my_account.php?change_pass">Change Password</a></li>
                    <li><a href="my_account.php?delete_account">Delete Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>

            </div>
            <div id="content_area">
                <?php cart(); ?>

                <div id="shopping_cart">
                    <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">
                        <?php
                        if (isset($_SESSION['customer_email'])) {
                            echo "<b>Welcome: </b>" . $_SESSION['customer_email'];
                        }
                        ?>
                        <?php
                        if (!isset($_SESSION['customer_email'])) {
                            echo "<a href='checkout.php' style='color: orange;'>Login</a>";
                        } else {
                            echo "<a href='logout.php' style='color: orange;''>Logout</a>";
                        }
                        ?>
                    </span>
                </div>
                <div id="packages_box">
                    <!-- <?php
                            if (!isset($_GET['my_orders'])) {
                                if (!isset($_GET['edit_account'])) {
                                    if (!isset($_GET['change_pass'])) {
                                        if (!isset($_GET['delete_account'])) {
                                            echo "<h2 style='padding: 20px; color: black;'>Welcome: $c_name</h2><br>
                                    <b>You can see your orders' progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";
                                        }
                                    }
                                }
                            }
                            ?> -->
                    <?php
                    if (isset($_GET['orders'])) {
                        include("../includes/db.php");
                        $email = $_SESSION['customer_email'];
                        $email = $con->real_escape_string($email); // Sanitize the email to prevent SQL injection

                        $query = "SELECT package_id FROM booked WHERE customer_email = '$email'";
                        $result = $con->query($query);
                        // Added inline CSS for the table
                        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                        echo "<thead>";
                        echo "<tr>";
                        // Added inline CSS for table headers
                        echo "<th style='padding: 8px; text-align: left; background-color: #f2f2f2;'>No.</th>";
                        echo "<th style='padding: 8px; text-align: left; background-color: #f2f2f2;'>Title</th>";
                        echo "<th style='padding: 8px; text-align: left; background-color: #f2f2f2;'>Image</th>";
                        echo "<th style='padding: 8px; text-align: left; background-color: #f2f2f2;'>Price</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $no = 1; // Initialize a counter for the No. column
                        while ($val = mysqli_fetch_assoc($result)) {
                            $v = $val['package_id'];
                            $query = "SELECT * FROM packages WHERE package_id = $v";
                            $res = $con->query($query);
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                // Added inline CSS for table data
                                echo "<td style='padding: 8px;'>" . $no++ . "</td>";
                                echo "<td style='padding: 8px;'>" . htmlspecialchars($row['package_title']) . "</td>";
                                echo "<td style='padding: 8px;'><img src='../admin_area/package_images/" . htmlspecialchars($row['package_image']) . "' width='50px' height='50px' class='img' alt='Package Image' style='display: block; margin-left: auto; margin-right: auto;'></td>";
                                echo "<td style='padding: 8px;'>" . htmlspecialchars($row['package_price']) . "</td>";
                                echo "</tr>";
                            }
                        }
                        echo "</tbody>"; // Close the table body
                        echo "</table>"; // Close the table
                    }
                    ?>

                    <?php
                    if (isset($_GET['edit_account'])) {
                        include("edit_account.php");
                    }
                    if (isset($_GET['change_pass'])) {
                        include("change_pass.php");
                    }
                    if (isset($_GET['delete_account'])) {
                        include("delete_account.php");
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--Content ends here-->
        <? include("../includes/footer.php") ?>
    </div>
    <!--Main container ends here-->
</body>

</html>