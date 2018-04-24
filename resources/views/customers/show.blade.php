@extends('layouts.dashboard')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{$customer->avatar_url ?: '/assets/app/media/img/users/default_avatar.png'}}"
                                         alt=""/>
                                </div>
                            </div>
                            <div class="m-card-profile__details">
												<span class="m-card-profile__name">
													{{ ($customer->profile ? $customer->profile->first_name. ' ' . $customer->profile->last_name : 'empty profile')  }}
												</span>
                                <a href="" class="m-card-profile__email m-link">
                                    {{ $customer->email }}
                                </a>
                                <a href="" class="m-card-profile__email m-link">
                                    {{ $customer->phone }}
                                </a>
                            </div>
                        </div>
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">Member Balance</h3>
                                        <span class="m-widget1__desc">Total for each currency</span>
                                    </div>
                                    <div class="col m--align-right">
                                        @foreach($customer->accounts as $account)
                                            <div class="m-widget1__number m--font-brand">
                                                {{config('currencies')[$account->currency_code]['symbol']}}
                                                {{$account->amount}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Transactions
                                        </h3>
                                        <span class="m-widget1__desc">
															Number of transactions of all type
														</span>
                                    </div>
                                    <div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															{{ $customer->transactions_count }}
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">transactions volume</h3>
                                        <span class="m-widget1__desc">Last week transactions volume</span>
                                    </div>
                                    <div class="col m--align-right">
                                        @foreach($customer->accounts as $account)
                                            <div class="m-widget1__number m--font-success">
                                                {{config('currencies')[$account->currency_code]['symbol']}}
                                                {{$account->transactions->sum('amount')}}
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab"
                                       href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Update Profile
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2"
                                       role="tab">
                                        Cards
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3"
                                       role="tab">
                                        Transactions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group m--margin-top-10 m--hide">
                                        <div class="alert m-alert m-alert--default" role="alert">
                                            The example form below demonstrates common HTML form elements that receive
                                            updated styles from Bootstrap with additional classes.
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                1. Personal Details
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            First Name
                                        </label>
                                        <div class="col-7">
                                            <input name="first_name" class="form-control m-input" type="text"
                                                   value="{{$customer->profile ? $customer->profile->first_name : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Last Name
                                        </label>
                                        <div class="col-7">
                                            <input name="last_name" class="form-control m-input" type="text"
                                                   value="{{$customer->profile ? $customer->profile->last_name : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Birthday
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="date"
                                                   value="{{$customer->profile ? $customer->profile->birthday : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Gender
                                        </label>
                                        <div class="col-7">
                                            <select name="gender"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--air m_selectpicker">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                2. Address
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Street
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="street"
                                                   value="{{$customer->profile ? $customer->profile->street : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            City
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="city"
                                            value="{{$customer->profile ? $customer->profile->city : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            State
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="region"
                                            value="{{$customer->profile ? $customer->profile->region : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Postcode
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" name="postal_code"
                                            value="{{$customer->profile ? $customer->profile->postal_code : ''}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-7">
                                                <button type="reset"
                                                        class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                    Save changes
                                                </button>
                                                &nbsp;&nbsp;
                                                <button type="reset"
                                                        class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_2"></div>
                        <div class="tab-pane " id="m_user_profile_tab_3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection