<?php $language = \App\Classes\Utilities::getLanguage() ?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Dashboard Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/login-favicon.ico') }}"/>
    <!--===============================================================================================-->
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">--}}
<!--===============================================================================================-->
{{--<script src="https://use.fontawesome.com/7a0f596a84.js"></script>--}}
<!--===============================================================================================-->
    @if($language->language_direction == 'rtl')
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600&display=swap" rel="stylesheet">
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
@endif
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/dashboard-login.css') }}">
    <!--===============================================================================================-->
</head>
<body>
<div class="container-login100" style="background-image: url('{{ asset('dashboard-assets/images/login-bg.jpg') }}');">

    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">

        <form method="post" action="{{ route("auth.dashboard.password.reset.submit") }}" class="login100-form validate-form" autocomplete="off">
                    <span class="login100-form-title p-b-37">
                        {{ _e('new_password') }}
                    </span>

            @csrf()

            @if (!empty($errors->all()))
                <div class="txt2-error p-b-10 text-center"><span>{{ $errors->first() }}</span></div>
            @endif
            @if ($msg = session()->get('success'))
                <div class="p-b-10 text-center" style="color: green;"><span>{{ $msg }}</span></div>
            @endif
            <input type="hidden" value="{{ $token }}" name="token">
            <div class="wrap-input100 m-b-20">
                <input required min="3" max="100" class="input100" type="email" value="{{ old('email') }}" name="email" placeholder="{{ _e('email') }}">
            </div>
            <div class="wrap-input100 m-b-25" >
                <input required min="3" max="100" class="input100" type="password" name="password" placeholder="{{ _e('new_password') }}">
            </div>
            <div class="wrap-input100 m-b-25" >
                <input required min="3" max="100" class="input100" type="password" name="password_confirmation" placeholder="{{ _e('confirm_password') }}">
            </div>

            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    {{ _e('send') }}
                </button>
            </div>
        </form>

    </div>

</div>
</body>
</html>
