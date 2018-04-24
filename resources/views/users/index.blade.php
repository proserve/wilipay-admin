@extends('layouts.dashboard')
@section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption" id="portlet-header">
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="" data-toggle="modal" data-target="#m_select_modal"
                           class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-info m-btn--gradient-to-accent">
                            <span><i class="fa fa-plus"></i><span>Create</span></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table" id="dataTableBuilder">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th title="Name"></th>
                    <th title="Email"></th>
                    <th title="Roles"></th>
                    <th title="Created At"></th>
                    <th title="Actions"></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @include('partials.user_form')
@endsection

@push('scripts')
    @include('partials.actions_btn')
    <script type="text/javascript">(function (window, $) {
        var editBtnTemplate = Handlebars.compile($("#action-buttons").html());
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
          "columns": [{
            "name": "name",
            "data": "name",
            "title": "Name",
            responsivePriority: 0,
            render: function (data, type, row) {
              return '<div class="m-card-user__pic" ' +
                  'style="display: flex;justify-content: center;flex-direction: column;align-items: center;">' +
                  '<img width="64px" height="64px" src="' + (row.avatar_url || '/assets/app/media/img/users/default_avatar.png') + '" class="m--img-rounded m--marginless" alt="">' +
                  '<span>' + row.name + '</span>' +
                  '</div>'
            }
          }, {
            "name": "email",
            "data": "email",
            "title": "Email",
            responsivePriority: 1,
          }, {
            "name": "roles",
            "data": "roles",
            "title": "Roles",
            render: function (data, type, row) {
              return data.map(function (role) {
                return '<span class="m-badge  m-badge--info m-badge--wide" style="margin-right: 5px;margin-bottom: 5px">' + role.name + '</span>'
              }).join('');
            },
            "orderable": false,
            "sorting": false,
            searchable: false,

          }, {
            "name": "created_at",
            "data": "created_at",
            "title": "Created At",

          }, {
            title: 'Actions', render: function (data, type, row) {
              return editBtnTemplate({row: row, csrfToken: Laravel.csrfToken});
            },
            "orderable": false,
            "sorting": false,
            searchable: false,
            responsivePriority: 0,
          }],
          "dom": "Brtip",
          "buttons": ["export", "print", "reset", "reload", 'pageLength'],
          initComplete: function () {
            this.api().columns([0, 1, 3]).every(function () {
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