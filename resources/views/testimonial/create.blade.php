<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Testimonial</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/testimonial_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="t_name" id="t_name" placeholder="Testimonial Name" >
      </div>

      <div class="form-line">
        <textarea name="t_desc" id="t_desc" placeholder="Type Testimonial Description."></textarea>
      </div>

      <div class="form-line">
        <input type="text" name="t_role" id="t_role" placeholder="Testimonial Role/Position" >
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