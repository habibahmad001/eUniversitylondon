<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Teams</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/teams_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="t_name" id="t_name" placeholder="Member Name" >
      </div>

      <div class="form-line">
        <textarea name="t_desc" id="t_desc" placeholder="Type Member Description."></textarea>
      </div>

      <div class="form-line">
        <input type="text" name="t_role" id="t_role" placeholder="Member Role/Position" >
      </div>

      <div class="form-line add-social">
        <select name="social_icon[]" id="social_icon-1" class="custom-select mr-sm-2 w-40-percent">
          <option value="">Choose...</option>
          <option value="fa fa-facebook">Facebook</option>
          <option value="fa fa-paper-plane">Link External</option>
          <option value="fa fa-linkedin">LinkeDin</option>
          <option value="fa fa-instagram">Instagram</option>
          <option value="fa fa-youtube-play">YouTube</option>
        </select>
        <input type="text" name="link[]" id="link-1" class="w-40-percent" placeholder="Link Here ..." >
        <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="javascript:social_item();"> <i class="fa fa-plus"></i> </button>
      </div>

      <div class="form-line add-social add-social-item">
        <input type="hidden" name="idcount" id="idcount" value="1">
      </div>

      <div class="form-line">
        <input type="file" name="t_img" id="t_img">
        <div id="avatar_div">
          <img src="http://via.placeholder.com/150x150" width="150" height="150">
        </div>
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>