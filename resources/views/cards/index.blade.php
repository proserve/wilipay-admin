@extends('layouts.dashboard')
@section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption" id="portlet-header">
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        @include('partials.date_range_filter')
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table" id="dataTableBuilder">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>Brand</th>
                    <th>Last 4</th>
                    <th>Exp Year</th>
                    <th>Exp Month</th>
                    <th>Country</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th title="Customer"></th>
                    <th title="Brand"></th>
                    <th title="Last 4"></th>
                    <th title="Exp Year"></th>
                    <th title="Exp Month"></th>
                    <th title="Country"></th>
                    <th title="Created"></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')

    <script type="text/javascript">(function (window, $) {
        const monthNames = ["January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];
        window.LaravelDataTables = window.LaravelDataTables || {};
        window.LaravelDataTables["dataTableBuilder"] = $("#dataTableBuilder").DataTable({
          "serverSide": true,
          "processing": true,
          responsive: true,
          oLanguage: {
            sProcessing: '<div class="m-blockui ">' +
            '<span>Processing...</span>' +
            '<span><div class="m-loader  m-loader--primary m-loader--lg"></div></span>' +
            '</div>'
          },
          "ajax": {
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
              data: function (card, type, set) {
                var profile = card.customer && card.customer.profile;
                return '<div class="m-card-user__pic" ' +
                    'style="display: flex;justify-content: center;flex-direction: column;align-items: center;">' +
                    '<img width="64px" height="64px" src="' + (profile && profile.avatar_url || '/assets/app/media/img/users/default_avatar.png') + '" ' +
                    'class="m--img-rounded m--marginless" alt="">' +
                    '<span>' + card.customer.email + '</span>' +
                    '</div>'
              }, name: 'customer.email', responsivePriority: 0,
            }, {
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
            },
            {
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
          "dom": "Brtip",
          "buttons": ["export", "print", "reset", "reload", 'pageLength'],
          initComplete: function () {
            this.api().columns().every(function () {
              var column = this;
              var input = document.createElement("input");
              $(input).attr("placeholder", "Filter " + $(column.footer()).attr('title'));
              $(input).addClass("form-control m-input m-input--air");
              $(input).appendTo($(column.footer()).empty())
                  .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                  });
            });
          },
        });
      })(window, jQuery);
      $(window.LaravelDataTables["dataTableBuilder"].buttons().container())
          .addClass('btn-group m-btn-group m-btn-group--pill m-btn-group--air');
      $(window.LaravelDataTables["dataTableBuilder"].buttons().container()).prependTo("#portlet-header");
      $('#dataTableBuilder_filter').prependTo("#portlet-header");
      $('#dataTableBuilder_filter input').addClass("m-input m-input--air");
    </script>
@endpush