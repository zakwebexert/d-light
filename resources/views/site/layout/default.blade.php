<!doctype html>

<?php
$setting = \App\Models\Setting::pluck('value','name')->toArray();
$logo = isset($setting['logo']) ? 'uploads/'.$setting['logo'] : 'assets/media/logos/logo-light.png';
$meta_description = isset($setting['meta_desc']) ? $setting['meta_desc'] : 'Pass your learner\'s licence the first time with the most comprehensive learners licence questions in South Africa. There are over 300 FREE different questions to help you practice. You can also renew your vehicle license and all of South Africa’s traffic departments and driving schools.';
$copy_right =  isset($setting['copy_right']) ? $setting['copy_right'] : 'Learnerslicense.co.za';
$google_data_ad_client = isset($setting['google_data-ad-client']) ? $setting['google_data-ad-client'] : 'ca-pub-3602437766446792';
$google_ads_src = isset($setting['google_ads_src']) ? $setting['google_ads_src'] : 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';


?>
<html lang="en">
<head>
    @include('site.partials.head')
</head>
<body>

<header>
    @include('site.partials.header')
</header>

@yield('content')

<footer>
    @include('site.partials.footer')
</footer>

{{--<a id="back-to-top" href="#" class="btn" role="button"><i class="fas fa-chevron-up"></i></a>--}}

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

@yield("scripts");
</body>
</html>
