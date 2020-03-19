<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit CMS</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/admin/update-cms" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cms_id" id="cms_id">
    <input type="hidden" id="edit-email_exist">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="cms_title" id="edit-cms_title" placeholder="Category Title" >
        </div>

        <div class="form-line">
          <textarea name="cms_desc" id="edit-cms_desc" placeholder="Type some description."></textarea>
        </div>
        
       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
