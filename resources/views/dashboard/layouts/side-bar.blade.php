<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">

            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('dashboard.home') }}">
                    <div class="brand-logo" style="background : url(@if(isset($setting['logo'])) {{asset( 'assets/uploads/settings/' . $setting['logo'] )}} @else {{ asset('assets/dashboard/app-assets/images/ico/favicon.ico') }} @endif) no-repeat;"></div>
                    <h2 class="brand-text mb-0">@if(isset( $setting[lang() . '_name'] ) ) {{ $setting[lang() . '_name'] }} @else Dashboard @endif</h2>

                </a>
            </li>

            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>

        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if(\Request::route()->getName() == 'dashboard.home') active @endif ">
                <a href="{{ route('dashboard.home') }}"><i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                    <span class="badge badge badge-warning badge-pill float-right mr-2">2</span>
                </a>
            </li>

            <li class=" nav-item @if(\Request::route()->getName() == 'dashboard.users.index') active @endif ">
                <a href="#">
                    <i class="feather icon-user"></i>
                    <span class="menu-title" data-i18n="User">المستخدمين</span>
                </a>
                <ul class="menu-content">

                    <li class="@if(\Request::route()->getName() == 'dashboard.users.all') active @endif">
                        <a href="{{ route('dashboard.users.index') }}">
                            <i class="feather icon-list"></i>
                            <span class="menu-item" data-i18n="List">الكل </span>
                        </a>
                    </li>

                    <li class="@if(\Request::route()->getName() == 'dashboard.users.blocked') active @endif">
                        <a href="#">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="View">المحظورين</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item @if(\Request::route()->getName() == 'dashboard.home') active @endif ">
                <a href="{{ route('dashboard.settings.api') }}"><i class="feather icon-settings"></i>
                    <span class="menu-title" data-i18n="Dashboard">الاعدادات</span>
                    <span class="badge badge badge-warning badge-pill float-right mr-2">2</span>
                </a>
            </li>

            <li class=" nav-item @if(\Request::route()->getName() == 'dashboard.messages.index') active @endif">
                <a href="#">
                    <i class="feather icon-mail"></i>
                    <span class="menu-title" data-i18n="Email">البريد الوارد</span>
                </a>
            </li>

            <li class=" nav-item @if(\Request::route()->getName() == 'dashboard.conversations.index') active @endif">
                <a href="#">
                    <i class="feather icon-message-square"></i>
                    <span class="menu-title" data-i18n="Chat">المحادثات</span>
                </a>
            </li>

            <li class=" nav-item">

                <a href="#">
                    <i class="feather icon-menu"></i>
                    <span class="menu-title" data-i18n="Menu Levels">Menu Levels</span>
                </a>

                <ul class="menu-content">
                    <li>
                        <a href="#">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="Second Level">Second Level</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="Second Level">Second Level</span>
                        </a>

                        <ul class="menu-content">
                            <li>
                                <a href="#">
                                    <i class="feather icon-circle"></i><span class="menu-item" data-i18n="Third Level">Third Level</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="feather icon-circle"></i>
                                    <span class="menu-item" data-i18n="Third Level">Third Level</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
