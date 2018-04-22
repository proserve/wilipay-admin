@extends('layouts.app')

@section('body')
    <div class="container" style="display: flex;justify-content: center">
        <div class="m-portlet col-sm-6">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="fa fa-gear"></i>
												</span>
                        <h3 class="m-portlet__head-text text-center">Reset Password</h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="m-portlet__body">

                    <div class="panel panel-default">

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label" placeholder="Email">E-Mail Address</label>

                                <div>
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
                        </button>

                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

            </div>
        </div>
    </div>
@endsection
