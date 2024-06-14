<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: 0;
                font-family: "Lato", sans-serif;

                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }

            ::-webkit-scrollbar {
                display: none;
            }

            .dashContainer {
                background-color: #F4F5F7;
                display: flex;
                justify-content: space-between;
                /* margin-top: 15px; */
                flex-wrap: wrap;
            }

            .sidebarContainer {
                width: 20%;
                background-color: #F4F5F7;
                /* max-height: 300px; */
                margin-top: 15px;
            }

            .dashboardPagesContainer {
                width: 75%;
                /* background-color: aquamarine; */
                /* height: 500px; */
                /* background-color: rgb(195, 180, 170); */
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: center;
                margin-top: 15px;

                background-color: #FFFFFF;
                border-top-left-radius: 15px;
                border-bottom-left-radius: 15px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.736);

                max-height: 400px;
                overflow-y: scroll;
            }

            .dashboardPagesContainer div {
                width: 95%;
                height: 95%;
            }

            .dashboardPagesContainer * {
                background-color: #FFFFFF;

            }

            .sidebarContainer a {
                display: block;
                padding: 10px;
                text-decoration: none;
                color: #474747;
                text-align: center;
            }

            .sidebarContainer a:hover {
                background-color: lightgray;
                /* Change the background color on hover */
                color: white;
                /* Change the text color on hover */
            }

            .dashHeader {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
            }

            .adminTitle {
                font-size: 24px;
                font-family: "Pacifico", cursive;
                width: 25%;
                text-align: center;
                /* background-color: brown; */
                color: black;
                padding: 20px 0;
            }

            .helloAdmin * {
                font-size: 24px;
                font-family: "Pacifico", cursive;
                color: #474747;
                /* text-align: center; */
                /* padding: 20px 0; */
            }
        </style>
    </head>

    <body>
        <?php include("../includes/navbar.php"); ?>
        <div class="dashContainer">
            <div class="dashHeader">
                <h1 class="adminTitle">admin</h1>
                <div class="helloAdmin">
                    <h2>Hello Admin</h2>
                    <h3>Your Performance Summary</h3>
                </div>
            </div>
            <div class="sidebarContainer">
                <a href="index.php">Admin Panel : Home</a>
                <a href="index.php?insert_package">Insert New Package</a>
                <a href="index.php?view_packages">View All Packages</a>
                <a href="index.php?insert_cat">Insert New Categories</a>
                <a href="index.php?view_cats">View All Categories</a>
                <a href="index.php?insert_type">Insert New Types</a>
                <a href="index.php?view_types">View All Types</a>
                <a href="index.php?insert_employee">Insert New Employee</a>
                <a href="index.php?view_employees">View All Employees</a>
                <a href="index.php?view_customers">View All Customers</a>
                <a href="index.php?view_orders">View Orders</a>
                <a href="index.php?view_payments">View Payments</a>
                <a href="logout.php">Logout</a>
            </div>
            <div class="dashboardPagesContainer">
                <?php
                if (isset($_GET['insert_package'])) {
                    include("insert_package.php");
                }
                if (isset($_GET['view_packages'])) {
                    include("view_packages.php");
                }
                if (isset($_GET['edit_pack'])) {
                    include("edit_pack.php");
                }
                if (isset($_GET['insert_cat'])) {
                    include("insert_cat.php");
                }
                if (isset($_GET['view_cats'])) {
                    include("view_cats.php");
                }
                if (isset($_GET['edit_cat'])) {
                    include("edit_cat.php");
                }
                if (isset($_GET['insert_type'])) {
                    include("insert_type.php");
                }
                if (isset($_GET['view_types'])) {
                    include("view_types.php");
                }
                if (isset($_GET['edit_type'])) {
                    include("edit_type.php");
                }
                if (isset($_GET['view_customers'])) {
                    include("view_customers.php");
                }
                if (isset($_GET['insert_employee'])) {
                    include("insert_employee.php");
                }
                if (isset($_GET['view_employees'])) {
                    include("view_employees.php");
                }
                if (isset($_GET['edit_emp'])) {
                    include("edit_emp.php");
                }
                ?>
            </div>
        </div>
        </div>
    </body>

    </html>
    <?php include("../includes/footer.php"); ?>
<?php
}
?>