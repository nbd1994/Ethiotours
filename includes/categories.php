<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .categoryContainer {
            /* background-color: blue; */
            font-family: "Arial", sans-serif;
            /* max-width: 1000px; */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .categoryContainer ul li {
            font-size: 16px;
            display: inline-block;
            /* line-height: 60px; */
            margin: 0 5px;
            /* border-radius: 5px; */
            padding: 2px 0px;
            background-color: #9EC8B9;
        }

        .categoryContainer ul {
            margin-top: 15px;
            padding: 10px 0;
        }

        .categoryContainer ul li a {
            text-decoration: none;
            padding: 5px 10px;
        }

        .searchBarContainer {
            width: 100%;
            overflow: hidden;
            background-color: #e9e9e9;
        }

        .searchBarContainer {
            padding: 5px 0;
            display: flex;
            justify-content: center;
        }

        .searchBarContainer input[type="text"] {
            padding: 5px 15px;
            border: solid 1px;
        }

        .searchBarContainer button {
            padding: 3px 4px;
            /* margin-top: 8px; */
            margin-left: 8px;
            background: #ddd;
            font-size: 15px;
            border: none;
            cursor: pointer;
        }

        .searchBarContainer button:hover {
            background: #ccc;
        }
    </style>
</head>

<body>
    <div class="categoryContainer">
        <div class="searchBarContainer">
            <form method="get" enctype="multipart/form-data">
                <input type="text" placeholder="Search.." name="user_query" />
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <ul>
            <!-- <li><a class="active" href="all_packages.php">Packages</a></li>
        <li><a href="<?= ROOT_PATH ?>includes/signin.php">Sign in</a></li>
        <li><a href="<?= ROOT_PATH ?>signup.php">Sign Up</a></li>
        <li><a href="<?= ROOT_PATH ?>contact.php">Contact Us</a></li>
        <li><a href="admin_area/index.php">Admin</a></li> -->
            <?php getCats(); ?>
            <?php getTypes(); ?>
        </ul>
    </div>
</body>

</html>