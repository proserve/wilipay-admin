@extends('layouts.dashboard')
@section('content')
    <div class="row">
    </div>
    <div class="m-portlet m-portlet--bordered m-portlet--rounded  m-portlet--last">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption" id="portlet-header">
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-section__content">
                <table class="table table-hover wrap" id="users-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Blocked</th>
                        <th>Cards</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th title="Name"></th>
                        <th title="Phone"></th>
                        <th title="Email"></th>
                        <th></th>
                        <th></th>
                        <th title="Cards"></th>
                        <th title="Created At"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!--end: Datatable -->
        </div>
    </div>

@endsection

@push('scripts')
    <script id="details-template" type="text/x-handlebars-template">
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
    </script>
    <script>
      $(function () {
        window.LaravelDataTables = window.LaravelDataTables || {};
        var template = Handlebars.compile($("#details-template").html());
        var table = $('#users-table').DataTable({
          "bSortCellsTop": true,
          processing: true,
          serverSide: true,
          "dom": "Bfrtip",
          "buttons": ["export", "print", "reset", "reload", 'pageLength', 'create'],
          ajax: '{!! route('customers.index') !!}',
          colReorder: true,
          columns: [
            {
              "className": 'details-control',
              "orderable": false,
              "searchable": false,
              "data": null,
              "defaultContent": ''
            },
            {
              data: function (user, type, set) {
                return user.profile ? user.profile.first_name + ' ' + user.profile.last_name : '';
              }, name: 'profile.first_name',
            },
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {
              data: 'verified', name: 'verified', render: function (data, type, row) {
                return '<label class="m-checkbox m-checkbox--air">' +
                    '<input type="checkbox" onchange="handleChange(this);"' + (row.verified ? 'checked' : '') +
                    '><span></span></label>';
              }
            },
            {
              data: 'blocked', name: 'blocked', render: function (data, type, row) {
                return '<label class="m-checkbox m-checkbox--air"><input type="checkbox"' +
                    (row.blocked ? 'checked' : '') +
                    '><span></span></label>';
              }
            },
            {data: 'cards', name: 'cards'},
            {data: 'created_at', name: 'created_at'},
          ],
          initComplete: function () {
            this.api().columns([1, 2, 3, 7]).every(function () {
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
        // Add event listener for opening and closing details
        $('#users-table tbody').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);
          var tableId = 'transactions-' + row.data().id;


          if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
          } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
          }
        });

        function initTable(tableId, data) {
          $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [
              {data: 'type', name: 'type'},
              {data: 'amount', name: 'amount'},
              {data: 'purpose', name: 'purpose'},
              {data: 'currency', name: 'currency'},
              {data: 'created_at', name: 'created_at'},
            ]
          })
        }
      });

      function handleChange(ele) {
        debugger;
        var $ele = $(ele);
        $.post('/users/blocked', {blocked: $ele.val() == 'on' ? true : false})
            .done(function (resp) {
              console.log(resp);
            })
            .fail(function (err) {
              console.log(err);
            })
            .always(function () {

            });
        console.log($ele.val());
      }
    </script>
@endpush
