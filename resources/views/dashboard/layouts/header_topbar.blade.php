<div class="kt-header__topbar">
    <!--begin: Notifications -->
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
            <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                        <path
                            d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                            id="Combined-Shape" fill="#000000" opacity="0.3"/>
                        <path
                            d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                            id="Combined-Shape" fill="#000000"/>
                    </g>
                </svg>
                <span class="kt-pulse__ring"></span>
            </span>
            <!--
Use dot badge instead of animated pulse effect:
<span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span-->
        </div>
        <div
            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
            <form>
                <!--begin: Head -->
                <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b"
                     style="background-image: url({{asset('media/misc/bg-1.jpg')}})">
                    <h3 class="kt-head__title">
                        Notifikasi
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">1 Baru</span>
                    </h3>
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications"
                               role="tab" aria-selected="true">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab"
                               aria-selected="false">Ulang Tahun</a>
                        </li>
                    </ul>
                </div>

                <!--end: Head -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true"
                             data-height="300" data-mobile-height="200">

                            <a href="javascript:"
                               class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <i class="flaticon-coins kt-font-success"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        Notif Name
                                    </div>
                                    <div class="kt-notification__item-time">
                                        Time
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true"
                             data-height="300" data-mobile-height="200">

                            <a href="javascript:"
                               class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <i class="flaticon-gift kt-font-warning"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        Nama
                                    </div>
                                    <div class="kt-notification__item-time">
                                        Time
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                        <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                            <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                    All caught up!
                                    <br>No new notifications.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--end: Notifications -->
    <!--begin: Quick Actions -->
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
            <span class="kt-header__topbar-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                        <rect id="Rectangle-62-Copy" fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                              rx="1.5"/>
                        <rect id="Rectangle-62-Copy-2" fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                        <rect id="Rectangle-62-Copy-4" fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                        <rect id="Rectangle-62-Copy-3" fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                    </g>
                </svg>
            </span>
        </div>
        <div
            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
            <form>
                <!--begin: Head -->
                <div class="kt-head kt-head--skin-dark"
                     style="background-image: url({{asset('media/misc/bg-1.jpg')}})">
                    <h3 class="kt-head__title">
                        Quick Actions
                        <span class="kt-space-15"></span>
                        {{--                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 tasks pending</span>--}}
                    </h3>
                </div>
                <!--end: Head -->

                <!--begin: Grid Nav -->
                <div class="kt-grid-nav kt-grid-nav--skin-light">
                    <div class="kt-grid-nav__row">
                        <a href="#" class="kt-grid-nav__item">
                            <span class="kt-grid-nav__icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="Rectangle-10" x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z"
                                            id="Path-3" fill="#000000"/>
                                        <path
                                            d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z"
                                            id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="kt-grid-nav__title">Action 1</span>
                            <span class="kt-grid-nav__desc">Detail Action 1</span>
                        </a>
                        <a href="#" class="kt-grid-nav__item">
                            <span class="kt-grid-nav__icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                        <path
                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path
                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            id="Combined-Shape" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="kt-grid-nav__title">Action 2</span>
                            <span class="kt-grid-nav__desc">Detail Action 2</span>
                        </a>
                    </div>
                    <div class="kt-grid-nav__row">
                        <a href="#" class="kt-grid-nav__item">
                            <span class="kt-grid-nav__icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                            id="Combined-Shape" fill="#000000"/>
                                        <path
                                            d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                            id="Path" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="kt-grid-nav__title">Action 3</span>
                            <span class="kt-grid-nav__desc">Detail Action 3</span>
                        </a>
                        <a href="#" class="kt-grid-nav__item">
                            <span class="kt-grid-nav__icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                     class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                        <path
                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path
                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            id="Combined-Shape" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="kt-grid-nav__title">Action 4</span>
                            <span class="kt-grid-nav__desc">Detail Action 4</span>
                        </a>
                    </div>
                </div>

                <!--end: Grid Nav -->
            </form>
        </div>
    </div>

    <!--end: Quick Actions -->

    <!--begin: User Bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
            <div class="kt-header__topbar-user">
                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                <span class="kt-header__topbar-username kt-hidden-mobile">{{Auth::user()->name}}</span>
                @if(Auth::user()->avatar)
                    <img
                        class="{{Auth::user()->avatar_url ? Auth::user()->avatar_url : asset('media/users/100_1.jpg')}} ? '' : 'kt-hidden'}}"
                        alt="{{ Auth::user()->name }}"
                        src="{{Auth::user()->avatar_url ? Auth::user()->avatar_url : asset('media/users/100_1.jpg')}}"/>
                @endif

                @if(Auth::user()->avatar === null)
                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{substr(Auth::user()->name,0,1)}}</span>
                @endif
            </div>
        </div>
        <div
            class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
            <!--begin: Head -->
            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                 style="background-image: url({{asset('media/misc/bg-1.jpg')}}">
                <div class="kt-user-card__avatar">
                    @if(Auth::user()->avatar)
                        <img
                            class="{{Auth::user()->avatar_url ? Auth::user()->avatar_url : asset('media/users/100_1.jpg')}} ? '' : 'kt-hidden'}}"
                            alt="{{ Auth::user()->name }}"
                            src="{{Auth::user()->avatar_url ? Auth::user()->avatar_url : asset('media/users/100_1.jpg')}}"/>
                    @endif

                    @if(Auth::user()->avatar === null)
                        <span
                            class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{substr(Auth::user()->name,0,1)}}</span>
                    @endif
                </div>
                <div class="kt-user-card__name">
                    {{Auth::user()->name}}
                </div>
            </div>
            <!--end: Head -->

            <!--begin: Navigation -->
            <div class="kt-notification">
                <a href="{{route('personal-information')}}" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                            My Profile
                        </div>
                        <div class="kt-notification__item-time">
                            Account settings and more
                        </div>
                    </div>
                </a>
                <div class="kt-notification__custom kt-space-between">
                    <a href="javascript:void(0)" onclick="logout()"
                       class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                    <form action="{{ Route('logout') }}" method="POST" style="display:none;" id="logout-form">
                        @csrf
                    </form>
                </div>
            </div>
            <!--end: Navigation -->
        </div>
    </div>
    <!--end: User Bar -->
</div>
