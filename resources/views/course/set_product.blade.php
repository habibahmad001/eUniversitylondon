<!-- Add form -->
<div class="add-new-form set-product">
  <div class="form-header">
    <h3>Set Product As</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/setproduct" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <input type="hidden" name="puser_folder" id="puser_folder" value="{{ collect(request()->segments())->first() }}">
    <input type="hidden" name="p_cou_id" id="p_cou_id">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <select name="set_p[]" id="set_p" class="form-control"  multiple>
            <option value="most_popular">Most Popular</option>
            <option value="most_recent">Most Recent</option>
            <option value="most_certified">Most Certified</option>
        </select>
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>