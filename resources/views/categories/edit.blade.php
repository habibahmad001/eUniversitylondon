<!-- Add form -->
<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Category</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" id="category_form" action="/category-update" accept-charset="UTF-8" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cat_id" id="cat_id" value="">
    <input type="hidden" id="edit-category_already_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

       
      <div class="form-line">
        <input type="text" name="category" id="edit-category" placeholder="Category Name">
        <span id="edit-category-exist"></span>
        
        
      </div>

      

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>