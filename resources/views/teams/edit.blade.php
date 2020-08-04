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

        <div class="form-line add-social">
          <select name="social_icon[]" id="edit-social_icon-1" class="custom-select mr-sm-2 w-40-percent">
            <option value="">Choose...</option>
            <option value="fa fa-facebook">Facebook</option>
            <option value="fa fa-paper-plane">Link External</option>
            <option value="fa fa-linkedin">LinkeDin</option>
            <option value="fa fa-instagram">Instagram</option>
            <option value="fa fa-youtube-play">YouTube</option>
          </select>
          <input type="text" name="link[]" id="edit-link-1" class="w-40-percent" placeholder="Link Here ..." >
          <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick='javascript:social_item("","","edit-");'> <i class="fa fa-plus"></i> </button>
        </div>

        <div class="form-line add-social edit-add-social-item">
          <input type="hidden" name="idcount" id="edit-idcount" value="1">
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
