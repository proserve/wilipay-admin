@extends('layouts.app')

@section('body')
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-login m-login--signin  m-login--5" id="m_login"
             style="background-image: url('assets/app/media/img/bg/bg-3.jpg');">
            <div class="m-login__wrapper-1 m-portlet-full-height">
                <div class="m-login__wrapper-1-1">
                    <div class="m-login__contanier">
                        <div class="m-login__content">
                            <div class="m-login__logo">
                                <a href="#">
                                    <img style="transform: rotate(180deg)"
                                         src="assets/app/media/img/logos/logo-2.png">
                                </a>
                            </div>
                            <div class="m-login__title">
                                <h3>
                                    This is not a public space
                                </h3>
                            </div>
                            <div class="m-login__desc">
                                This space is dedicated for wilipay Stuff
                            </div>
                        </div>
                    </div>
                    <div class="m-login__border">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="m-login__wrapper-2 m-portlet-full-height">
                <div class="m-login__contanier">
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Login To Your Account
                            </h3>
                        </div>
                        <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-danger ' : '' }} m-form__group">
                                <input class="form-control m-input" placeholder="Email" name="email" required
                                       autocomplete="off" id="email" type="email" value="{{ old('email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="Password"
                                       placeholder="Password" name="password" required id="password">
                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="row m-login__form-sub">
                                <div class="col m--align-left">
                                    <label class="m-checkbox m-checkbox--focus">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right">
                                    <a href="{{ route('password.request') }}" class="m-link">
                                        Forget Password ?
                                    </a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit"
                                        class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">
                                Forgotten Password ?
                            </h3>
                            <div class="m-login__desc">
                                Enter your email to reset your password:
                            </div>
                        </div>
                        <form class="m-login__form m-form" action="">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="text" placeholder="Email" name="email"
                                       id="m_email" autocomplete="off">
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_forget_password_submit"
                                        class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                    Request
                                </button>
                                <button id="m_login_forget_password_cancel"
                                        class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom ">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
    <!--begin::Page Snippets -->
    </body>
@endsection

@push('scripts')
        <script src="assets/snippets/custom/pages/user/login.js" type="text/javascript"></script>
@endpush