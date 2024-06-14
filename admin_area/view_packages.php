<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View Packages</title>
        <style>
            /* viewPackages style starts here */
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

            /* tr:nth-child(even) {
                background-color: #dddddd;
            } */

            .view_packages table .img {
                width: 50px;
                height: 50px;
                border-radius: 100%;
            }

            /* viewPackages style ends here */
        </style>
    </head>

    <body>
        <div class="view_packages">
            <h2 style="margin: 10px; text-align:center;">View Packages</h2>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                include("includes/db.php");

                $get_pack = "select * from packages";
                $run_pack = mysqli_query($con, $get_pack);

                $i = 0;
                
                while ($row_pack = mysqli_fetch_array($run_pack)) {
                    $pack_id = $row_pack['package_id'];
                    $pack_title = $row_pack['package_title'];
                    $pack_image = $row_pack['package_image'];
                    $pack_price = $row_pack['package_price'];
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $pack_title; ?></td>
                        <td><img class="img" src="package_images/<?php echo $pack_image; ?>"></td>
                        <td><?php echo $pack_price; ?></td>
                        <td><a href="index.php?edit_pack=<?php echo $pack_id; ?>">Edit</a></td>
                        <td><a href="delete_pack.php?delete_pack=<?php echo $pack_id; ?>">Delete</a></td>
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