<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Category</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/category_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="cat_title" id="cat_title" placeholder="Category Title" >
      </div>

      <div class="form-line">
        <textarea name="c_content" id="c_content" placeholder="Type some description."></textarea>
      </div>

      <div class="form-line">
        <input type="checkbox" name="child" id="child" >&nbsp;&nbsp;&nbsp; Is Child
      </div>
      
      <div class="form-line" id="cat_div">
        <select name="sel_txt" id="sel_txt" class="half-width">
            <option value="">Select Categories</option>
            <option value="1">Category 1</option>
            <option value="2">Category 2</option>
            <option value="3">Category 3</option>
            <option value="4">Category 4</option>
        </select>
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>