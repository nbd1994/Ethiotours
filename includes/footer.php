<head>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;

            text-decoration: none;
            list-style: none;
            font-family: "Arial", sans-serif;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        html {
            scrollbar-width: none;
            /* For Firefox */
            -ms-overflow-style: none;
            /* For Internet Explorer and Edge */
        }

        /*footer style starts here*/
        .footer {
            display: flex;
            flex-flow: row wrap;
            padding: 30px 30px 20px 30px;
            color: #092635;
            background-color: #5C8374;
            background-image: url('<?=ROOT_PATH?>images/footerImage.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            border-top: 1px solid #e5e5e5;
        }

        .footer>* {
            flex: 1 100%;
        }

        .nav__title {
            font-weight: 400;
            font-size: 15px;
            font-size: 18px;
        }

        .footer ul {
            list-style: none;
            padding-left: 0;
            font-size: 14px;
        }

        .footer li {
            line-height: 2em;
        }

        .footer a {
            text-decoration: none;
        }

        .footer__nav {
            display: flex;
            flex-flow: row wrap;
        }

        .footer__nav>* {
            flex: 1 50%;
            margin-right: 1.25em;
        }

        .nav__ul a {
            color: #e5e5e5;
        }

        .nav__ul--extra {
            column-count: 2;
            column-gap: 1.25em;
        }

        .legal {
            display: flex;
            flex-wrap: wrap;
            color: #e5e5e5;
            font-size: 14px;
        }

        @media screen and (min-width: 24.375em) {
            .legal .legal__links {
                margin-left: auto;
            }
        }

        @media screen and (min-width: 40.375em) {
            .footer__nav>* {
                flex: 1;
            }

            .nav__item--extra {
                flex-grow: 2;
            }

            .footer__addr {
                flex: 1 0px;
            }

            .footer__nav {
                flex: 2 0px;
            }
        }

        /*footer style ends here*/
    </style>
</head>
<footer class="footer">
    <div class="footer__addr">
        <a href="index.php" class="logolink"><img src="<?=ROOT_PATH?>images/EthioToursLogo.svg" alt="EthioTours Logo" class="logo" style="width: 100px; height:auto;"></a>
        <!-- <h2>Contact</h2>

            <address>
                5534 Somewhere In. The World 22193-10212<br>
                <a class="footer__btn" href="mailto:example@gmail.com">Email Us</a>
            </address> -->
    </div>

    <ul class="footer__nav">
        <li class="nav__item">
            <h2 class="nav__title">Media</h2>

            <ul class="nav__ul">
                <li>
                    <a href="#">Online</a>
                </li>

                <li>
                    <a href="#">Print</a>
                </li>

                <li>
                    <a href="#">Alternative Ads</a>
                </li>
            </ul>
        </li>

        <li class="nav__item nav__item--extra">
            <h2 class="nav__title">Technology</h2>

            <ul class="nav__ul nav__ul--extra">
                <li>
                    <a href="#">Hardware Design</a>
                </li>

                <li>
                    <a href="#">Software Design</a>
                </li>

                <li>
                    <a href="#">Digital Signage</a>
                </li>

                <li>
                    <a href="#">Automation</a>
                </li>

                <li>
                    <a href="#">Artificial Intelligence</a>
                </li>

                <li>
                    <a href="#">IoT</a>
                </li>
            </ul>
        </li>

        <li class="nav__item">
            <h2 class="nav__title">Legal</h2>

            <ul class="nav__ul">
                <li>
                    <a href="#">Privacy Policy</a>
                </li>

                <li>
                    <a href="#">Terms of Use</a>
                </li>

                <li>
                    <a href="#">Sitemap</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="legal">
        <p>&copy; 2024 All rights reserved.</p>
    </div>
</footer>