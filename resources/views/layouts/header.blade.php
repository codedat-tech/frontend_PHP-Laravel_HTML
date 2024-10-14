<header>
    <div class="container1">
        <div class="row-flex">
            <div class="header-logo">
                <img src="{{ url('Asset/Image/LOGO.png') }}" alt="">
            </div>
            <div class="header-nav">
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="{{ url('/interior-design') }}">Interior Design</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="{{ url('/designer') }}">Designer</a></li>
                        <div class="dropdown01">
                            <span class="dropbtn01">Library</span>
                            <div class="drop-content01">
                                <a href="#">Link 1</a>
                                <a href="#">Link 2</a>
                                <a href="#">Link 3</a>
                            </div>
                        </div>
                        <div class="dropdown02">
                            <span class="dropbtn02">Product</span>
                            <div class="drop-content02">
                                <a href="#">Link 1</a>
                                <a href="#">Link 2</a>
                                <a href="#">Link 3</a>
                            </div>
                        </div>
                        <li><a href="{{ url('/review') }}">Review</a></li>

                    </ul>
                </nav>
            </div>
            <div class="header-icon">
                <div class="header-cart">
                    <a href="#"><i class="ri-shopping-cart-2-line"></i></a>
                </div>
                <div class="header-bell">
                    <i class="ri-notification-4-line"></i>
                </div>
                <div class="header-login">
                    @if(Auth::check())
                        <span>Welcome, {{ Auth::user()->full_name }}</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    @else
                        <a href="{{ route('login') }}"><i class="ri-login-box-line"></i> Login</a>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div class="header-image">
                BuckiDecor is a comprehensive home interior design Web application that offers a wide range of features to cater to both homeowners and professional interior designers  ....
            </div>
        </div>
    </div>
</header>
