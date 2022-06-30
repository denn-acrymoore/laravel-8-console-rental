<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playmore | Register Page</title>
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
                <h2>Sign up!</h2>
            </div>
            <div class="flex-item form">
                <form action="/register/submit" method="post">
                    @csrf

                    <!-- email, alamat, nomor telepon, password, confirm password -->
                    <div class="name-section">
                        <input type="email" name="email" autocomplete="off" placeholder=" " value="{{ old('email') }}"/>
                        <label for="email" class="label-name">
                            <span class="content-name">Email</span>
                        </label>
                    </div>
                    <!-- INI TEXT ERRORNYA -->
                    @if ($errors->has('email'))
                        <span class="error-text">
                            @error('email')
                                {{ '*' . $message }}    
                            @enderror
                        </span>
                    @endif
                    @if (session('failed'))
                        <span class="error-text">
                            {{ '*' . session('failed') }}    
                        </span>
                    @endif
                                        

                    <div class="name-section">
                        <input type="text" name="address" autocomplete="off" placeholder=" " value="{{ old('address') }}"/>
                        <label for="address" class="label-name">
                            <span class="content-name">Address</span>
                        </label>
                    </div>
                    <!-- INI TEXT ERRORNYA -->
                    @if ($errors->has('address'))
                        <span class="error-text">
                            @error('address')
                                {{ '*' . $message }}    
                            @enderror
                        </span>
                    @endif


                    <div class="name-section">
                        <input type="text" name="phone_number" autocomplete="off" placeholder=" " value="{{ old('phone_number') }}"/>
                        <label for="phone_number" class="label-name">
                            <span class="content-name">Phone number</span>
                        </label>
                    </div>
                    <!-- INI TEXT ERRORNYA -->
                    @if ($errors->has('phone_number'))
                        <span class="error-text">
                            @error('phone_number')
                                {{ '*' . $message }}    
                            @enderror
                        </span>
                    @endif


                    <div class="name-section">
                        <input type="password" name="input_password" placeholder=" " 
                        value="{{ old('input_password') }}"/>
                        <label for="input_password" class="label-name">
                            <span class="content-name">Password</span>
                        </label>
                    </div>
                    <!-- INI TEXT ERRORNYA -->
                    @if ($errors->has('input_password'))
                        <span class="error-text">
                            @error('input_password')
                                {{ '*' . $message }}    
                            @enderror
                        </span>
                    @endif


                    <div class="name-section">
                        <input type="password" name="confirm_password" placeholder=" " 
                        value="{{ old('confirm_password') }}"/>
                        <label for="confirm_password" class="label-name">
                            <span class="content-name">Confirm Password</span>
                        </label>
                    </div>
                    <!-- INI TEXT ERRORNYA -->
                    @if ($errors->has('confirm_password'))
                        <span class="error-text">
                            @error('confirm_password')
                                {{ '*' . $message }}    
                            @enderror
                        </span>
                    @endif

                    <input class="customBtn" type="submit" value="sign up">
                    <span class="link-span"><a href="/login" class="link">Already have an
                            account? Click here</a></span>
                </form>
            </div>

        </div>
    </main>
</body>

</html>