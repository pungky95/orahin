<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{route('home')}}">
                <img alt="Logo" title="{{config('app.name')}}" src="{{asset('media/logos/logo-mini.png')}}"
                     class="w-100 img-fluid"/>

            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span>
                    <i class="la la-angle-double-left la-2x kt-font-brand kt-font-bold"></i>
                </span>
                <span>
                    <i class="la la-angle-double-right la-2x kt-font-brand kt-font-bold"></i>
                </span>
            </button>
            <!--
               <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
               -->
        </div>
    </div>
    <!-- end:: Aside -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
             data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item @yield('Home')" aria-haspopup="true">
                    <a href="{{route('home')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-tachometer-alt"></i>
                        </span>
                        <span class="kt-menu__link-text">@lang('Home')</span>
                    </a>
                </li>
                @can('read_customer')
                    <li class="kt-menu__item kt-menu__item--submenu kt-menu__item @yield('Customer Management')"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <span class="kt-menu__link-text">@lang('Customer Management')</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span
                                        class="kt-menu__link"><span class="kt-menu__link-text">Actions</span></span>
                                </li>
                                @can('read_customer')
                                    <li class="kt-menu__item @yield('Customer')" aria-haspopup="true">
                                        <a href="{{route('customer.index')}}" class="kt-menu__link ">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <span class="kt-menu__link-text">Customer</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('read_vendor')
                                    <li class="kt-menu__item @yield('Vendor')" aria-haspopup="true">
                                        <a href="{{route('vendor.index')}}" class="kt-menu__link ">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-user-tag"></i>
                                            </span>
                                            <span class="kt-menu__link-text">Vendor</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('read_banner')
                    <li class="kt-menu__item @yield('Banner')" aria-haspopup="true">
                        <a href="{{route('banner.index')}}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-calendar-day"></i>
                            </span>
                            <span class="kt-menu__link-text">@lang('Banner')</span>
                        </a>
                    </li>
                @endcan
                @can('read_order')
                    <li class="kt-menu__item @yield('Order')" aria-haspopup="true">
                        <a href="{{route('order.index')}}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-file-invoice"></i>
                            </span>
                            <span class="kt-menu__link-text">@lang('Order')</span>
                        </a>
                    </li>
                @endcan
                @can('read_company','read_bulletin')
                    <li class="kt-menu__item kt-menu__item--submenu kt-menu__item @yield('Bulletin Management')"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-newspaper"></i>
                            </span>
                            <span class="kt-menu__link-text">Bulletin Management</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span
                                        class="kt-menu__link"><span class="kt-menu__link-text">Actions</span></span>
                                </li>
                                @can('read_company')
                                    <li class="kt-menu__item @yield('Company')" aria-haspopup="true">
                                        <a href="{{route('company.index')}}" class="kt-menu__link ">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <span class="kt-menu__link-text">Company</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('read_bulletin')
                                    <li class="kt-menu__item @yield('Bulletin')" aria-haspopup="true">
                                        <a href="{{route('bulletin.index')}}" class="kt-menu__link ">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-newspaper"></i>
                                            </span>
                                            <span class="kt-menu__link-text">Bulletin</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('read_category','read_subcategory')
                    <li class="kt-menu__item kt-menu__item--submenu kt-menu__item @yield('Category Management')"
                        aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-list"></i>
                            </span>
                            <span class="kt-menu__link-text">Category Management</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span
                                        class="kt-menu__link"><span class="kt-menu__link-text">Actions</span></span>
                                </li>
                                @can('read_category')
                                    <li class="kt-menu__item @yield('Category')" aria-haspopup="true">
                                        <a href="{{route('category.index')}}" class="kt-menu__link ">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-list"></i>
                                            </span>
                                            <span class="kt-menu__link-text">Category</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('read_subcategory')
                                    <li class="kt-menu__item @yield('Subcategory')" aria-haspopup="true">
                                        <a href="{{route('subcategory.index')}}" class="kt-menu__link ">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-list"></i>
                                            </span>
                                            <span class="kt-menu__link-text">Subcategory</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Master Data</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                @role('Super Admin')
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">@lang('Setting')</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item @yield('User')" aria-haspopup="true">
                    <a href="{{route('user.index')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-user-alt"></i>
                        </span>
                        <span class="kt-menu__link-text">@lang('User')</span>
                    </a>
                </li>
                <li class="kt-menu__item @yield('Role')" aria-haspopup="true">
                    <a href="{{route('role.index')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-user-cog"></i>
                        </span>
                        <span class="kt-menu__link-text">@lang('Role')</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
