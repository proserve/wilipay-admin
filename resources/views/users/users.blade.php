@extends('layouts.admin')
@push('styles')
    <style>
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.details td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
@endpush
@section('content')
    <div class="row">
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <table class="table table-striped table-bordered table-hover" id="users-table">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Verified</th>
                    <th>Blocked</th>
                    <th>Created At</th>
                </tr>
                </thead>
            </table>
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
            </tr>
            </thead>
        </table>
    </script>
    <script>
      $(function () {
        var template = Handlebars.compile($("#details-template").html());
        var table = $('#users-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('users') !!}',
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
                return '<label class="m-checkbox m-checkbox--air"><input type="checkbox"' +
                    (row.verified ? 'checked' : '') +
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
            {data: 'created_at', name: 'created_at'},
          ],
          order: [[1, 'asc']]
        });
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
            ]
          })
        }
      });
    </script>
@endpush