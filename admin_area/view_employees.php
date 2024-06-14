<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>View Employees</title>
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
        <div class="view_employees">
            <h2 style="margin: 10px; text-align:center;">View Employees</h2>
            <table>
                <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                include("includes/db.php");
                $get_c = "select * from employees";
                $run_c = mysqli_query($con, $get_c);
                $i = 0;

                while ($row_c = mysqli_fetch_array($run_c)) {
                    $e_id = $row_c['emp_id'];
                    $e_name = $row_c['emp_name'];
                    $e_email = $row_c['emp_email'];
                    $e_designation = $row_c['emp_designation'];
                    $e_location = $row_c['emp_location'];
                    $e_address = $row_c['emp_address'];
                    $e_contact = $row_c['emp_contact'];
                    $i++;
                ?>
                    <tr align="center">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $e_name; ?></td>
                        <td><?php echo $e_email; ?></td>
                        <td><?php echo $e_designation; ?></td>
                        <td><?php echo $e_location; ?></td>
                        <td><?php echo $e_address; ?></td>
                        <td><?php echo $e_contact; ?></td>
                        <td><a href="index.php?edit_emp=<?php echo $e_id; ?>">Edit</a></td>
                        <td><a href="delete_e.php?delete_e=<?php echo $e_id; ?>">Delete</a></td>
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