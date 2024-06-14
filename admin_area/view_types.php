<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View types</title>
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
        <div class="view_types">
            <h2 style="margin: 10px; text-align:center;">View Types</h2>
            <table>
                <tr>
                    <th>type ID</th>
                    <th>type Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                include("includes/db.php");

                $get_type = "select * from types";
                $run_type = mysqli_query($con, $get_type);

                $i = 0;

                while ($row_type = mysqli_fetch_array($run_type)) {
                    $type_id = $row_type['type_id'];
                    $type_title = $row_type['type_title'];
                    $i++;
                ?>
                    <tr align="center">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $type_title; ?></td>
                        <td><a href="index.php?edit_type=<?php echo $type_id; ?>">Edit</a></td>
                        <td><a href="delete_type.php?delete_type=<?php echo $type_id; ?>">Delete</a></td>
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