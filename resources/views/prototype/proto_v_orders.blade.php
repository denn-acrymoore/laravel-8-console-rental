<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="./assets/css/home_styling.css">
</head>

<body>
    <header>
        <h1 class="item">
            <a href="/v_home.html">PLAYMORE</a>
            <div class="navIcon" onclick="openNav()">
                <img src="./assets/icons/menu.svg" alt="open menu icon">
            </div>

        </h1>

        <nav class="item nav">
            <ul>
                <!-- <li><a href="/v_orders.html" class="navButton customBtn orderbtn">My Orders</a></li>
                <li><a href="/v_login.html" class="navButton customBtn logInbtn">Log in</a></li> -->
                <!-- <li><a href="/v_login.html" class="navButton customBtn logInbtn">Log out</a></li> -->
                <!-- <li style="color: white; margin-right: 75px;">Stefan Dharmawan</li> -->
                <li><a href="/v_history.html" class="navButton customBtn historyBtn">Order History</a></li>
                <li><a href="/v_home.html" class="navButton customBtn homeBtn">Home</a></li>
            </ul>
        </nav>

        <aside class="sideBar" id="Sidebar">
            <div class="closeIcon" onclick="closeNav()">
                <img src="./assets/icons/x.svg" alt="close menu icon" />
            </div>
            <div class="sidebarMenu">
                <!-- <a href="#" class="sidebarButton">Orders</a>
                <a href="/v_login.html" class="sidebarButton customBtn logInbtn">Login</a>
                <a href="/v_register.html" class="sidebarButton signUpbtn">Sign up</a> -->
                <a href="/v_home.html" class="sidebarButton customBtn">Home</a>
                <a href="/v_history.html" class="sidebarButton customBtn">Order History</a>
            </div>
        </aside>
    </header>
    <main>
        <!-- ORDER YANG MASIH BELOM DIKONFIRMASI -->
        <div class="cart-header">
            <h1>Shopping Cart</h1>
        </div>
        <div class="cart-container">
            <div class="cart-item">
                <div class="grid-item image">
                    <img src="./assets/images/PS4.png" alt="" class="grid-item">
                </div>
                <div class="grid-item product-name">
                    <p>Playstation 4</p>
                </div>
                <div class="grid-item product-price">
                    <p>Rp 120.000,00</p>
                </div>
            </div>
            <div class="cart-item"></div>
            <div class="cart-item"></div>
            <div class="cart-item"></div>

        </div>
        <!-- TOTAL, STATUS SEMUA DI SINI -->
        <div class="cart-total">
            <div class="total-item status">
                <p style="color: red;">Belum dikonfirmasi</p>
            </div>
            <div class="total-item total">
                <P>Total</P>
                <p> Rp 120.000,00</p>
            </div>
            <div class="total-item button">
                <input class="confirmBtn" type="submit" value="confirm order">
            </div>
        </div>

        <!-- ORDER YANG ONGOING -->
        <div class="cart-header">
            <h1>Ongoing orders</h1>
        </div>
        <div class="cart-container">
            <div class="cart-item">
                <div class="grid-item image">
                    <img src="./assets/images/PS4.png" alt="" class="grid-item" width="120px">
                </div>
                <div class="grid-item product-name">
                    <p>Playstation 4</p>
                </div>
                <div class="grid-item product-price">
                    <p>Rp 120.000,00</p>
                </div>
            </div>
            <div class="cart-item"></div>
            <div class="cart-item"></div>
        </div>
        <!-- TOTAL, STATUS SEMUA DI SINI -->
        <div class="cart-total ongoing">
            <div class="total-item status">
                <p style="color:green;">Sudah dikonfirmasi</p>
            </div>
            <div class="total-item total ongoing">
                <P>Total</P>
                <p> Rp 120.000,00</p>
            </div>

        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-item a">
                <p>copyright</p>
            </div>
            <div class="footer-item b">
                <a href="https://www.facebook.com">
                    <img src="./assets/icons/media-icons/facebook.svg" alt="facebook icon">
                </a>

            </div>
            <div class="footer-item c">
                <a href="https://www.instagram.com">
                    <img src="./assets/icons/media-icons/instagram.svg" alt="instagram icon">
                </a>

            </div>
            <div class="footer-item d">
                <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210/"><img
                        src="./assets/icons/media-icons/linkedin.svg" alt="linkedIn icon">
                </a>

            </div>
            <div class="footer-item e">
                <a href="https://www.twitter.com">
                    <img src="./assets/icons/media-icons/twitter.svg" alt="twitter icon">
                </a>

            </div>
        </div>
    </footer>
    <script src="/assets/js/general_script.js"></script>
</body>

</html>