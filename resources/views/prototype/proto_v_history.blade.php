<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li><a href="/v_orders.html" class="navButton customBtn orderbtn">My Orders</a></li>
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
                <a href="/v_history.html" class="sidebarButton customBtn">My Orders</a>
                <a href="/v_home.html" class="sidebarButton customBtn">Home</a>
            </div>
        </aside>
    </header>
    <main>
        <div class="cart-header">
            <h1>Order History</h1>
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

        </div>

    </main>
</body>

</html>