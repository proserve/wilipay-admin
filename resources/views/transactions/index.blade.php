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
                    <th>Id</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th title="Id"></th>
                    <th title="Customer"></th>
                    <th title="Type"></th>
                    <th title="Purpose"></th>
                    <th title="Amount"></th>
                    <th title="Currency"></th>
                    <th title="Created"></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
      (function (window, $) {
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
          "columns": [
            {
              "name": "id",
              "data": "id",
              responsivePriority: 0,
            }, {
              "name": "account.customer.email",
              "data": function (transaction, type, set) {
                var profile = transaction.account.customer && transaction.account.customer.profile;
                return '<div class="m-card-user__pic" ' +
                    'style="display: flex;justify-content: center;flex-direction: column;align-items: center;">' +
                    '<img width="64px" height="64px" src="' + (profile && profile.avatar_url || '/assets/app/media/img/users/default_avatar.png') + '" ' +
                    'class="m--img-rounded m--marginless" alt="">' +
                    '<span>' + transaction.account.customer.email + '</span>' +
                    '</div>'
              },
              responsivePriority: 0,
            }, {
              "name": "type",
              "data": function (data) {
                return '<span><span class="m-badge  m-badge--info m-badge--wide">' + data.type + '</span></span>'
              }, "className": 'text-center',
              responsivePriority: 0,
            }, {
              "name": "purpose",
              "data": "purpose",
              responsivePriority: 0,
            }, {
              "name": "amount",
              "data": function (data) {
                return '<span style="color: ' + (data.amount > 0 ? 'blue' : 'red') + '">' + data.amount + '</span>'
              }, "className": 'text-center',
              responsivePriority: 0,
            }, {
              "name": "account.currency_code",
              "data": 'account.currency_code',
              "className": 'text-center',
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
          }
        })
        ;
      })(window, jQuery);
      $(window.LaravelDataTables["dataTableBuilder"].buttons().container())
          .addClass('btn-group m-btn-group m-btn-group--pill m-btn-group--air');
      $(window.LaravelDataTables["dataTableBuilder"].buttons().container()).prependTo("#portlet-header");
      $('#dataTableBuilder_filter').prependTo("#portlet-header");
      $('#dataTableBuilder_filter input').addClass("m-input m-input--air");

    </script>
@endpush