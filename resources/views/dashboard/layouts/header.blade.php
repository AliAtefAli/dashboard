<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">

                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i>
                            </a>
                        </li>

                    </ul>

{{--                    <ul class="nav navbar-nav bookmark-icons">--}}
{{--                        <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->--}}
{{--                        <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->--}}
{{--                        <!--     i.ficon.feather.icon-menu-->--}}
{{--                        <li class="nav-item d-none d-lg-block">--}}
{{--                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Todo">--}}
{{--                                <i class="ficon feather icon-check-square"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item d-none d-lg-block">--}}
{{--                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Chat">--}}
{{--                                <i class="ficon feather icon-message-square"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item d-none d-lg-block">--}}
{{--                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Email">--}}
{{--                                <i class="ficon feather icon-mail"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item d-none d-lg-block">--}}
{{--                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Calendar">--}}
{{--                                <i class="ficon feather icon-calendar">--}}
{{--                                </i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}

                    <ul class="nav navbar-nav">
                        <li class="nav-item d-none d-lg-block">
{{--                            <a class="nav-link bookmark-star">--}}
{{--                                <i class="ficon feather icon-star warning"></i>--}}
{{--                            </a>--}}

                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon">
                                    <i class="feather icon-search primary"></i>
                                </div>

                                <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="0" data-search="template-list">
                                <ul class="search-list search-list-bookmark"></ul>
                            </div>
                        </li>
                    </ul>
                </div>

                <ul class="nav navbar-nav float-right">
                    <!-- Start Languages -->
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-us"></i>
                            <span class="selected-language">English</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="#" data-language="en">
                                <i class="flag-icon flag-icon-us"></i> English
                            </a>

                            <a class="dropdown-item" href="#" data-language="fr">
                                <i class="flag-icon flag-icon-fr"></i> French
                            </a>

                            <a class="dropdown-item" href="#" data-language="de">
                                <i class="flag-icon flag-icon-de"></i> German
                            </a>

                            <a class="dropdown-item" href="#" data-language="pt">
                                <i class="flag-icon flag-icon-pt"></i> Portuguese
                            </a>

                        </div>
                    </li>
                    <!-- End Languages -->

                    <!-- Start maximize -->
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-expand">
                            <i class="ficon feather icon-maximize"></i>
                        </a>
                    </li>
                    <!-- End maximize -->

                    <!-- Start search -->
                    <li class="nav-item nav-search">
                        <a class="nav-link nav-link-search">
                            <i class="ficon feather icon-search"></i>
                        </a>

                        <div class="search-input">
                            <div class="search-input-icon">
                                <i class="feather icon-search primary"></i>
                            </div>

                            <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="template-list">
                            <div class="search-input-close"><i class="feather icon-x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>
                    <!-- End search -->

                    <!-- Start cart -->
{{--                    <li class="dropdown dropdown-notification nav-item">--}}
{{--                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">--}}
{{--                            <i class="ficon feather icon-shopping-cart"></i>--}}
{{--                            <span class="badge badge-pill badge-primary badge-up cart-item-count">6</span>--}}
{{--                        </a>--}}

{{--                        <ul class="dropdown-menu dropdown-menu-media dropdown-cart dropdown-menu-right">--}}
{{--                            <li class="dropdown-menu-header">--}}
{{--                                <div class="dropdown-header m-0 p-2">--}}
{{--                                    <h3 class="white">--}}
{{--                                        <span class="cart-item-count">6</span>--}}
{{--                                        <span class="mx-50">Items</span>--}}
{{--                                    </h3>--}}
{{--                                    <span class="notification-title">In Your Cart</span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="scrollable-container media-list">--}}
{{--                               <a class="cart-item" href="#">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="media-left d-flex justify-content-center align-items-center">--}}
{{--                                            <img class="mt-1 pl-50" src="{{ asset('assets/dashboard/app-assets/images/pages/eCommerce/canon-camera.jpg') }}" width="70" alt="Cart Item">--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <span class="item-title text-truncate text-bold-500 d-block mb-50">Nikon - D810 DSLR Camera with AF-S NIKKOR 24-120mm f/4G ED VR Zoom Lens - Black</span><span class="item-desc font-small-2 text-truncate d-block"> Shoot arresting photos and 1080p high-definition videos with this Nikon D810 DSLR camera, which features a 36.3-megapixel CMOS sensor and a powerful EXPEED 4 processor for clear, detailed images. The AF-S NIKKOR 24-120mm lens offers shooting versatility. Memory card sold separately.</span>--}}
{{--                                            <div class="d-flex justify-content-between align-items-center mt-1">--}}
{{--                                                <span class="align-middle d-block">1 x $4099.99</span>--}}
{{--                                                <i class="remove-cart-item feather icon-x danger font-medium-1"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a></li>--}}
{{--                            <li class="dropdown-menu-footer">--}}
{{--                                <a class="dropdown-item p-1 text-center text-primary" href="app-ecommerce-checkout.html">--}}
{{--                                    <i class="feather icon-shopping-cart align-middle"></i>--}}
{{--                                    <span class="align-middle text-bold-600">Checkout</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="empty-cart d-none p-2">Your Cart Is Empty.</li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <!-- End cart -->

                    <!-- Start notification -->
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon feather icon-bell"></i>
                            <span class="badge badge-pill badge-primary badge-up">5</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">5 New</h3>
                                    <span class="notification-title">App Notifications</span>
                                </div>
                            </li>

                            <li class="scrollable-container media-list">
                                <a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                        <div class="media-body">
                                            <h6 class="primary media-heading">You have new order!</h6>
                                            <small class="notification-text"> Are your going to meet me tonight?</small>
                                        </div>
                                        <small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time>
                                        </small>
                                    </div>
                                </a>

                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">View all notifications</a></li>
                        </ul>
                    </li>
                    <!-- End notification -->

                    <!-- Start user -->
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name text-bold-600">John Doe</span>
                                <span class="user-status">Available</span>
                            </div>
                            <span>
                                <img class="round" src="{{ asset('assets/dashboard/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">
                                <i class="feather icon-user"></i> Edit Profile
                            </a>

                            <a class="dropdown-item" href="#">
                                <i class="feather icon-mail"></i> My Inbox
                            </a>

                            <a class="dropdown-item" href="#">
                                <i class="feather icon-check-square"></i> Task
                            </a>

                            <a class="dropdown-item" href="#">
                                <i class="feather icon-message-square"></i> Chats
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                تسجيل الخروج
                            </a>
                        </div>
                    </li>
                    <!-- End user -->
                </ul>
            </div>
        </div>
    </div>
</nav>

