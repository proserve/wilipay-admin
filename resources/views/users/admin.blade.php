@extends('layouts.admin')
@push('styles')
    <style>
        table > thead > tr > th {
            border-bottom: none !important;
            border-top: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <table class="table table-bordered table-hover" id="dataTableBuilder">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th title="Id"></th>
                    <th title="Name"></th>
                    <th title="Email"></th>
                    <th title="Created At"></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">(function (window, $) {
        window.LaravelDataTables = window.LaravelDataTables || {};
        window.LaravelDataTables["dataTableBuilder"] = $("#dataTableBuilder").DataTable({
          "serverSide": true,
          "processing": true,
          select: true,
          keys: true,
          "ajax": "",
          "columns": [{
            "name": "id",
            "data": "id",
            "title": "Id",
          }, {
            "name": "name",
            "data": "name",
            "title": "Name",
          },
            {
              "name": "email",
              "data": "email",
              "title": "Email",
            }, {
              "name": "created_at",
              "data": "created_at",
              "title": "Created At",
            }],
          "dom": "Bfrtip",
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
    </script>
@endpush