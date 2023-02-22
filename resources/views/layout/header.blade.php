<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/headerfile.css') }}">
<style>
    .sticky {
        /* position: fixed; */
        top: 0;
        width: 100%;
        height: 50px;
        background-color: #d6d2d2;
    }

    .c {
        color: black;
        font-weight: bold;
    }

    .c:hover {
        background-color: white;
        font-weight: bold;
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
        
    }
</style>
<div id="myHeader" style="margin-left: 50px;" class="main-header__container">
    <h1 class="visually-hidden">{{ __('AuctionNow') }}</h1>
    <a href="/" class="main-header__logo">
        <h2 class="logo">{{ __('AuctionNow') }}</h2>

        <ul class="a">
            <li class="ab"><a class="c" href="/">{{ __('Home') }}</a></li>
            <li class="ab"><a class="c" href="/lots">{{ __('Auctions') }}</a></li>
            <li class="ab"><a class="c" href="/my-bids">{{ __('My Bid') }}</a></li>
            <li class="ab"><a class="c" href="/my-lots">{{ __('My Auction') }}</a></li>
        </ul>
        {{--  --}}
        <form class="main-header__search" method="post" action="/search">
            @csrf
            <input type="search" name="search" placeholder="{{ __('search') }}">
            <input class="main-header__search-btn" type="submit" name="find">
        </form>

        @if ($user = Auth::user())
            <a class="add-lot button" href="/add-lot">{{ __('Add an auction') }}</a>
            <nav class="user-menu">
                <div class="user-menu__image">
                    <img src="{{ !empty($user->avatar) ? '/storage/' . $user->avatar : 'storage/avatar/logo.png' }}"
                        width="50" height="50" alt="{{ $user->name }}">
                </div>
                <p style="margin-top: 10px; margin-left: 7px; margin-right: 10px; color: black;  font-weight: bold;">
                    {{ Auth::user()->name }} </p>
                <div class="dropdown">
                    <button class="dropbtn" style="  font-weight: bold;">{{ __('Language') }}</button>
                    <div class="dropdown-content">
                        <a href="{{ URL::current() }}?lang=en">English</a>
                        <a class="disabled" href="#">العربية</a>
                    </div>
                </div>
                <a class="logout" style="margin-right: 10px; color: black;  font-weight: bold; "
                    href="/logout">{{ __('Logout') }}</a>
            @else
                <ul class="user-menu__list">
                    <li class="user-menu__item">
                        <a style="color: black" href="/register">{{ __('Register') }}</a>
                    </li>
                    <li class="user-menu__item">
                        <a style="color: black" href="/login">{{ __('Login') }}</a>
                    </li>
                </ul>
                <div class="dropdown" style="margin-left: 30px; margin-right: 20px;  font-weight: bold;">
                    <button class="dropbtn">{{ __('Language') }}</button>
                    <div class="dropdown-content">
                        <a href="{{ URL::current() }}?lang=en">English</a>
                        <a class="disabled" href="#">العربية</a>
                    </div>
                </div>

            </nav>
        @endif
</div>
<script>
    window.onscroll = function() {
        myFunction()
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
