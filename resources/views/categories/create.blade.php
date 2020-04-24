<!-- Add form -->
<style>
  #category_div {
    display: none;
  }
  .iconpicker-popover.popover.fade.bottom.in {
    z-index: 999;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Category</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/admin/category_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="cat_title" id="cat_title" placeholder="Category Title" >
      </div>

      <div class="form-line">
        <input class="icp selecticon" placeholder="Select Icon" name="iconval" id="iconval" type="text">
      </div>

      <div class="form-line">
        <textarea name="c_content" id="c_content" placeholder="Type some description."></textarea>
      </div>

      <div class="form-line">
        <input type="checkbox" name="child" id="child" >&nbsp;&nbsp;&nbsp; Is Child
      </div>
      
      <div class="form-line" id="category_div">
        <select name="sel_txt" id="sel_txt" class="half-width">
            <option value="0">Select Categories</option>
          @if(count($ALLCats)) @foreach ($ALLCats as $cat)
            <option value="{{ $cat->id }}">{{ $cat->category_title }}</option>
          @endforeach @else
            <option value="">No Categories Listed</option>
          @endif
        </select>
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>
<script language="javascript">
  $('.selecticon').iconpicker({
    hideOnSelect: true,
    inputSearch: true,
  });
</script>