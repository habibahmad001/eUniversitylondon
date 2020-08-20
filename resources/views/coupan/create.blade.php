<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Coupan</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/coupan_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="title" id="title" placeholder="Promo code" >
      </div>

      <div class="form-line">
        <textarea name="ccomments" id="ccomments" placeholder="Type some description."></textarea>
      </div>

      <div class="form-line">
        <input type="text" name="startsFrom" id="startsFrom" placeholder="From" >
      </div>

      <div class="form-line">
        <input type="text" name="endsTo" id="endsTo" placeholder="To" >
      </div>

      <div class="form-line">
        <input type="text" name="value" id="value" placeholder="Value">
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>