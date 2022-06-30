<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmore | Login</title>
    <link rel="stylesheet" href="./assets/css/form_styling.css">
</head>

<body>
    <header>
        <h1>
            <a href="/v_home.html">PLAYMORE</a>
        </h1>
    </header>
    <main class="main-section">
        <div class="container">
            <div class="flex-item form-header">
                <h2>Log in!</h2>
            </div>
            <div class="flex-item form">
                <form action="#" method="">
                    <div class="name-section">
                        <input type="text" name="username" autocomplete="off" placeholder=" " required />
                        <label for="username" class="label-name">
                            <span class="content-name">username</span>
                        </label>
                    </div>

                    <div class="name-section">
                        <input type="password" name="password" placeholder=" " required />
                        <label for="password" class="label-name">
                            <span class="content-name">password</span>
                        </label>
                    </div>

                    <input class="customBtn" type="submit" value="Log in">
                    <span class="link-span"><a href="/v_register.html" class="link">Don't have an
                            account? Click here</a></span>
                </form>
            </div>

        </div>
    </main>
</body>

</html>