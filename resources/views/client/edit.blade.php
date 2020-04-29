<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Client</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-client" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="c_id" id="c_id">
    <input type="hidden" id="edit-email_exist">
    <input type="hidden" name="img_path" id="img_path" value="{{URL::asset('/uploads/client/')}}">
    <input type="hidden" name="public" id="public" value="{{URL::asset('')}}">
    <input type="hidden" name="user_folder" id="user_folder" value="{{ collect(request()->segments())->first() }}">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="c_name" id="edit-c_name" placeholder="Client Name" >
        </div>

        <div class="form-line">
          <input type="file" name="c_logo" id="edit-c_logo">
          <div id="avatar_div">
            <img src="http://via.placeholder.com/150x150" width="150" height="150">
          </div>
        </div>

      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
