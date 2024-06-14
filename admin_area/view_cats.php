<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View Categories</title>
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
        </style>
    </head>

    <body>
        <div class="view_cats">
            <h2 style="margin: 10px; text-align:center;">View Categories</h2>
            <table>
                <tr>
                    <th>Category ID</th>
                    <th>Category Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                include("includes/db.php");
                $get_cat = "select * from categories";
                $run_cat = mysqli_query($con, $get_cat);

                $i = 0;

                while ($row_cat = mysqli_fetch_array($run_cat)) {
                    $cat_id = $row_cat['cat_id'];
                    $cat_title = $row_cat['cat_title'];
                    $i++;
                ?>
                    <tr align="center">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cat_title; ?></td>
                        <td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
                        <td><a href="delete_cat.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
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