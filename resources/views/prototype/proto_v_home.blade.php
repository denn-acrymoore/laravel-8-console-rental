<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmore | Home Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home_styling.css') }}">
</head>

<body>
    <header>
        <h1 class="item">
            <a href="#">PLAYMORE</a>
            <div class="navIcon search" onclick="openSearch()">
                <img src="{{ asset('assets/icons/search.svg') }}" alt="open menu icon">
            </div>
            <div class="navIcon" onclick="openNav()">
                <img src="{{ asset('assets/icons/menu.svg') }}" alt="open menu icon">
            </div>
        </h1>

        <nav class="item nav">
            <ul>
                <!-- INI TOMBOL HALAMAN ORDER -->
                <li><a href="/ongoing-orders" class="navButton customBtn orderbtn">My Orders</a></li>

                <!-- TOMBOL LOGIN -->
                <li><a href="/login" class="navButton customBtn logInbtn">Log in</a></li>

                <!-- INI TOMBOL LOGOUT -->
                <!-- <li><a href="/v_login.html" class="navButton customBtn logOutbtn">Log out</a></li> -->
                <!-- INI NAMA USER -->
                <!-- <li style="color: white; margin-right: 75px;"> stefanwork12@gmail.com</li> -->

                <!-- TOMBOL SIGNUP -->
                <li><a href="/register" class="navButton customBtn signUpbtn">Sign up</a></li>
            </ul>
        </nav>

        <aside class="sideBar" id="Sidebar">
            <div class="closeIcon" onclick="closeNav()">
                <img src="{{ asset('assets/icons/x.svg') }}" alt="closemenuicon" />
            </div>
            <div class="sidebarMenu">
                <a href="/ongoing-orders" class="sidebarButton customBtn">Orders</a>
                <a href="/login" class="sidebarButton customBtn logInbtn">Login</a>
                <a href="/register" class="sidebarButton signUpbtn">Sign up</a>
            </div>
        </aside>
    </header>
    <div class="search-container-phn" id="searchPhoneContainer">
        <input type="text" id="consoleSearchPhone" name="consoleSearch" placeholder="Search console..."
        onkeyup = "searchFunction2()">
        <span onclick="closeSearch()">
            <img src="{{ asset('assets/icons/x.svg') }}" alt="close icon">
        </span>
    </div>

    <div class="main-header">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1 / 4</div>
                <img src="{{ asset('assets/slides/slide1.png') }}" alt="slideshow">
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 4</div>
                <img src="{{ asset('assets/slides/slide2.gif') }}" alt="slideshow">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">3 / 4</div>
                <img src="{{ asset('assets/slides/slide3.png') }}" alt="slideshow">
            </div>
            <div class="mySlides fade">
                <div class="numbertext">4 / 4</div>
                <img src="{{ asset('assets/slides/slide4.gif') }}" alt="slideshow">
            </div>
        </div>

        <h1>Find your console!</h1>

        <div class="search-container">
            <input class="search__input" id="consoleSearch" type="text" name="consoleSearch"
                placeholder="Search console..." onkeyup="searchFunction()">
        </div>

    </div>

    <main>
        <div class="card-container">
            @foreach ($consoles as $c)
                <div class="card" id="card">
                    <div class="product header">
                        <h2>{{ $c->name }}</h2>
                    </div>
                    <div class="product img" id="product-img" data-toggle="modal" data-target="#DescModal-{{ $c->id }}">
                        <!-- KASIH ALT NAMA DARI PRODUKNYA YA -->
                        <img src="{{ asset('console_images/' . $c->picture) }}" alt="ps4">
                    </div>
                    <div>
                        {{-- <p>  --}}
                        @php
                           // echo 'Price: Rp ' . number_format($c->price_per_day) . ' / day'; 
                        @endphp
                        {{-- </p> --}}
                        {{-- <p>Stock: {{ $c->qty }}</p> --}}
                    </div>
                    <div class="product btn">
                        <button class="rent-btn" data-toggle="modal" data-target="#RentModal-{{ $c->id }}">RENT</button>
                    </div>
                </div>
            @endforeach
        </div>


        <!-- DESCRIPTION MODAL -->
        @foreach ($consoles as $c)
            <div class="modal" id="DescModal-{{ $c->id }}" style="display:none;" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-item detail-header">
                            <h5 class="col-12 modal-title text-center" id="exampleModalLongTitle">{{ $c->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-item detail-body">
                            <div class="modal-image">
                                <!-- KASIH ALT NAMA DARI PRODUKNYA -->
                                <img src="{{ asset('console_images/' . $c->picture) }}" alt="ps4">
                            </div>
                            <p>
                                Descriptions: 
                            </p>   
                            <br> 
                            @php
                                $descriptions = explode(';', $c->description);
                                foreach($descriptions as $desc)
                                {
                                    echo '<p>';
                                    echo $desc;
                                    echo '</p>';
                                }
                            @endphp
                            

                        </div>
                        <div class="modal-item detail-footer">
                            <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>    
        @endforeach

        <!-- RENT MODAL -->
        @foreach ($consoles as $c)
            <div class="modal" id="RentModal-{{ $c->id }}" style="display:none;" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-item rent-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-item rent-body">
                            <p>
                                {{ $c->name . ' has beed added to your cart!' }}
                            </p>
                        </div>
                        <!-- <div class="modal-item detail-footer">
                            <button type="button" class="modal-btn" data-dismiss="modal">Close</button>
                        </div> -->
                    </div>
                </div>
            </div>    
        @endforeach
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-item a">
                <p>copyright &#169; 2021 by Kelompok 7-IF430_A </p>
            </div>
            <div class="footer-item b">
                <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210/">
                    <img src="{{ asset('assets/icons/media-icons/facebook.svg') }}" alt="facebook icon">
                </a>

            </div>
            <div class="footer-item c">
                <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210/">
                    <img src="{{ asset('assets/icons/media-icons/instagram.svg') }}" alt="instagram icon">
                </a>

            </div>
            <div class="footer-item d">
                <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210/"><img
                        src="{{ asset('assets/icons/media-icons/linkedin.svg') }}" alt="linkedIn icon">
                </a>

            </div>
            <div class="footer-item e">
                <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210/">
                    <img src="{{ asset('assets/icons/media-icons/twitter.svg') }}" alt="twitter icon">
                </a>

            </div>
        </div>
    </footer>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TimelineMax.min.js"
        integrity="sha512-lJDBw/vKlGO8aIZB8/6CY4lV+EMAL3qzViHid6wXjH/uDrqUl+uvfCROHXAEL0T/bgdAQHSuE68vRlcFHUdrUw=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"
        integrity="sha512-8Wy4KH0O+AuzjMm1w5QfZ5j5/y8Q/kcUktK9mPUVaUoBvh3QPUZB822W/vy7ULqri3yR8daH3F58+Y8Z08qzeg=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/home_script.js') }}"></script>
    <script src="{{ asset('assets/js/general_script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script>
        // $(document).ready(() => {
        //     $('#RentModal').modal('show');
        // });

        $('#DescModal').on('shown.bs.modal', function (e) {
            disableScroll();
        });
        $('#DescModal').on('hidden.bs.modal', function (e) {
            enableScroll();
        });

        $('#RentModal').on('shown.bs.modal', function (e) {
            disableScroll();
        });
        $('#RentModal').on('hidden.bs.modal', function (e) {
            enableScroll();
        });

        $('#RentModal').on('shown.bs.modal', function (e) {
            setTimeout(() => {
                $('#RentModal').modal('hide');
            }, 10000);
        });


        const disableScroll = () => {
            document.body.style.overflow = 'hidden';
        };

        const enableScroll = () => {
            document.body.style.overflow = 'auto';
        };
    </script>
</body>

</html>