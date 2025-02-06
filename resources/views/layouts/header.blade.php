<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        <li><a href="{{ url('/designer') }}">Designer</a></li>

                        <div class="dropdown02"> <span class="dropbtn02">Category</span>
                            <div class="drop-content02">
                                <div class="drop-content02">
                                    @foreach ($categories as $category)
                                        <a
                                            href="{{ route('category.show', ['categoryID' => $category->categoryID]) }}">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </ul>
                </nav>
            </div>
            <div class="header-icon">
                <div class="header-cart">
                    <a href="./cart"><i class="ri-shopping-cart-2-line"></i></a>
                </div>
                <div class="header-bell">
                    <i class="ri-notification-4-line"></i>
                </div>
                <div class="header-login">
                    @if (Auth::check())
                        <div class="welcome-container">
                            <span class="welcome-text">Welcome {{ Auth::user()->fullname }}</span>

                            <a href="#" onclick="event.preventDefault(); openLogoutModal();">
                                <i class="ri-logout-box-line"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"><i class="ri-login-box-line"></i></a>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <div class="content">
        @if (Route::currentRouteName() === 'index')
            <div class="header-image">
                BuckiDecor is a comprehensive home interior design Web application that offers a wide range of
                features
                to cater to both homeowners and professional interior designers ....
            </div>
        @endif
    </div>

    <!-- Modal logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Logout Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="submitLogout()">Yes</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        @parent
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            //JavaScript API mở modal
            function openLogoutModal() {
                const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
                logoutModal.show();
            }
            //"Yes"
            function submitLogout() {
                document.getElementById('logout-form').submit();
            }
        </script>
    @endsection
</header>
