<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Term And Services</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/admin/update-cmstermservices" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="tns_id" id="tns_id">
    <input type="hidden" id="edit-email_exist">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="tns_title" id="edit-tns_title" placeholder="Term And Services Title" >
        </div>

        <div class="form-line">
          <textarea name="tns_desc" id="edit-tns_desc" placeholder="Type some description."></textarea>
        </div>
        
       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
