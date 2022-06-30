<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmore | Order History</title>
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
                <li><a href="{{ route('shoppingCart') }}" class="navButton customBtn orderbtn">My Orders</a></li>
                <li><a href="{{ route('home') }}" class="navButton customBtn homeBtn">Home</a></li>
            </ul>
        </nav>

        <aside class="sideBar" id="Sidebar">
            <div class="closeIcon" onclick="closeNav()">
                <img src="{{ asset('assets/icons/x.svg') }}" alt="close menu icon" />
            </div>
            <div class="sidebarMenu">
                <a href="{{ route('shoppingCart') }}" class="sidebarButton customBtn">My Orders</a>
                <a href="{{ route('home') }}" class="sidebarButton customBtn">Home</a>
            </div>
        </aside>
    </header>
    <main>
        <div class="cart-header">
            <h1>Order History</h1>
        </div>

        @php
            $userOrderCount = 0;
            $currUserID = session('user_id');
        @endphp
        @foreach ($orderdetails as $od)
            @if ($od->user_id == $currUserID)

                @php
                    $userOrderCount++;
                    $consoleIDs = [];
                    foreach($orders as $o)
                    {
                        if($o->order_id == $od->order_id)
                        {
                            array_push($consoleIDs, $o->console_id);
                        }
                    }
                @endphp
                <div class="cart-container">
                    @foreach($consoles as $c)
                        @if (in_array($c->id, $consoleIDs))
                            <div class="cart-item">
                                <div class="grid-item image">
                                    <img src="{{ asset('console_images/' . $c->picture) }}" alt="" class="grid-item">
                                </div>
                                <div class="grid-item product-name">
                                    <p>{{ $c->name }}</p>
                                </div>
                                <div class="grid-item product-price">
                                    <p>
                                        @php
                                            echo 'Rp ' . number_format($c->price_per_day) . ' / day'; 
                                        @endphp  
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <!-- INI KALO BELOM ADA ORDER -->

                    {{-- <h2 class="empty-cart">No history yet!</h2> --}}
                </div>

                <div class="cart-total">
                    <div class="total-item status">
                        @if ($od->status == '(1) en route')
                            <p style="color: red;">En Route</p>
                        @endif

                        @if ($od->status == '(2) delivered')
                            <p style="color: rgb(38, 71, 189);">Delivered</p>
                        @endif

                        @if ($od->status == '(3) ready to pick up')
                            <p style="color: rgb(255, 164, 45);">Ready to Pick Up</p>
                        @endif

                        @if ($od->status == '(4) done')
                            <p style="color: rgb(23, 208, 29);">Done</p>
                        @endif
                    </div>
                    <div class="total-item duration">
                        <p>
                            @php
                                if($od->duration_day <= 1)
                                {
                                    echo "Rent Duration: " . $od->duration_day . " day";
                                }
                                else if($od->duration_day > 1)
                                {
                                    echo "Rent Duration: " . $od->duration_day . " days";
                                }
                            @endphp
                        </p>
                    </div>
                    <div class="total-item total">
                        <P>Total</P>
                        <p>
                            @php
                                echo 'Rp ' . number_format($od->total_price_per_day * $od->duration_day); 
                            @endphp  
                        </p>
                    </div>
                    <div class="total-item button">
                        @if ($od->status == '(2) delivered')
                            <form action="/ready-to-pick-up" method="POST">
                                @csrf

                                <input type="hidden" name="order_id" value="{{ $od->order_id }}">
                                <input class="confirmBtn ready" type="submit" value="Ready to Pick Up">
                            </form>
                        @endif
                        
                        {{-- <input class="confirmBtn done" type="submit" value="Done"> --}}
                        {{-- <input class="confirmBtn deliv" type="submit" value="deliv"> --}}
                        {{-- <input class="confirmBtn route" type="submit" value="en route"> --}}
                        {{-- <input class="confirmBtn" id="confirmBtn" type="submit" value="Confirm Order"> --}}
                    </div>
                </div>

            @endif
        @endforeach

        @if ($userOrderCount == 0)
            <div class="cart-container">
                <!-- INI KALO BELOM ADA ORDER -->

                <h2 class="empty-cart">No history yet!</h2>
            </div>
        @endif
    </main>
    {{-- <footer id="footer-orders">
        <div class="footer-container">
            <div class="footer-item a">
                <p>copyright &#169; 2021 by Kelompok 7-IF430_A</p>
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
    </footer> --}}
    <script src="{{ asset('assets/js/general_script.js') }}"></script>
</body>

</html>