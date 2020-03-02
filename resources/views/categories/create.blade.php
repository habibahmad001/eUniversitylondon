<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New User</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/users_add" accept-charset="UTF-8" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="first_name" id="first_name" placeholder="First Name" >
        
      </div>

      <div class="form-line">
        <input type="text" name="last_name" id="last_name" placeholder="Last Name" >
      </div>

      <div class="form-line">
        <input type="email" name="email" id="email" placeholder="E-mail" keyup="validateEmailExist('')">
        <span id="email-exist"></span>
      </div>

      <div class="form-line">
        <input type="text" name="phone" id="phone" placeholder="Phone">
      </div>

      <div class="form-line">
        <input type="text" name="password" id="password" placeholder="Password">
      </div>

      
      <div class="form-line">
        <select class="half-width" name="status" id="status">
            <option value="">Select Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

      </div>

      


    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>