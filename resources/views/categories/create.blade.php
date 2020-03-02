<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Category</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" id="category_form" action="/categories" accept-charset="UTF-8" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="category_already_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

       
      <div class="form-line">
        <input type="text" name="category" id="category" placeholder="Category Name" onkeydown="validateCategoryExist('')">
        <span id="category-exist"></span>
        
        
      </div>

      

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>