<link rel="stylesheet" href="https//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Coupan</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-coupan" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="c_id" id="c_id">
    <input type="hidden" id="edit-email_exist">
    <input type="hidden" name="user_folder" id="user_folder" value="{{ collect(request()->segments())->first() }}">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="title" id="edit-title" placeholder="Promo code" >
        </div>

        <div class="form-line">
          <textarea name="ccomments" id="edit-ccomments" placeholder="Type some description."></textarea>
        </div>

        <div class="form-line">
          <input type="text" name="startsFrom" id="edit-startsFrom" placeholder="From" >
        </div>

        <div class="form-line">
          <input type="text" name="endsTo" id="edit-endsTo" placeholder="To" >
        </div>

        <div class="form-line">
          <input type="text" name="value" id="edit-value" placeholder="Value">
        </div>


      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
