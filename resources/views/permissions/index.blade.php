@extends('layouts.dashboard')
@section('content')
    <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30"
         role="alert">
        <div class="m-alert__icon">
            <i class="flaticon-warning-2 m--font-warning"></i>
        </div>
        <div class="m-alert__text">
            Please be aware that after each Roles or Permissions modifications, code source changes should be applied.
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Permissions details
                    </h3>
                </div>

            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="javascript:;" data-toggle="modal" data-target="#permission_modal"
                           class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-accent">
                            <span><i class="fa fa-plus"></i><span>Create</span></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table m-table m-table--head-separator-primary">
                <thead>
                <tr>
                    <th>Permission</th>
                    <th>Roles</th>
                    <th style="text-align: center">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($permissions as $permission)
                    <tr>

                        <td>
                            <span><span class="m-badge  m-badge--info m-badge--wide">{{ $permission->name }}</span></span>
                        </td>

                        <td>
                            @foreach($permission->roles as $role)
                                <div>
                                    <span class="m-badge m-badge--primary m-badge--dot"></span>
                                    <span class="m--font-bold m--font-primary">{{ $role->name }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <form method="POST" action="{{route('permissions.destroy', ['id' => $permission->id])}}"
                                  accept-charset="UTF-8" style="display: flex;justify-content: center">

                                <a href="javascript:;" data-toggle="modal" data-target="#role_modal_{{$permission->id}}"
                                   style="margin-right: 20px"
                                   class="btn btn-sm m-btn--icon m-btn--pill m-btn--air m-btn m-btn--gradient-from-info m-btn--gradient-to-accent">
                                    <span>
                                        <i class="fa fa-edit"></i>Edit</span>
                                </a>
                                <input name="_method" type="hidden" value="DELETE">
                                {{csrf_field()}}
                                <a href="javascript:;"
                                   class="delete_btn btn btn-sm m-btn--icon m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning">
                                    <span><i class="fa fa-trash">

                                        </i>Delete</span>
                                </a>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <div class="modal fade" id="permission_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Create new Permission
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-remove"></span>
                    </button>
                </div>
                <div class="m-portlet" style="margin-bottom: 0px;">
                    <form class="m-form" id="user_form" method="post" action="{{route('permissions.store')}}">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="POST">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--last">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-3 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control m-input m-input--air" name="name"
                                               placeholder="Permission Name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-3 col-form-label">
                                        Roles:
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="roles[]"
                                                class="form-control m-bootstrap-select m-bootstrap-select--air m_selectpicker"
                                                multiple>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-success">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($permissions as $permission)
        <div class="modal fade" id="role_modal_{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby=""
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">
                            Create new Permission
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-remove"></span>
                        </button>
                    </div>
                    <div class="m-portlet" style="margin-bottom: 0px;">
                        <form class="m-form" id="user_form" method="POST"
                              action="{{route('permissions.update', ['id' => $permission->id])}}">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--last">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Name:
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control m-input m-input--air" name="name"
                                                   placeholder="Permission Name" value="{{$permission->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Roles:
                                        </label>
                                        <div class="col-lg-9">
                                            <select name="permissions[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--air m_selectpicker"
                                                    multiple>
                                                @foreach($roles as $role)
                                                    <option {{in_array($role->id, $permission->roles->pluck('id')->toArray()) ? 'selected' : ''}}
                                                            value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <script>
      $('.delete_btn').click(function (e) {
        var that = this;
        swal({
          title: "Be careful This will affect all the system!",
          text: "Not sure !? Contact the Dev team",
          icon: "success",
          confirmButtonText: "<span><i class='fa fa-trash'></i><span>Yes Delete</span></span>",
          confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",
          showCancelButton: true,
          cancelButtonText: "<span><i class='fa fa-times'></i><span>Cancel</span></span>",
          cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
        }).then(function (resp) {
          if (resp.value) {
            $(that).closest("form").submit();
          }
        });
      })
    </script>
@endpush('scripts')