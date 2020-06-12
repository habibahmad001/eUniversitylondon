<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Teams</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-teams" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="t_id" id="t_id">
    <input type="hidden" id="edit-email_exist">
    <input type="hidden" name="img_path" id="img_path" value="{{URL::asset('/uploads/teams/')}}">
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
          <input type="text" name="t_name" id="edit-t_name" placeholder="Teams Name" >
        </div>

        <div class="form-line">
          <textarea name="t_desc" id="edit-t_desc" placeholder="Type Teams Description."></textarea>
        </div>

        <div class="form-line">
          <input type="text" name="t_role" id="edit-t_role" placeholder="Teams Role/Position" >
        </div>

        <div class="form-line">
          <input type="file" name="t_img" id="edit-t_img">
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
