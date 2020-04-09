<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Assignment</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-assignment" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="a_id" id="a_id">
    <input type="hidden" id="edit-email_exist">
    <input type="hidden" name="img_path" id="img_path" value="{{URL::asset('/uploads/assignment/')}}">
    <input type="hidden" name="user_folder" id="user_folder" value="{{ collect(request()->segments())->first() }}">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="ass_title" id="edit-ass_title" placeholder="Assignment Title" >
        </div>

        <div class="form-line">
          <select name="tab_name" id="edit-tab_name" class="full-width">
            <option value="">Select Exam</option>
            <option value="Exam">Exam</option>
            <option value="MockExam">Mock Exam</option>
          </select>
        </div>

        <div class="form-line exam_div">
          <select name="exam_id" id="edit-exam_id" class="full-width">
            <option value="">Select Exam</option>
          </select>
        </div>

        <div class="form-line">
          <input type="file" name="assignment_f" id="assignment_f">
          <div id="avatar_div">
            <img src="http://via.placeholder.com/150/000000/FFFFFF/?text=File Placeholder" width="150" height="150">
          </div>
        </div>

      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
