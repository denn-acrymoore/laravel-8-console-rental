<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmore | Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home_styling.css') }}">
</head>

<body>
    <header>
        <h1 class="item">
            <a href="{{ route('home') }}">PLAYMORE</a>
            <div class="navIcon" onclick="openNav()">
                <img src="{{ asset('assets/icons/menu.svg') }}" alt="open menu icon">
            </div>

        </h1>

        <nav class="item nav">
            <ul>
                <!-- <li><a href="/v_orders.html" class="navButton customBtn orderbtn">My Orders</a></li>
                <li><a href="/v_login.html" class="navButton customBtn logInbtn">Log in</a></li> -->
                <!-- <li><a href="/v_login.html" class="navButton customBtn logInbtn">Log out</a></li> -->
                <!-- <li style="color: white; margin-right: 75px;">Stefan Dharmawan</li> -->
                <li><a href="{{ route('history') }}" class="navButton customBtn historyBtn">Order History</a></li>
                <li><a href="{{ route('home') }}" class="navButton customBtn homeBtn">Home</a></li>
            </ul>
        </nav>

        <aside class="sideBar" id="Sidebar">
            <div class="closeIcon" onclick="closeNav()">
                <img src="{{ asset('assets/icons/x.svg') }}" alt="close menu icon" />
            </div>
            <div class="sidebarMenu">
                <!-- <a href="#" class="sidebarButton">Orders</a>
                <a href="/v_login.html" class="sidebarButton customBtn logInbtn">Login</a>
                <a href="/v_register.html" class="sidebarButton customBtn">Sign up</a> -->
                <a href="{{ route('history') }}" class="sidebarButton customBtn">Order History</a>
                <a href="{{ route('home') }}" class="sidebarButton customBtn">Home</a>
            </div>
        </aside>
    </header>
    <main>
        <!-- ORDER YANG MASIH BELOM DIKONFIRMASI -->
        <div class="cart-header">
            <h1>Shopping cart</h1>
        </div>
        <div class="cart-container">
            <!-- INI BUAT ITEM YANG DIORDER -->
            @php
                $shopping_cart = session('shopping_cart');
                
                if(empty($shopping_cart))
                {
                    $shopping_cart = [];
                }

                $totalPrice = 0;
            @endphp

            @foreach ($consoles as $c)
                @if (in_array($c->id, $shopping_cart))
                    <div class="cart-item">
                        <div class="grid-item image">
                            <img src="{{ asset('console_images/' . $c->picture) }}" alt="" class="grid-item">
                        </div>
                        <div class="grid-item product-name">
                            <p>{{ $c->name }}</p>
                        </div>
                        <div class="grid-item product-price" data-price="{{ $c->price_per_day }}">
                            <p>
                                @php
                                    echo 'Rp ' . number_format($c->price_per_day) . ' / day'; 

                                    $totalPrice += $c->price_per_day;
                                @endphp    
                            </p>
                        </div>
                        <div class="grid-item product-delete">
                            <a href="/delete-shopping-cart/{{ $c->id }}" style="text-decoration: none"><span>&times;</span></a>
                        </div>
                    </div>
                @endif
            @endforeach
            {{-- <div class="cart-item"></div>
            <div class="cart-item"></div>
            <div class="cart-item"></div> --}}

            <!-- INI BUAT KALO BELOM ADA ORDER -->
            @if (empty($shopping_cart))
                <h2 class="empty-cart">No order yet!</h2>    
            @endif
        </div>
        <!-- TOTAL, STATUS SEMUA DI SINI -->
        <form id="shoppingCartForm" action="/submit-shopping-cart" method="POST" onkeydown="return event.key != 'Enter';">
            @csrf
            <div class="cart-total">
                <div class="total-item status">
                    <p style="color: red;">Not Confirmed</p>
                </div>
                <div class="total-item duration">
                    <p> How many days?</p>
                    <input type="number" name="duration" id="duration" min="1" max="30" value="1" required 
                    @if (empty($shopping_cart))
                        disabled    
                    @endif
                    >
                </div>
                <div class="total-item total">
                    <P>Total</P>
                    <p>
                        @php
                            echo 'Rp ' . number_format($totalPrice); 
                        @endphp
                    </p>
                </div>
                <div class="total-item button">
                    <input class="confirmBtn" id="confirmBtn" type="submit" value="Confirm Order" 
                    @if (empty($shopping_cart))
                        disabled    
                    @endif
                    >
                </div>
            </div>
        </form>
    </main>
    {{-- <footer id="footer-orders">
        <div class="footer-container">
            <div class="footer-item a">
                <p>copyright &#169; 2021 by Kelompok 7-IF430_A</p>
            </div>
            <div class="footer-item b">
                <a href="https://www.facebook.com">
                    <img src="{{ asset('assets/icons/media-icons/facebook.svg') }}" alt="facebook icon">
                </a>

            </div>
            <div class="footer-item c">
                <a href="https://www.instagram.com">
                    <img src="{{ asset('assets/icons/media-icons/instagram.svg') }}" alt="instagram icon">
                </a>

            </div>
            <div class="footer-item d">
                <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210/"><img
                        src="{{ asset('assets/icons/media-icons/linkedin.svg') }}" alt="linkedIn icon">
                </a>

            </div>
            <div class="footer-item e">
                <a href="https://www.twitter.com">
                    <img src="{{ asset('assets/icons/media-icons/twitter.svg') }}" alt="twitter icon">
                </a>

            </div>
        </div>
    </footer> --}}
    <script src="{{ asset('assets/js/general_script.js') }}"></script>
    <script>
        // function preventSubmitByEnter(event)
        // {
        //     if(event.keyCode == 13)
        //     {
        //         event.preventDefault();
        //     }
        // }

        // // querySelectorAll mengaktifkan validasi dari HTML Form.
        // document.querySelectorAll('#shoppingCartForm input').addEventListener('keydown', preventSubmitByEnter);

        document.getElementById('duration').addEventListener("change", (event) => {
            if (event.target.value === "undefined") {
                document.querySelector(".total-item.total p:last-child").innerHTML = "...";
            } else if (event.target.value < 1) {
                window.alert("Duration of rent must be at least one day");
                document.getElementById('duration').value = 1;

                let elementPrice = Array.from(document.getElementsByClassName("product-price"));
                let price = [];
                for (const item of elementPrice) {
                    price.push(parseInt(item.dataset.price));
                }
                // console.log(price);

                let totalPrice = price.reduce((acc, curr) => {
                    return acc + curr
                }, 0);

                totalPrice = (totalPrice).toString();

                if (totalPrice.length > 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted];

                    totalPriceFormatted.splice(-3, 0, ",");
                    totalPriceFormatted.splice(-7, 0, ",");

                    totalPriceFormatted = totalPriceFormatted.join("");
                } else if (totalPrice.length <= 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted];
                    totalPriceFormatted.splice(-3, 0, ",");
                    totalPriceFormatted = totalPriceFormatted.join("");
                }
                document.querySelector(".total-item.total p:last-child").innerHTML = totalPriceFormatted;
            }else if (event.target.value > 30) {
                window.alert("Maximum duration of rent = 30 days");
                document.getElementById('duration').value = 30;

                let elementPrice = Array.from(document.getElementsByClassName("product-price"));
                let price = [];
                for (const item of elementPrice) {
                    price.push(parseInt(item.dataset.price));
                }
                // console.log(price);

                let totalPrice = price.reduce((acc, curr) => {
                    return acc + curr
                }, 0);

                totalPrice = (totalPrice * 30).toString();

                if (totalPrice.length > 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted];

                    totalPriceFormatted.splice(-3, 0, ",");
                    totalPriceFormatted.splice(-7, 0, ",");

                    totalPriceFormatted = totalPriceFormatted.join("");
                } else if (totalPrice.length <= 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted];
                    totalPriceFormatted.splice(-3, 0, ",");
                    totalPriceFormatted = totalPriceFormatted.join("");
                }
                document.querySelector(".total-item.total p:last-child").innerHTML = totalPriceFormatted;
            }
             else if (event.target.value >= 1) {
                let elementPrice = Array.from(document.getElementsByClassName("product-price"));
                let price = [];
                for (const item of elementPrice) {
                    price.push(parseInt(item.dataset.price));
                }
                // console.log(price);

                let totalPrice = price.reduce((acc, curr) => {
                    return acc + curr
                }, 0);
                totalPrice = (totalPrice * event.target.value).toString();

                if (totalPrice.length > 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted];

                    totalPriceFormatted.splice(-3, 0, ",");
                    totalPriceFormatted.splice(-7, 0, ",");

                    totalPriceFormatted = totalPriceFormatted.join("");
                } else if (totalPrice.length <= 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted];
                    totalPriceFormatted.splice(-3, 0, ",");
                    totalPriceFormatted = totalPriceFormatted.join("");
                }
                document.querySelector(".total-item.total p:last-child").innerHTML = totalPriceFormatted;
            }
        });
    </script>
</body>

</html>