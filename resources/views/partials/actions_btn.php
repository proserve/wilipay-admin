<script id="action-buttons" type="text/x-handlebars-template">
    <form method="POST" action="/users/{{row.id}}" accept-charset="UTF-8"
          style="display: flex;justify-content: space-around;">
        <input name="_method" type="hidden" value="DELETE">
        <input name="_token" type="hidden" value="{{csrfToken}}">
        <a onclick='openEditModal({{json row}})' style="margin-right: 5px" href="javascript:;"
           class="btn m-btn--pill m-btn m-btn--gradient-from-info m-btn--gradient-to-accent m-btn--icon m-btn--icon-only m-btn--air">
            <i class="fa flaticon-edit" style="font-size: 14px"></i>
        </a>
        <a href="javascript:;" onclick="showAlert(this)"
           class="btn m-btn--pill m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning m-btn--icon m-btn--icon-only m-btn--air">
            <i class="fa flaticon-delete-2" style="font-size: 14px"></i>
        </a>
    </form>
</script>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#avatar_preview').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#avatar_field").change(function () {
    readURL(this);
  });

  function populate(frm, data) {
    $.each(data, function (key, value) {
      var ctrl = $('[name=' + key + ']', frm);
      switch (ctrl.prop("type")) {
        case "radio":
        case "checkbox":
          ctrl.each(function () {
            if ($(this).attr('value') == value) $(this).attr("checked", value);
          });
          break;
        default:
          ctrl.val(value);
      }
    });
  }

  function openEditModal(data) {
    let $mSelectModal = $('#m_select_modal');
    let $userForm = $('#user_form');

    $mSelectModal.modal('show');
    populate($userForm, data);
    $('#modal-title').text('Edit User');
    $userForm.attr('action', '/users/' + data.id);
    $('#user_form input[name=_method]').val('PUT');
    $('#password').after('<span class="m-form__help" id="help-password">just let password blank if you don\'t want to change it</span>')
    $('#avatar_preview').attr('src', data.avatar_url || '/assets/app/media/img/users/default_avatar.png');
    $('.m_selectpicker').selectpicker('val', data.roles.map(function (role) {
      return role.id;
    }));

    $mSelectModal.on('hidden.bs.modal', function () {
      $('#help-password').remove();
      $userForm.attr('action', '/users');
      $('#user_form input[name=_method]').val('POST');
      $('#avatar_preview').attr('src', '/assets/app/media/img/users/default_avatar.png');
      $('.m_selectpicker').selectpicker('val', []);
      $userForm[0].reset();
      $('#modal-title').text('Create New User');
    });
  }

  function showAlert(that) {
    debugger;
    swal({
      title: "This user will be deleted permanently",
      text: "",
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

  }
</script>