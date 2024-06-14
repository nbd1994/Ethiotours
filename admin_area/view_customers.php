<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View Customers</title>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border-bottom: solid #DEE2E6;
                text-align: center;
                padding: 8px;
            }

            .view_customers table .img {
                width: 50px;
                height: 50px;
                border-radius: 100%;
            }
        </style>
    </head>

    <body>
        <div class="view_customers">
            <h2 style="margin: 10px; text-align:center;">View Customers</h2>
            <table>
                <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Passport</th>
                    <th>Image</th>
                    <th>Delete</th>
                </tr>
                <?php
                include("includes/db.php");

                $get_c = "select * from customers";
                $run_c = mysqli_query($con, $get_c);

                $i = 0;

                while ($row_c = mysqli_fetch_array($run_c)) {
                    $c_id = $row_c['customer_id'];
                    $c_name = $row_c['customer_name'];
                    $c_email = $row_c['customer_email'];
                    $c_passport = $row_c['c_passport'];
                    $c_image = $row_c['customer_image'];
                    $i++;
                ?>
                    <tr align="center">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $c_name; ?></td>
                        <td><?php echo $c_email; ?></td>
                        <td><?php echo $c_passport; ?></td>
                        <td><img class="img" src="../customer/customer_images/<?php echo $c_image; ?>" width="50" height="50"></td>
                        <td><a href="delete_c.php?delete_c=<?php echo $c_id; ?>">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </body>

    </html>
<?php
}
?>