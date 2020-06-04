<style>
  .iconpicker-popover.popover.fade.bottom.in {
    z-index: 999;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Topics</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/admin/update-cmstopics" onSubmit="return validate('edit-');">
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
          <input type="text" name="tns_title" id="edit-tns_title" placeholder="Topics Title" >
        </div>

        <div class="form-line">
          <input class="icp selecticon" placeholder="Select Icon" name="iconval" id="edit-iconval" type="text">
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
<script language="javascript">
  $('.selecticon').iconpicker({
    hideOnSelect: true,
    inputSearch: true,
  });
</script>