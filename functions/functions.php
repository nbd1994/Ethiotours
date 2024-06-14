<?php define('ROOT_PATH', "http://localhost/Websites/EthioTours/");?>
<body>
    <style>
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
            margin: 15px 0;
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
            /* margin-left: 25%; */
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
</body>

<?php

$con = mysqli_connect("localhost", "root", "", "tagency");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//getting user ip address
function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

//creating the shopping cart
function cart()
{
    if (isset($_GET['add_cart'])) {
        global $con;
        $ip = getIp();
        $pack_id = $_GET['add_cart'];
        $check_pack = "select * from cart where ip_add='$ip' and p_id='$pack_id'";

        $run_check = mysqli_query($con, $check_pack);

        if (mysqli_num_rows($run_check) > 0) {
            echo "";
        } else {
            $insert_pack = "insert into cart (p_id, ip_add) values ('$pack_id','$ip')";
            $run_pack = mysqli_query($con, $insert_pack);
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

//getting the total added items
function total_items()
{
    global $con;
    if (isset($_GET['add_cart'])) {
        $ip = getip();
        $get_items = "select * from cart where ip_add='$ip'";
        $run_items = mysqli_query($con, $get_items);
        $count_items = mysqli_num_rows($run_items);
    } else {
        $ip = getip();
        $get_items = "select * from cart where ip_add='$ip'";
        $run_items = mysqli_query($con, $get_items);
        $count_items = mysqli_num_rows($run_items);
    }
    echo $count_items;
}

//getting the total price of the items in the carts
function total_price()
{
    global $con;
    $total = 0;
    $ip = getIp();
    $sel_price = "select * from cart where ip_add='$ip'";
    $run_price = mysqli_query($con, $sel_price);

    while ($p_price = mysqli_fetch_array($run_price)) {
        $pack_id = $p_price['p_id'];
        $pack_price = "select * from packages where package_id='$pack_id'";
        $run_pack_price = mysqli_query($con, $pack_price);

        while ($pp_price = mysqli_fetch_array($run_pack_price)) {
            $package_price = array($pp_price['package_price']);
            $values = array_sum($package_price);
            $total += $values;
        }
    }
    echo "$" . $total;
}

//getting the categories
function getCats()
{
    global $con;
    $get_cats = "select * from categories";

    $run_cats = mysqli_query($con, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='all_packages.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

//getting the types
function getTypes()
{
    global $con;
    $get_types = "select * from types";

    $run_types = mysqli_query($con, $get_types);

    while ($row_types = mysqli_fetch_array($run_types)) {
        $type_id = $row_types['type_id'];
        $type_title = $row_types['type_title'];

        echo "<li><a href='all_packages.php?type=$type_id'>$type_title</a></li>";
    }
}


//  for all the package cards
function getPack()
{
    if (!isset($_GET['cat'])) {
        if (!isset($_GET['type']))
            if (!isset($_GET['user_query'])) { {
                    global $con;
                    echo ("
    <div class='packageContainer'>
        <div class='cardTitle'>
            <h2>Packages</h2>
        </div>
        ");
                    $get_pack = 'SELECT * FROM packages order by RAND()';

                    $run_pack = mysqli_query($con, $get_pack);
                    while ($row_pack = mysqli_fetch_array($run_pack)) {
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
                    <div class='btns' style='display: flex; justify-content: space-around;'>
                        <a href='details.php?pack_id=$pack_id' class='btn'>Discover place</a>
                        <a href='cart.php?pack_id=$pack_id' class='btn'>Book</a>
                    </div>
                </div>
            </div>
        ";
                    }
                    echo ("</div>");
                }
            }
    }
}

//categroy wise packages
function getCatPack()
{
    if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        global $con;
        echo ("
    <div class='packageContainer'>
        <div class='cardTitle'>
            <h2>Packages</h2>
        </div>
        ");

        $get_cat_pack = "select * from packages where package_cat='$cat_id'";

        $run_cat_pack = mysqli_query($con, $get_cat_pack);

        $count_cats = mysqli_num_rows($run_cat_pack);

        if ($count_cats == 0) {
            echo "<h2 style='padding=20px;'>No packages were found in this category!</h2>";
        }

        $run_pack = mysqli_query($con, $get_cat_pack);
        while ($row_pack = mysqli_fetch_array($run_pack)) {
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
                    <div class = 'btns'>
                        <a href='details.php?pack_id=$pack_id' class='btn'>Discover place</a>
                        <a href='cart.php?pack_id=$pack_id' class='btn'>Book</a>
                    </div>
                </div>
            </div>
        ";
        }
        echo ("</div>");
    }
}


//type wise packages
function getTypePack()
{
    if (isset($_GET['type'])) {
        $type_id = $_GET['type'];
        global $con;
        echo ("
    <div class='packageContainer'>
        <div class='cardTitle'>
            <h2>Packages</h2>
        </div>
        ");
        $get_type_pack = "select * from packages where package_type='$type_id'";

        $run_type_pack = mysqli_query($con, $get_type_pack);

        $count_types = mysqli_num_rows($run_type_pack);

        if ($count_types == 0) {
            echo "<h2 style='padding=20px;'>No packages were found associated with this type!</h2>";
        }
        $run_pack = mysqli_query($con, $get_type_pack);
        while ($row_pack = mysqli_fetch_array($run_pack)) {
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
                    <div class = 'btns'>
                        <a href='details.php?pack_id=$pack_id' class='btn'>Discover place</a>
                        <a href='cart.php?pack_id=$pack_id' class='btn'>Book</a>
                    </div>
                </div>
            </div>
        ";
        }
        echo ("</div>");
    }
}
function getSearchResults()
{
    if (isset($_GET['user_query'])) {
        $search_query = $_GET['user_query'];
        global $con;
        echo ("
        <div class='packageContainer'>
            <div class='cardTitle'>
                <h2>Search Results</h2>
            </div>
            ");

        $get_pack = "SELECT * FROM packages WHERE package_keywords LIKE '%$search_query%'";

        $run_pack = mysqli_query($con, $get_pack);
        $row_pack = mysqli_fetch_array($run_pack);
        if (empty($row_pack)) echo "<p style='text-align:center;'>Couldn't Find Item</p>";
        else {
            do {
                $pack_id = $row_pack['package_id'];
                $pack_cat = $row_pack['package_cat'];
                $pack_type = $row_pack['package_type'];
                $pack_title = $row_pack['package_title'];
                $pack_price = $row_pack['package_price'];
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
                    <div class = 'btns'>
                        <a href='details.php?pack_id=$pack_id' class='btn'>Discover place</a>
                        <a href='cart.php?pack_id=$pack_id' class='btn'>Book</a>
                    </div>
                </div>
            </div>
        ";
            } while ($row_pack = mysqli_fetch_array($run_pack));
            echo ("</div>");
        }
    }
}
