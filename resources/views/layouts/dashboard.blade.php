@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/font/flaticon.css">

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

        table > thead > tr > th {
            border-bottom: none !important;
            border-top: none !important;
        }

        table > tbody > tr > td {
            vertical-align: middle !important;
        }

        .dataTables_filter > label {
            display: flex;
            align-items: center;
        }

        .dataTables_filter > label > input {
            margin-left: 20px;
        }

        .m-badge.m-badge--info {
            background: linear-gradient(135deg, #36a3f7 30%, #00c5dc 100%);
            color: #ffffff;
        }

        @media only screen and (max-width: 700px) {
            /* For mobile phones: */
            .buttons-print {
                display: none;
            }
        }

        @media only screen and (max-width: 600px) {
            /* For mobile phones: */
            .buttons-reload {
                display: none;
            }
        }

        @media only screen and (max-width: 500px) {
            /* For mobile phones: */
            .buttons-reset {
                display: none;
            }

            .m-body .m-content {
                padding: 10px 10px;
            }
        }

        @media only screen and (max-width: 400px) {
            .buttons-page-length {
                display: none;
            }
        }

        @media only screen and (max-width: 300px) {
            .buttons-export {
                display: none;
            }
        }

        .dt-buttons {
            margin-bottom: 0px;
        }

        .dataTables_processing {
            border: none;
            background: transparent;
            z-index: 999999;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child:before,
        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child:before {
            top: calc(50% - 7px);
        }

        .swal2-confirm {
            margin-right: 10px;
        }

        .menu-icon-svg{
            fill: #b0aecc;
            width: 30px;
            height: 30px;
        }
        .m-menu__item:hover .menu-icon-svg{
            fill: #22b9ff;
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
                                <a href="{{route('dashboard')}}" style="transform: rotate(180deg)"
                                   class="m-brand__logo-wrapper">
                                    <img alt="" src="/assets/media/logo.png"/>
                                </a>
                                <h3 class="m-header__title">
                                    WiliPay Admin
                                </h3>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                                   class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>
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
                            <i class="fa fa-close"></i>
                        </button>
                        <!-- END: Horizontal Menu -->
                        <!-- BEGIN: Topbar -->
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-light"
                                 id="m_quicksearch" m-quicksearch-mode="default">
                                <!--BEGIN: Search Form -->
                                <form class="m-header-search__form">
                                    <div class="m-header-search__wrapper">
                                    <span class="m-header-search__icon-search" id="m_quicksearch_search">
                                        <i class="flaticon-search"></i>
                                    </span>
                                        <span class="m-header-search__input-wrapper">
                                            <input autocomplete="off" type="text" name="q"
                                                   class="m-header-search__input" value=""
                                                   placeholder="Search..." id="m_quicksearch_input">
                                        </span>
                                        <span class="m-header-search__icon-close" id="m_quicksearch_close">
                                            <i class="fa fa-remove"></i>
                                        </span>
                                        <span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
                                            <i class="fa fa-remove"></i>
                                        </span>
                                    </div>
                                </form>
                                <!--END: Search Form -->
                                <!--BEGIN: Search Results -->
                                <div class="m-dropdown__wrapper">
                                    <div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__scrollable m-scrollable mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar"
                                                 data-scrollable="true" data-max-height="300"
                                                 data-mobile-max-height="200"
                                                 style="max-height: 300px; height: 300px; position: relative; overflow: visible;">
                                                <div id="mCSB_1"
                                                     class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside"
                                                     style="max-height: 300px;" tabindex="0">
                                                    <div id="mCSB_1_container"
                                                         class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y"
                                                         style="position:relative; top:0; left:0;" dir="ltr">
                                                        <div class="m-dropdown__content m-list-search m-list-search--skin-light">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="mCSB_1_scrollbar_vertical"
                                                     class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical"
                                                     style="display: none;">
                                                    <div class="mCSB_draggerContainer">
                                                        <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                                                             style="position: absolute; min-height: 50px; top: 0px;">
                                                            <div class="mCSB_dragger_bar"
                                                                 style="line-height: 50px;"></div>
                                                        </div>
                                                        <div class="mCSB_draggerRail"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--BEGIN: END Results -->
                            </div>
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        m-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic m--hide">
													<img src="/assets/app/media/img/users/default_avatar.png"
                                                         class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                                            <span class="m-nav__link-icon m-topbar__usericon">
													<span class="m-nav__link-icon-wrapper"
                                                          style="background: linear-gradient(135deg, #36a3f7 30%, #00c5dc 100%);">
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
                                                            <img width="70" height="70px"
                                                                 src="{{Auth::user()->avatar_url ?  Auth::user()->avatar_url : '/assets/app/media/img/users/default_avatar.png'}}"
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
                                                                <span class="m-nav__section-text">Section</span>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="{{route('profile.edit')}}" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                    <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>

																			</span>
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="{{route('profile.edit')}}" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                                    <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					Activity Log
																				</span>
																					<span class="m-badge m-badge--success">
																						2
																					</span>
																			</span>
																		</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit"></li>
                                                            <li class="m-nav__item">
                                                                <button onclick="document.getElementById('logout-form').submit();"
                                                                        class="btn m-btn--pill m-btn--air         btn-outline-info m-btn m-btn--custom"
                                                                >
                                                                    Logout
                                                                </button>
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
                <i class="fa fa-close"></i>
            </button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
                <!-- BEGIN: Aside Menu -->
                <div id="m_ver_menu"
                     class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "
                     data-menu-vertical="true"
                     m-menu-scrollable="1" m-menu-dropdown-timeout="500"
                >
                    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                        @can('view dashboard')
                            <li class="m-menu__item{{Route::currentRouteName() == 'dashboard' ? ' m-menu__item--active ' : '' }}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                <a href="{{ route('dashboard') }}" class="m-menu__link">
                                    <i class="m-menu__link-icon flaticon-analytics"></i>
                                    <span class="m-menu__link-text">
										Dashboard
									</span>
                                </a>
                            </li>
                        @endcan
                        @can('manage users')
                            <li class="m-menu__item{{in_array(Route::currentRouteName(), ['users.index', 'roles.index', 'permissions.index']) ? ' m-menu__item--active ' : '' }} m-menu__item--submenu"
                                aria-haspopup="true" data-menu-submenu-toggle="hover" data-redirect="true">
                                <a class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-user-settings"></i>
                                    <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">Admin Users</span>
                                    </span>
                                </span>
                                    <i class="m-menu__ver-arrow fa fa-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu ">
                                    <span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true"
                                            data-redirect="true">
											<span class="m-menu__link">
												<span class="m-menu__link-title">
													<span class="m-menu__link-wrap">
														<span class="m-menu__link-text">
															Access Management
														</span>
													</span>
												</span>
											</span>
                                        </li>
                                        <li class="m-menu__item{{Route::currentRouteName() == 'users.index' ? ' m-menu__item--active ' : '' }}"
                                            aria-haspopup="true" data-redirect="true">
                                            <a href="{{route('users.index')}}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
													Users
												</span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item{{Route::currentRouteName() == 'roles.index' ? ' m-menu__item--active ' : '' }}"
                                            aria-haspopup="true" data-redirect="true">

                                            <a href="{{route('roles.index')}}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
													Roles
												</span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item{{Route::currentRouteName() == 'permissions.index' ? ' m-menu__item--active ' : '' }}"
                                            aria-haspopup="true" data-redirect="true">
                                            <a href="{{route('permissions.index')}}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
													Permissions
												</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li class="m-menu__item{{Route::currentRouteName() == 'logs' ? ' m-menu__item--active ' : '' }}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                <a href="{{ route('logs') }}" class="m-menu__link">
                                    @include('svg.list')
                                    <span class="m-menu__link-text">Activity Logs</span>
                                </a>
                            </li>
                        @endcan
                        @if(auth()->user()->can('manage users') || auth()->user()->can('view dashboard'))
                           <li class="m-menu__section">
								<h4 class="m-menu__section-text">
									Customer Management
								</h4>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
							</li>
                        @endif
                        @can('view data')
                            <li class="m-menu__item{{Route::currentRouteName() == 'customers.index' ? ' m-menu__item--active ' : '' }}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                <a href="{{ route('customers.index') }}" class="m-menu__link">
                                    <i class="m-menu__link-icon m-menu__link-icon flaticon-profile"></i>
                                    <span class="m-menu__link-text">Customers</span>
                                </a>
                            </li>
                            <li class="m-menu__item{{Route::currentRouteName() == 'customers.index' ? ' m-menu__item--active ' : '' }}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                <a href="{{ route('customers.index') }}" class="m-menu__link">
                                    @include('svg.credit-card')
                                    <span class="m-menu__link-text">Cards</span>
                                </a>
                            </li>
                            <li class="m-menu__item{{Route::currentRouteName() == 'customers.index' ? ' m-menu__item--active ' : '' }}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                <a href="{{ route('customers.index') }}" class="m-menu__link">
                                    {{--<img src="/assets/media/transaction.svg" alt="">--}}
                                    <i class="m-menu__link-icon m-menu__link-icon flaticon-notes"></i>
                                    <span class="m-menu__link-text">Transactions</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
                <!-- END: Aside Menu -->
            </div>
            <div class="m-content" style="width: 100%; margin-bottom: 20px">
                @if(Session::has('flash_message'))
                    <div class="m-alert m-alert--icon m-alert--outline m-alert--air alert alert-success alert-dismissible fade show"
                         role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-1"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>Well done!</strong> {!! session('flash_message') !!}
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="m-alert m-alert--icon m-alert--outline m-alert--air alert alert-danger alert-dismissible fade show"
                         role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-1"></i>
                        </div>
                        <div class="m-alert__text">
                            <div><strong>Something Goes wrong!</strong></div>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>

                @endif
                @yield('content')
            </div>
        </div>
        <!-- end:: Body -->
        <!-- begin::Footer -->
        <footer class="m-grid__item	m-footer ">
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

<link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">

<script>
  Handlebars.registerHelper('json', function (obj) {
    return new Handlebars.SafeString(JSON.stringify(obj))
  });
  $(document).ready(function () {
    $('li.m-menu__item--submenu').hover(function (e) {
      e.preventDefault();
      $(this).addClass('m-menu__item--hover');
    });
    $('.m_selectpicker').selectpicker();
  });
</script>
@endprepend