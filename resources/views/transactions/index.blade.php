@extends('layouts.dashboard')
@section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption" id="portlet-header">
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table" id="dataTableBuilder">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Type</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th title="Id"></th>
                    <th title="Type"></th>
                    <th title="Purpose"></th>
                    <th title="Amount"></th>
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
          "ajax": "",
          "columns": [
            {
              "name": "id",
              "data": "id",
              responsivePriority: 0,
            }, {
              "name": "type",
              "data": "type",
              responsivePriority: 0,
            },{
              "name": "purpose",
              "data": "purpose",
              responsivePriority: 0,
            }, {
              "name": "amount",
              "data": 'amount',
              responsivePriority: 0,
            }, {
              "name": "created_at",
              "data": "created_at",
              "title": "Created",
              responsivePriority: 0,
            }
          ],
          "dom":
              "Brtip",
          "buttons":
              ["export", "print", "reset", "reload", 'pageLength'],
          initComplete:

              function () {
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