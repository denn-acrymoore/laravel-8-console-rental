<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmore | Login Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/form_styling.css') }}">
</head>

<body>
    <header>
        <h1>
            <a href="/">PLAYMORE</a>
        </h1>
    </header>
    <main class="main-section">
        <div class="container">
            <div class="flex-item form-header">
                <h2>Log in!</h2>
            </div>
            <!-- ADA PERUBAHAN DI SINI, KALO PASSWORD ATAU USERNAME SALAH -->
            @if (session('failed'))
                <p style="color:red; margin:auto; margin-bottom: 1rem; border: 1px solid red; padding: 5px; ">
                    {{'*' . session('failed') }}
                </p>
            @endif

            @if ($errors->has('email') || $errors->has('input_password'))
                <p style="color:red; margin:auto; margin-bottom: 1rem; border: 1px solid red; padding: 5px; ">
                    *Incorrect username / password
                </p>
            @endif
            
            <div class="flex-item form">
                <form action="/login/submit" method="post">
                    @csrf

                    <div class="name-section">
                        <input type="email" name="email" autocomplete="off" placeholder=" " required />
                        <label for="email" class="label-name">
                            <span class="content-name">Email</span>
                        </label>
                    </div>

                    <div class="name-section">
                        <input type="password" name="input_password" placeholder=" " required />
                        <label for="input_password" class="label-name">
                            <span class="content-name">Password</span>
                        </label>

                    </div>

                    <div class="g-recaptcha" data-sitekey="6Le-Lx0bAAAAACtTEF3Cgk3m0iPNlrLQvl-RP_4O" data-theme="dark">
                    </div>


                    <input class="customBtn" type="submit" value="Log in">
                    <span class="link-span"><a href="/register" class="link">Don't have an
                            account? Click here</a></span>
                </form>
            </div>

        </div>
    </main>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>