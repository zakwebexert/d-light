<!-- Preloader-->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
    </div>
</div>
<!-- Header Area-->
<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Logo Wrapper-->
        <div class="logo-wrapper"><a href="{{route('site.home')}}"><img id="xximg" src="{{ asset('site/img/core-img/logo-small.png') }}" alt=""></a></div>
        <!-- Search Form-->
        <div class="top-search-form">
            <form action="{{route('search_item')}}" method="post">
                @csrf
                <input class="form-control" name="name" type="search" placeholder="Enter item name">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
        <div id="xxicons" style="width: 100px;display: flex; flex-direction: row; justify-content: space-between;">
            <div><a style="color: inherit;" href=""><i class="fa fa-facebook-square"></i></a></div>
        <div><a style="color: inherit;" href=""><i class="fa fa-twitter-square"></i></a></div>
        <div><a style="color: inherit;" href=""><i class="fa fa-instagram"></i></a></div>
        <div><a style="color: inherit;" href=""><i class="fa fa-weixin"></i></a></div>
        </div>
    </div>
</div>
<!-- Sidenav Black Overlay-->
<div class="sidenav-black-overlay"></div>
<!-- Side Nav Wrapper-->
<div class="suha-sidenav-wrapper" id="sidenavWrapper">
    <!-- Sidenav Profile-->
    @auth
    <div class="sidenav-profile">
        <div class="user-info">
            <h6 style="margin-top: 20px;" class="user-name mb-0">{{auth()->user()->name}}</h6>
            </div>
    </div>
    <!-- Sidenav Nav-->
    <ul class="sidenav-nav">
        <li><a href="{{route('edit_profile')}}"><i class="lni lni-user"></i>My Profile</a></li>
        <li><a href="{{route('change_password_form')}}"><i class="lni lni-brush-alt"></i>Change Password</a></li>
        <li><a href="{{route('my_wish_list')}}"><i class="lni lni-heart"></i>My Wishlist</a></li>
        <li><a href="{{route('categories')}}"><i class="lni lni-radio-button"></i>Categories</a></li>

        <li>
                <form method="post" action="{{route('logout')}}" style="margin-bottom: 100px; margin-top: 10px;">
                    @csrf
                    <button style="margin-left: 20px;" class="btn btn-secondary" type="submit"><i class="lni lni-power-switch"></i> Sign Out</button>
                </form>
        </li>
        @endauth
    </ul>
    @guest
            <ul class="sidenav-nav">
                <li><a href="{{route('login')}}"><i class="lni lni-user"></i>Login</a></li>
                <li><a href="{{route('categories')}}"><i class="lni lni-radio-button"></i>Categories</a></li>
                </ul>
    @endguest
    <!-- Go Back Button-->
    <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
</div>
<script>
    if(screen.width < 500) {
        document.getElementById('xximg').src = "{{ asset('site/img/core-img/light _ico.png') }}"
        document.getElementById('xxicons').style.display = "none"
    }
    if(screen.width > 500) {
        document.getElementById('xximg').src = "{{ asset('site/img/core-img/logo-small.png') }}"
        document.getElementById('xxicons').style.display = "flex"
    }
</script>
