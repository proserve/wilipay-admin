@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/kt-2.3.2/sl-1.2.5/datatables.min.css"/>


    <style>
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.details td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }

        .dataTables_filter {
            float: right;
            display: inline;
        }

        table tfoot {
            display: table-header-group;
        }
    </style>
@endpush
@section('body')
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand  m-brand--skin-light ">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="index.html" style="transform: rotate(180deg)" class="m-brand__logo-wrapper">
                                    <img alt="" src="/assets/media/logo.png"/>
                                </a>
                                <h3 class="m-header__title">
                                    Apps
                                </h3>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                                   class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Responsive Header Menu Toggler -->
                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                                   class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
                                <!-- END -->
                                <!-- BEGIN: Topbar Toggler -->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                                   class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>
                                <!-- BEGIN: Topbar Toggler -->
                            </div>
                        </div>
                    </div>
                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                        <div class="m-header__title">
                            <h3 class="m-header__title-text">
                                {{ $title }}
                            </h3>
                        </div>
                        <!-- BEGIN: Horizontal Menu -->
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light "
                                id="m_aside_header_menu_mobile_close_btn">
                            <i class="la la-close"></i>
                        </button>
                        <!-- END: Horizontal Menu -->
                        <!-- BEGIN: Topbar -->
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        m-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic m--hide">
													<img src="/assets/app/media/img/users/user4.jpg"
                                                         class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                                            <span class="m-nav__link-icon m-topbar__usericon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-user-ok"></i>
													</span>
												</span>
                                            <span class="m-topbar__username m--hide">
													{{Auth::user()->name}}
												</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center">
                                                    <div class="m-card-user m-card-user--skin-light">
                                                        <div class="m-card-user__pic">
                                                            <img src="/assets/app/media/img/users/user4.jpg"
                                                                 class="m--img-rounded m--marginless" alt=""/>
                                                        </div>
                                                        <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{Auth::user()->name}}
																</span>
                                                            <a href=""
                                                               class="m-card-user__email m--font-weight-300 m-link">
                                                                {{Auth::user()->email}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav--skin-light">
                                                            <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit"></li>
                                                            <li class="m-nav__item">

                                                                <a href="javascript:
                                                                        document.getElementById('logout-form').submit();"
                                                                   class="btn m-btn--pill
																	  btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"
                                                                >
                                                                    Logout
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}"
                                                                      method="POST" style="display: none;">
                                                                    {{ csrf_field() }}
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- END: Topbar -->
                    </div>
                </div>
            </div>
        </header>
        <!-- END: Header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
                <i class="la la-close"></i>
            </button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
                <!-- BEGIN: Aside Menu -->
                <div
                        id="m_ver_menu"
                        class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "
                        data-menu-vertical="true"
                        m-menu-scrollable="1" m-menu-dropdown-timeout="500"
                >
                    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                        <li class="m-menu__item{{Route::currentRouteName() == 'home' ? ' m-menu__item--active ' : '' }}"
                            aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                            <a href="{{ route('home') }}" class="m-menu__link">
                                <i class="m-menu__link-icon flaticon-graphic-1"></i>
                            </a>
                        </li>
                        <li class="m-menu__item{{Route::currentRouteName() == 'adminUsers' ? ' m-menu__item--active ' : '' }}"
                            aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                            <a href="{{ route('adminUsers') }}" class="m-menu__link">
                                <i class="m-menu__link-icon m-menu__link-icon flaticon-user"></i>
                                <span class="m-menu__link-text">
										Admin Users
									</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="m-menu__item{{Route::currentRouteName() == 'users' ? ' m-menu__item--active ' : '' }}"
                            aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                            <a href="{{ route('users') }}" class="m-menu__link">
                                <i class="m-menu__link-icon m-menu__link-icon flaticon-users"></i>
                                <span class="m-menu__link-text">
										Users
									</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END: Aside Menu -->
            </div>
            <div class="m-content" style="width: 100%">
                @yield('content')
            </div>
        </div>
        <!-- end:: Body -->
        <!-- begin::Footer -->
        <footer class="m-grid__item		m-footer ">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											About
										</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											Privacy
										</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
										<span class="m-nav__link-text">
											T&C
										</span>
                                </a>
                            </li>
                            <li class="m-nav__item m-nav__item">
                                <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center"
                                   data-placement="left">
                                    <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end::Footer -->
    </div>
    <!-- end:: Page -->
    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="fa fa-long-arrow-up"></i>
    </div>
    </body>
@endsection

@prepend('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/kt-2.3.2/sl-1.2.5/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@endprepend