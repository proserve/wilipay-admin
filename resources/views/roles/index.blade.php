@extends('layouts.dashboard')
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Roles details
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <button data-toggle="modal" data-target="#role_modal"
                                class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-accent">
                            <span>
                                <i class="fa fa-plus"></i>
                                <span>Create</span>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($roles as $role)
                    <tr>

                        <td>
                            <span><span class="m-badge  m-badge--info m-badge--wide">{{ $role->name }}</span></span>
                        </td>

                        <td>
                            @foreach($role->permissions as $permission)
                                <div>
                                    <span class="m-badge m-badge--primary m-badge--dot"></span>
                                    <span class="m--font-bold m--font-primary">{{ $permission->name }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <form method="POST" action="{{route('roles.destroy', ['id' => $role->id])}}"
                                  accept-charset="UTF-8" style="display: flex;justify-content: center">

                                <a href="javascript:;" data-toggle="modal" data-target="#role_modal_{{$role->id}}"
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
        </div>
    </div>

    <div class="modal fade" id="role_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Create new Role
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-remove"></span>
                    </button>
                </div>
                <div class="m-portlet" style="margin-bottom: 0px;">
                    <form class="m-form" id="user_form" method="post" action="{{route('roles.store')}}">
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
                                               placeholder="Role Name">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-3 col-form-label">
                                        Permissions:
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="permissions[]"
                                                class="form-control m-bootstrap-select m-bootstrap-select--air m_selectpicker"
                                                multiple>
                                            @foreach($permissions as $permission)
                                                <option value="{{$permission->id}}">{{$permission->name}}</option>
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
                                        <button type="submit"
                                                class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-success m-btn--gradient-to-accent">
                                            Submit
                                        </button>
                                        <button type="reset"
                                                class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-metal m-btn--gradient-to-metal">
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

    @foreach ($roles as $role)
        <div class="modal fade" id="role_modal_{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby=""
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">
                            Create new Role
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-remove"></span>
                        </button>
                    </div>
                    <div class="m-portlet" style="margin-bottom: 0px;">
                        <form class="m-form" id="user_form" method="POST"
                              action="{{route('roles.update', ['id' => $role->id])}}">
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
                                                   placeholder="Role Name" value="{{$role->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-3 col-form-label">
                                            Permissions:
                                        </label>
                                        <div class="col-lg-9">
                                            <select name="permissions[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--air m_selectpicker"
                                                    multiple>
                                                @foreach($permissions as $permission)
                                                    <option {{in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : ''}}
                                                            value="{{$permission->id}}">{{$permission->name}}</option>
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
                                            <button type="submit"
                                                    class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-success m-btn--gradient-to-accent">
                                                Submit
                                            </button>
                                            <button type="reset"
                                                    class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-metal m-btn--gradient-to-metal">
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