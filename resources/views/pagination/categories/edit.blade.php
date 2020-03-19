<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Category</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/update-category" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cat_id" id="cat_id">
    <input type="hidden" id="edit-email_exist">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="cat_title" id="edit-cat_title" placeholder="Category Title" >
        </div>

        <div class="form-line">
          <textarea name="c_content" id="edit-c_content" placeholder="Type some description."></textarea>
        </div>

        <div class="form-line">
          <input type="checkbox" name="child" id="edit-child" >&nbsp;&nbsp;&nbsp; Is Child
        </div>

        <div class="form-line" id="cat_div">
          <select name="sel_txt" id="edit-sel_txt" class="half-width">
            <option value="">Select Categories</option>
            <option value="1">Category 1</option>
            <option value="2">Category 2</option>
            <option value="3">Category 3</option>
            <option value="4">Category 4</option>
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
