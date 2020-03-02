<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit User</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/update-user" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="user_id" id="user_id">
    <input type="hidden" id="edit-email_exist">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">
        
       
        
        
       
        <div class="form-line">
          <input type="text" name="first_name" id="edit-first_name" placeholder="First Name">
        </div>

        <div class="form-line">
          <input type="text" name="last_name" id="edit-last_name" placeholder="Last Name">
        </div>

        <div class="form-line">
          <input type="email" name="email" id="edit-email" placeholder="First Name" onchange="validateEmailExist('edit-')">
          <span id="edit-email-exist"></span>
        </div>

        <div class="form-line">
          <input type="text" name="phone" id="edit-phone" placeholder="Phone">
        </div>



         <div class="form-line">
          <select class="half-width" name="status" id="edit-status">
            <option>Select Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        </div>
        
       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
