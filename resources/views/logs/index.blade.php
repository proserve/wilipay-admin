@extends('layouts.dashboard')
@section('content')
    <style>
        @media only screen and (max-width: 400px) {
            .buttons-page-length {
                display: block;
            }
        }
    </style>
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
                    <th>User</th>
                    <th>Description</th>
                    <th>Old Values</th>
                    <th>New Values</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th title="User"></th>
                    <th title="Description"></th>
                    <th title="Old Values"></th>
                    <th title="New Values"></th>
                    <th title="Created At"></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('partials.actions_btn')
    <script type="text/javascript">(function (window, $) {
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
              "name": "description",
              "data": "description",
              "title": "description",
              responsivePriority: 0,
            }, {
              "name": "email",
              data: function (row, type, set) {
                return '<div class="m-card-user__pic" ' +
                    'style="display: flex;justify-content: center;flex-direction: column;align-items: center;">' +
                    '<img width="64px" height="64px" src="' + (row.avatar_url || '/assets/app/media/img/users/default_avatar.png') + '" class="m--img-rounded m--marginless" alt="">' +
                    '<span>' + row.name + '</span>' +
                    '<span>' + row.email + '</span>' +
                    '</div>';
              },
              "title": "User",
              responsivePriority: 0,
            }, {
              name: 'properties',
              data: function (log, type, set) {
                let attributes = JSON.parse(log.properties.replace(/(&quot\;)/g, "\"")).old;
                return attributes ? '<ul style="margin-bottom: 0px; padding-left: 20px">' + Object.keys(attributes).map(function (key) {
                  return '<li>' + key + ' : ' + attributes[key] + '</li>';
                }).join('') + '</ul>' : '';
              }
            }, {
              name: 'properties',
              data: function (log, type, set) {
                let attributes = JSON.parse(log.properties.replace(/(&quot\;)/g, "\"")).attributes;
                return attributes ? '<ul style="margin-bottom: 0px;padding-left: 20px">' + Object.keys(attributes).map(function (key) {
                  return '<li>' + key + ' : ' + attributes[key] + '</li>';
                }).join('') + '</ul>' : '';
              }
            }, {
              "name": "created_at",
              "data": "created_at",
              "title": "Created At",
              responsivePriority: 1,

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