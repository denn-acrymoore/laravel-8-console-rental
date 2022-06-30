<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <h2>Sign up!</h2>
            </div>
            <div class="flex-item form">
                <form action="#" method="">
                    <!-- nama, alamat, nomor telepon, email, password -->
                    <div class="name-section">
                        <input type="text" name="fullName" autocomplete="off" placeholder=" " required />
                        <label for="fullName" class="label-name">
                            <span class="content-name">Full name</span>
                        </label>
                    </div>

                    <div class="name-section">
                        <input type="text" name="address" autocomplete="off" placeholder=" " required />
                        <label for="address" class="label-name">
                            <span class="content-name">Address</span>
                        </label>
                    </div>

                    <div class="name-section">
                        <input type="text" name="phoneNumber" autocomplete="off" placeholder=" " required />
                        <label for="phoneNumber" class="label-name">
                            <span class="content-name">Phone number</span>
                        </label>
                    </div>

                    <div class="name-section">
                        <input type="email" name="email" autocomplete="off" placeholder=" " required />
                        <label for="email" class="label-name">
                            <span class="content-name">email</span>
                        </label>
                    </div>

                    <div class="name-section">
                        <input type="password" name="password" placeholder=" " required />
                        <label for="password" class="label-name">
                            <span class="content-name">password</span>
                        </label>
                    </div>

                    <input class="customBtn" type="submit" value="sign up">
                    <span class="link-span"><a href="/v_login.html" class="link">Already have an
                            account? Click here</a></span>
                </form>
            </div>

        </div>
    </main>
</body>

</html>