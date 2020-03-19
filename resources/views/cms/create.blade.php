<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New CMS</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/admin/cms_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="cms_title" id="cms_title" placeholder="Title" >
      </div>

      <div class="form-line">
        <textarea name="cms_desc" id="cms_desc" placeholder="Type some description."></textarea>
      </div>


    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>