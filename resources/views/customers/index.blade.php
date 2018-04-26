@extends('layouts.dashboard')
@section('content')
    <div class="row">
    </div>
    <div class="m-portlet m-portlet--bordered m-portlet--rounded  m-portlet--last">
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
            <div class="m-section__content">
                <table class="table table-hover wrap" id="users-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Verified</th>
                        <th>Blocked</th>
                        <th>Stripe</th>
                        <th>BirthDay</th>
                        <th>Gender</th>
                        <th>Language</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Street</th>
                        <th>Postal Code</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th title="Name"></th>
                        <th title="Phone"></th>
                        <th title="Email"></th>
                        <th title="Created At"></th>
                        <th></th>
                        <th></th>
                        <th title="Customer Id"></th>
                        <th title="Email"></th>
                        <th title="Gender"></th>
                        <th title="language"></th>
                        <th title="country"></th>
                        <th title="city"></th>
                        <th title="street"></th>
                        <th title="postal_code"></th>
                        <th title="actions"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!--end: Datatable -->
        </div>
    </div>

@endsection

@push('scripts')
    {{--<script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">User transactions</div>
        <table class="table details-table" id="transactions-@{{id}}">
            <thead>
            <tr>
                <th>Type</th>
                <th>Amount</th>
                <th>Purpose</th>
                <th>Currency</th>
                <th>Date</th>
            </tr>
            </thead>
        </table>
    </script>--}}
    <script>
      $(function () {
        window.LaravelDataTables = window.LaravelDataTables || {};
        // var template = Handlebars.compile($("#details-template").html());
        var table = $('#users-table').DataTable({
          "bSortCellsTop": true,
          processing: true,
          serverSide: true,
          responsive: true,
          oLanguage: {
            sProcessing: '<div class="m-blockui ">' +
            '<span>Processing...</span>' +
            '<span><div class="m-loader  m-loader--primary m-loader--lg"></div></span>' +
            '</div>'
          },
          "dom": "Brtip",
          "buttons": ["export", "print", "reset", "reload", 'pageLength'],
          ajax: {
            url: '{!! route('customers.index') !!}',
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

          colReorder: true,
          columns: [
            {
              data: function (user, type, set) {
                return '<div class="m-card-user__pic" ' +
                    'style="display: flex;justify-content: center;flex-direction: column;align-items: center;">' +
                    '<img width="64px" height="64px" src="' + (user.profile && user.profile.avatar_url || '/assets/app/media/img/users/default_avatar.png') + '" ' +
                    'class="m--img-rounded m--marginless" alt="">' +
                    '<span>' + (user.profile ? user.profile.first_name + ' ' + user.profile.last_name : '') + '</span>' +
                    '</div>'
              }, name: 'profile.first_name', responsivePriority: 0,
            },
            {data: 'phone', name: 'phone', responsivePriority: 0,},
            {data: 'email', name: 'email', responsivePriority: 1,},
            {data: 'created_at', name: 'created_at', responsivePriority: 2},
            {
              data: 'verified', name: 'verified', render: function (data, type, row) {
                return '<span class="m-switch m-switch--sm m-switch--outline m-switch--danger">' +
                    '<label style="margin-bottom: 0px">' +
                    '<input onchange="toggleVerifiedStatus(this, \'' + row.id + '\')" type="checkbox" ' + (row.verified ? 'checked' : '') + ' name="">' +
                    '<span></span>' +
                    '</label>' +
                    '</span>';
              }, responsivePriority: 2, className: 'text-center'
            }, {
              data: 'blocked', name: 'blocked', render: function (data, type, row) {
                return '<span class="m-switch m-switch--sm m-switch--outline m-switch--danger">' +
                    '<label style="margin-bottom: 0px">' +
                    '<input onchange="toggleBlockedStatus(this, \'' + row.id + '\')" type="checkbox" ' + (row.blocked ? 'checked' : '') + ' name="">' +
                    '<span></span>' +
                    '</label>' +
                    '</span>';
              }, responsivePriority: 2, className: 'text-center'
            }, {
              data: function (data, type, row) {
                return '<a href="https://dashboard.stripe.com/test/customers/' + data.stripe_customer_id + '" ' +
                    'style="text-align: center;font-size: 20px;color: #22b9ff; display: block;" target="_blank">'
                    + '<i class="fa fa-external-link"></i>'
                    + '</a>'
              }, name: 'stripe_customer_id', responsivePriority: 3,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.birthday : '';
              }, name: 'profile.birthday', responsivePriority: 3,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.gender : '';
              }, name: 'profile.gender', responsivePriority: 3,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.language : '';
              }, name: 'profile.language', responsivePriority: 4,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.country : '';
              }, name: 'profile.country', responsivePriority: 4,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.city : '';
              }, name: 'profile.city', responsivePriority: 4,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.street : '';
              }, name: 'profile.street', responsivePriority: 4,
            }, {
              data: function (user, type, set) {
                return user.profile ? user.profile.postal_code : '';
              }, name: 'profile.postal_code', responsivePriority: 4,
            },
            {
              title: 'Actions',
              render: function (data, type, row) {
                return '<div style="display: flex">' +
                    '<a style="margin-right: 5px" href="/customers/' + row.id + '" ' +
                    'class="btn m-btn m-btn--pill m-btn--gradient-from-info m-btn--gradient-to-warning  m-btn--icon m-btn--icon-only m-btn--air">' +
                    '<i class="fa flaticon-medical" style="font-size: 14px"></i>' +
                    '</a>' +
                    '</div>';
              },
              "orderable": false,
              "sorting": false,
              searchable: false,
              responsivePriority: 0,
            }
          ],
          initComplete: function () {
            this.api().columns([0, 1, 2, 3, 6, 7, 8, 9, 10, 11, 12, 13]).every(function () {
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
          order: [[1, 'asc']]
        });
        window.LaravelDataTables["dataTableBuilder"] = table;
        $(window.LaravelDataTables["dataTableBuilder"].buttons().container())
            .addClass('btn-group m-btn-group m-btn-group--pill m-btn-group--air');
        $(window.LaravelDataTables["dataTableBuilder"].buttons().container()).prependTo("#portlet-header");
        $('.dataTables_filter').prependTo("#portlet-header");
        $('.dataTables_filter input').addClass("m-input m-input--air");
      });

      function toggleBlockedStatus(ele, customerID) {
        var $ele = $(ele);
        $('.dataTables_processing').show()
        $.post('/customers/' + customerID + '/blocked', {blocked: $ele.is(':checked') ? 1 : 0})
            .done(function (resp) {
              console.log(resp);
            })
            .fail(function (err) {
              $ele.prop('checked', !$ele.is(':checked'));
            })
            .always(function () {
              $('.dataTables_processing').hide();
            });
      }

      function toggleVerifiedStatus(ele, customerID) {
        var $ele = $(ele);
        $('.dataTables_processing').show()
        $.post('/customers/' + customerID + '/verified', {verified: $ele.is(':checked') ? 1 : 0})
            .done(function (resp) {
              console.log(resp);
            })
            .fail(function (err) {
              $ele.prop('checked', !$ele.is(':checked'));
            })
            .always(function () {
              $('.dataTables_processing').hide();
            });
      }
    </script>
@endpush
