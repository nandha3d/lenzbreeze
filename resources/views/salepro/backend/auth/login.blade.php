<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lenz Breeze - Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}" />
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('salepro-assets/vendor/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    
    <!-- Google fonts - Roboto -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" rel="stylesheet"></noscript>

    <style>
        body.login-page {
            background: url("{{ asset('images/bg.jpeg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Nunito', sans-serif;
            position: relative;
        }

        /* Subtle overlay to ensure card pops */
        body.login-page::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.1);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .glass-card {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            color: #fff;
            text-align: center;
        }

        .glass-card .logo {
            margin-bottom: 30px;
        }

        .glass-card .logo img.logo-icon {
            height: 60px;
            margin-bottom: 10px;
            filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.5));
        }

        .glass-card .logo img.logo-text {
            height:30px; /* Larger text size as requested */
            max-width: 100%;
            filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.5));
        }

        .glass-card h2 {
            margin-bottom: 30px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .glass-card .form-group {
            text-align: left;
            margin-bottom: 1.5rem;
            display: block;
            width: 100%;
        }

        .glass-card .form-group label {
            color: #e0e0e0;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
            display: block;
            width: 100%;
        }

        .glass-card .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 10px;
            padding: 12px 15px;
            height: auto;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
        }

        .glass-card .form-control::placeholder {
            color: rgba(255,255,255,0.4);
        }

        .glass-card .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
            color: #fff;
            outline: none;
        }
        
        /* Auto-fill fix for glassmorphism */
        .glass-card .form-control:-webkit-autofill,
        .glass-card .form-control:-webkit-autofill:hover, 
        .glass-card .form-control:-webkit-autofill:focus, 
        .glass-card .form-control:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px rgba(0,0,0,0.5) inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .glass-card .btn-primary {
            background: #008f82; /* Brand teal color */
            border: 1px solid #00a896;
            color: #fff;
            border-radius: 10px;
            font-weight: 700;
            padding: 12px;
            font-size: 16px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            cursor: pointer;
            width: 100%;
        }

        .glass-card .btn-primary:hover {
            background: #007a6e;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 143, 130, 0.4);
            color: #fff;
        }

        .glass-card .forgot-pass, .glass-card .remember-text {
            color: #e0e0e0;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
        }

        .glass-card .forgot-pass:hover {
            color: #fff;
            text-decoration: underline;
        }

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            margin-top: 10px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px; /* space between checkbox and text */
        }
        
        .remember-row input[type="checkbox"] {
            margin: 0;
            cursor: pointer;
            width: 16px;
            height: 16px;
        }

        .remember-row label {
            margin: 0 !important;
            padding: 0;
            color: #e0e0e0;
            font-size: 14px;
            cursor: pointer;
        }

        .copyrights {
            margin-top: 30px;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
        }
        
        .copyrights .external {
            color: rgba(255,255,255,0.9);
            font-weight: bold;
        }
        
        .alert {
            font-size: 14px;
            border-radius: 8px;
        }
    </style>
  </head>
  <body class="login-page">
    <div class="container d-flex justify-content-center">
      <div class="glass-card">
        <div class="logo">
            <img src="{{ asset('images/logo-icon.png') }}" alt="Lenz Breeze Icon" class="logo-icon">
            <br>
            <img src="{{ asset('images/logo-text.png') }}" alt="Lenz Breeze Text" class="logo-text">
        </div>
        
        @if(session()->has('delete_message'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div>
        @endif
        @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
        @endif
        @if(session()->has('not_permitted'))
          <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger text-center alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('error')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger text-center alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{$errors->first()}}
        </div>
        @endif

        <form method="POST" action="{{ route('salepro.login.submit') }}" id="login-form" class="text-left">
          @csrf
          <div class="form-group mb-4">
            <label for="login-username">{{trans('file.UserName') ?? 'Username'}}</label>
            <input id="login-username" type="text" name="name" required class="form-control" placeholder="Enter username" value="">
          </div>

          <div class="form-group mb-4">
            <label for="login-password">{{trans('file.Password') ?? 'Password'}}</label>
            <input id="login-password" type="password" name="password" required class="form-control" placeholder="Enter password" value="">
          </div>
          
          <div class="options-row">
            <div class="remember-row">
                <input type="checkbox" id="rememberMe" name="remember">
                <label class="remember-text" for="rememberMe">{{trans('file.Remember Me') ?? 'Remember Me'}}</label>
            </div>
            <!-- Provide correct route for forgot password, fallback to '#' if not existing -->
            <a href="{{ Route::has('password.request') ? route('password.request') : '#' }}" class="forgot-pass">{{trans('file.Forgot Password?') ?? 'Forgot Password?'}}</a>
          </div>

          <button type="submit" class="btn btn-primary btn-block">{{trans('file.LogIn') ?? 'LOGIN'}}</button>
        </form>
        

      </div>
    </div>
    
    <script type="text/javascript" src="{{ asset('salepro-assets/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('salepro-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Switch theme code stub if previously needed
        var theme = "<?php echo isset($theme) ? $theme : ''; ?>";
        if(theme == 'dark') {
            $('body').addClass('dark-mode');
        }

        if ('serviceWorker' in navigator ) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/salepro/service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
  </body>
</html>
