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
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" role="tab"
                                       href="#m_user_profile_tab_1" onclick="$('#date_filter').hide();">
                                        <i class="flaticon-share m--hide"></i>
                                        Update Profile
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2"
                                       role="tab" onclick="initCardsTable(window, $)">
                                        Cards
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3"
                                       role="tab" onclick="initTransactionsTable(window, $)">
                                        Transactions
                                    </a>
                                </li>
                            </ul>
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item" id="date_filter" style="display: none">
                                    @include('partials.date_range_filter')
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
                                        <div class=" col-10">
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
                        <div class="tab-pane " id="m_user_profile_tab_2">
                            <div class="m-tooltip--portlet">
                                <table class="table" id="cardsDataTable" style="width: 100% !important;">
                                    <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Last 4</th>
                                        <th>Exp Year</th>
                                        <th>Exp Month</th>
                                        <th>Country</th>
                                        <th>Created</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_3">
                            <div class="m-tooltip--portlet">
                                <table class="table" id="transactionsDataTable" style="width: 100% !important;">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Type</th>
                                        <th>Purpose</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                        <th>Created</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
      function initCardsTable(window, $) {
        $('#date_filter').show();
        const monthNames = ["January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];
        window.LaravelDataTables = window.LaravelDataTables || {};
        window.LaravelDataTables["dataTableBuilder"] = $("#cardsDataTable").DataTable({
          "serverSide": true,
          "processing": true,
          responsive: true,
          "destroy": true,
          oLanguage: {
            sProcessing: '<div class="m-blockui ">' +
            '<span>Processing...</span>' +
            '<span><div class="m-loader  m-loader--primary m-loader--lg"></div></span>' +
            '</div>'
          },
          "ajax": {
            url: '{!! route('cards.byCustomerId' , ['customerId' => $customer->id]) !!}',
            data: function (d) {
              let datePicker = $('#w_daterange_filter').data('daterangepicker');
              if (datePicker) {
                return $.extend({}, d, {
                  startDate: datePicker.startDate.toISOString(),
                  endDate: datePicker.endDate.toISOString(),
                });
              }
              return d;
            }
          },
          "columns": [{
            "name": "brand",
            data: function (card, type, set) {
              return '<div class="m-card-user__pic" ' +
                  'style="display: flex;justify-content: center;flex-direction: column;align-items: center;">' +
                  '<img width="64px" height="64px" src="/assets/app/media/img/card-network/' + card.brand + '.png" ' +
                  'class="m--img-rounded m--marginless" alt="">' +
                  '</div>'
            },
            "title": "Brand",
            responsivePriority: 0,
          }, {
            "name": "last4",
            "data": "last4",
            "title": "Last4",
            responsivePriority: 0,
          }, {
            "name": "exp_year",
            "data": "exp_year",
            "title": "Exp year",
            responsivePriority: 0,
          }, {
            "name": "exp_month",
            "data": function (card) {
              return monthNames[card.exp_month]
            },
            "title": "Exp Month",
            responsivePriority: 0,
          }, {
            "name": "country",
            "data": "country",
            "title": "Country",
            responsivePriority: 0,
          }, {
            "name": "created_at",
            "data": "created_at",
            "title": "Created",
            responsivePriority: 0,
          }
          ],
          "dom": "rtip",
        });
      }

      function initTransactionsTable(window, $) {
        $('#date_filter').show();
        window.LaravelDataTables = window.LaravelDataTables || {};
        window.LaravelDataTables["dataTableBuilder"] = $("#transactionsDataTable").DataTable({
          "serverSide": true,
          "processing": true,
          responsive: true,
          "destroy": true,
          oLanguage: {
            sProcessing: '<div class="m-blockui ">' +
            '<span>Processing...</span>' +
            '<span><div class="m-loader  m-loader--primary m-loader--lg"></div></span>' +
            '</div>'
          },
          "ajax": {
            url: '{!! route('transactions.byCustomerId' , ['customerId' => $customer->id]) !!}',
            data: function (d) {
              let datePicker = $('#w_daterange_filter').data('daterangepicker');
              if (datePicker) {
                return $.extend({}, d, {
                  startDate: datePicker.startDate.toISOString(),
                  endDate: datePicker.endDate.toISOString(),
                });
              }
              return d;
            }
          },
          "columns": [
            {
              "name": "id",
              "data": "id",
              responsivePriority: 0,
            }, {
              "name": "type",
              "data": "type",
              responsivePriority: 0,
            }, {
              "name": "purpose",
              "data": "purpose",
              responsivePriority: 0,
            }, {
              "name": "amount",
              "data": 'amount',
              responsivePriority: 0,
            },{
              "name": "account.currency_code",
              "data": function (data) {
                return (data.account && data.account.currency_code) || '';
              },
              responsivePriority: 0,
            }, {
              "name": "created_at",
              "data": "created_at",
              "title": "Created",
              responsivePriority: 0,
            }
          ],
          "dom": "rtip",
        });
      }


    </script>


@endpush