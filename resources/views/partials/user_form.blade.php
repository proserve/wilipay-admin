<div class="modal fade" id="m_select_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">
                    Create new User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <div class="m-portlet" style="margin-bottom: 0px;">
                <form class="m-form" id="user_form" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="POST">
                    <input type="file" name="avatar" hidden id="avatar_field">
                    <div class="m-portlet__body">

                        <div class="m-form__section m-form__section--last">
                            <div class="form-group m-form__group row" onclick="$('#avatar_field').click()"
                                 style="display: flex;align-items: center; flex-direction: column">
                                <div class="m-card-user__pic">
                                    <img id="avatar_preview"
                                         src="https://image.flaticon.com/icons/png/512/138/138672.png"
                                         class="m--img-rounded m--marginless" width="100px" height="100px"
                                         alt="">
                                </div>
                                Profile Picture
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Full Name:
                                </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control m-input m-input--air" name="name"
                                           placeholder="Enter full name" required>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Email address:
                                </label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control m-input m-input--air" name="email"
                                           placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Password:
                                </label>
                                <div class="col-lg-9">
                                    <input type="password" id="password" class="form-control m-input m-input--air" name="password"
                                           placeholder="password">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">
                                    Password:
                                </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control m-input" name="password_confirmation"
                                           placeholder="password">
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
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
