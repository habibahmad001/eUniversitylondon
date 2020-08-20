<!-- Add form -->
<div class="add-new-form spacialOffer">
  <div class="form-header">
    <h3>Apply Discount</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/applyoffer" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <input type="hidden" name="puser_folder" id="app_puser_folder" value="{{ collect(request()->segments())->first() }}">
    <input type="hidden" name="app_cou_id" id="app_cou_id">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <div class="input-group mb-3" style="width: 100%">
          <label class="sr-only" for="offer">Offer Data</label>
          <div class="input-group-addon" style="width: 11%; height: 34px; padding-top: 10px;">
            <span class="input-group-text" id="basic-addon1">%</span>
          </div>
          <input type="text" class="form-control" name="offer" style="width: 70%" id="offer" placeholder="20" aria-label="offer" aria-describedby="basic-addon1">
        </div>
      </div>

      <div class="form-line">
        <input type="text" name="startdate" id="startdate" class="form-control" placeholder="Start date" >
      </div>

      <div class="form-line">
        <input type="text" name="enddate" id="enddate" class="form-control" placeholder="End Date" >
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>