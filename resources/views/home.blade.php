@extends('layouts.dashboard')

@section('content')
    <div class="m-portlet">
        <div class="m-portlet__body m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-12 col-xl-4">
                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Between Accounts</h3>
                                    <span class="m-widget1__desc">Today Accounts to Account transactions</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">+$17,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Exchange</h3>
                                    <span class="m-widget1__desc">Today Currency Exchange Transactions</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">+1,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Top up</h3>
                                    <span class="m-widget1__desc">Today Stripe cards loading</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success">-27,49%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-4">
                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Between Accounts</h3>
                                    <span class="m-widget1__desc">This week Accounts to Account transactions</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">+$17,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Exchange</h3>
                                    <span class="m-widget1__desc">This week Currency Exchange Transactions</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">+1,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Top up</h3>
                                    <span class="m-widget1__desc">This week Stripe cards loading</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success">-27,49%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-4">
                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Between Accounts</h3>
                                    <span class="m-widget1__desc">This Month Accounts to Account transactions</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">+$17,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Exchange</h3>
                                    <span class="m-widget1__desc">This month Currency Exchange Transactions</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">+1,800</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">Top up</h3>
                                    <span class="m-widget1__desc">This month Stripe cards loading</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success">-27,49%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                            <h3 class="m-portlet__head-text">
                                Daily new users
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="m_amcharts_1" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <!--begin:: Widgets/Product Sales-->
            <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Wilipay Profit
                                <span class="m-portlet__head-desc">Total Profit from all channels</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget25">
                        <span class="m-widget25__price m--font-brand">$237,650</span>
                        <span class="m-widget25__desc">Total Revenue This Month</span>
                        <div class="m-widget25--progress">
                            <div class="m-widget25__progress">
                                <span class="m-widget25__progress-number">63%</span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-danger" role="progressbar" style="width: 63%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">Active Users Growth</span>
                            </div>
                            <div class="m-widget25__progress">
                                <span class="m-widget25__progress-number">39%</span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-accent" role="progressbar" style="width: 39%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">Installs Growth</span>
                            </div>
                            <div class="m-widget25__progress">
                                <span class="m-widget25__progress-number">54%</span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-warning" role="progressbar" style="width: 54%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="m-widget25__progress-sub">Revenue growth</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
    <script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css"/>
    <script>
      AmCharts.makeChart("m_amcharts_1", {
        "type": "serial",
        "theme": "light",
        "dataProvider": [1, 2, 3, 4, 5].map(function (index) {
          return {
            "country": moment().subtract('days', index).format('YYYY/M/D'),
            "visits": Math.floor(Math.random() * 1500)
          }
        }),
        "valueAxes": [{
          "gridColor": "#FFFFFF",
          "gridAlpha": 0.2,
          "dashLength": 0
        }],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
          "balloonText": "[[category]]: <b>[[value]]</b>",
          "fillAlphas": 0.8,
          "lineAlpha": 0.2,
          "type": "column",
          "valueField": "visits"
        }],
        "chartCursor": {
          "categoryBalloonEnabled": false,
          "cursorAlpha": 0,
          "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
          "gridPosition": "start",
          "gridAlpha": 0,
          "tickPosition": "start",
          "tickLength": 20
        },
        "export": {
          "enabled": true
        }
      })
    </script>
@endpush
