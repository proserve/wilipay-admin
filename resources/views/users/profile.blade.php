@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="m-portlet col-md-8 col-sm-10">
            <div class="m-portlet__body" style="padding: 0px">
                <form class="m-form" id="user_form" method="post" action="{{route('profile.update')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="PUT">
                    <input type="file" name="avatar" hidden id="avatar_field">
                    <div class="m-portlet__body">

                        <div class="m-form__section m-form__section--last">
                            <div class="form-group m-form__group row" onclick="$('#avatar_field').click()"
                                 style="display: flex;align-items: center; flex-direction: column">
                                <div class="m-card-user__pic">
                                    <img id="avatar_preview"
                                         src='{{auth()->user()->avatar_url ?: "https://image.flaticon.com/icons/png/512/138/138672.png"}}'
                                         class="m--img-rounded m--marginless" width="100px" height="100px"
                                         alt="">
                                </div>
                                Profile Picture
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Full Name:
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control m-input m-input--air" name="name"
                                           placeholder="Enter full name" value="{{ auth()->user()->name }}" required>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Email address:
                                </label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control m-input m-input--air" name="email"
                                           placeholder="Enter email" value="{{ auth()->user()->email }}" required>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Password:
                                </label>
                                <div class="col-lg-9">
                                    <input type="password" id="password" class="form-control m-input m-input--air"
                                           name="password" required placeholder="password">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Password:
                                </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control m-input" name="password_confirmation"
                                           placeholder="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <button type="submit"
                                            class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-success m-btn--gradient-to-accent">
                                        Submit
                                    </button>
                                    <button type="reset"
                                            class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-metal m-btn--gradient-to-metal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('partials.actions_btn')
@endpush