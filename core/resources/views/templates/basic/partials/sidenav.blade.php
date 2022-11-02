<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage($activeTemplateTrue . 'master/images/sidebar/2.jpg','400x800')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('user.home')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('user.home')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">

            @auth
                <ul class="sidebar__menu">
                    <li class="sidebar-menu-item {{menuActive('user.home')}}">
                        <a href="{{route('user.home')}}" class="nav-link ">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">@lang('Dashboard')</span>
                        </a>
                    </li>


                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('user.news*',3)}}">
                            <i class="menu-icon la la-newspaper"></i>
                            <span class="menu-title">@lang('News') </span>
                        </a>
                        <div class="sidebar-submenu {{menuActive('user.news*',2)}} ">
                            <ul>
                                <li class="sidebar-menu-item {{menuActive(['user.news.index'])}}">
                                    <a href="{{route('user.news.index')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('All News')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{menuActive('user.news.pending')}}">
                                    <a href="{{route('user.news.pending')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Pending News')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{menuActive('user.news.approved')}}">
                                    <a href="{{route('user.news.approved')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Approved News')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{menuActive('user.news.rejected')}}">
                                    <a href="{{route('user.news.rejected')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Rejected News')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive(['user.change.password', 'user.profile.setting', 'user.twofactor'],3)}}">
                            <i class="menu-icon la la-user-circle"></i>
                            <span class="menu-title">@lang('Profile') </span>
                        </a>
                        <div class="sidebar-submenu {{menuActive(['user.change.password', 'user.profile.setting', 'user.twofactor'],2)}} ">
                            <ul>
                                <li class="sidebar-menu-item {{menuActive('user.change.password')}}">
                                    <a href="{{route('user.change.password')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Change Password')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{menuActive('user.profile.setting')}}">
                                    <a href="{{route('user.profile.setting')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Profile Setting')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item {{menuActive('user.twofactor')}}">
                                    <a href="{{route('user.twofactor')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('2FA Security')</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item">
                                    <a href="{{route('user.logout')}}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">@lang('Logout')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</div>
<!-- sidebar end -->
