<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Login</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('site/img/core-img/light _ico.png') }}">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
</head>
<body>
<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
    </div>
</div>
<!-- Login Wrapper Area-->
<div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <!-- Background Shape-->
    <div class="background-shape"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="{{ asset('site/img/core-img/logo-white.png') }}" alt="">
                <!-- Register Form-->
                <div class="register-form mt-5 px-4">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @if (Session::has('error'))
                            <p style="color: red"><strong>{{ Session::get('error') }}</strong></p>
                        @endif
                        <div class="form-group text-left mb-4"><span>Full Name</span>
                            <label for="username"><i class="lni lni-user"></i></label>
                            <input class="form-control" id="email" type="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group text-left mb-4"><span>Password</span>
                            <label for="password"><i class="lni lni-lock"></i></label>
                            <input class="form-control" id="password" type="password" placeholder="Enter password" name="password">
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100">Login</button>
                    </form>
                </div>
                <!-- Login Meta-->
                <div class="login-meta-data">
                    <a class="forgot-password d-block mt-3 mb-1" href="forget-password.html"></a>
                    <p class="mb-0">Didn't have an account?<a class="ml-1" href="{{route('register')}}">Register Now</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- All JavaScript Files-->
<script src="{{ asset('site/js/jquery.min.js') }}"></script>
<script src="{{ asset('site/js/popper.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/waypoints.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.animatedheadline.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('site/js/wow.min.js') }}"></script>
<script src="{{ asset('site/js/jarallax.min.js') }}"></script>
<script src="{{ asset('site/js/jarallax-video.min.js') }}"></script>
<script src="{{ asset('site/js/default/jquery.passwordstrength.js') }}"></script>
<script src="{{ asset('site/js/default/dark-mode-switch.js') }}"></script>
<script src="{{ asset('site/js/default/active.js') }}"></script>
</body>
</html>
