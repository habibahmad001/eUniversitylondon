<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Quiz</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-quiz" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="exe_id" id="exe_id">
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
          <label>Quiz Title</label>
          <input type="text" name="exe_title" id="edit-exe_title" placeholder="Mock Exam Title" >
        </div>

        <div class="form-line">
          <label>Quiz Content</label>
          <textarea name="exe_content" id="edit-exe_content" placeholder="Type some description."></textarea>
        </div>

        <div class="form-line">
          <label>Quiz Duration</label>
          <input type="text" name="duration" id="edit-duration" placeholder="3 Hours" >
        </div>

        <div class="form-line">
          <label>Total Marks</label>
          <input type="text" name="total_marks" id="edit-total_marks" placeholder="100" >
        </div>

        <div class="form-line">
          <label>Passing Marks</label>
          <input type="text" name="passing_marks" id="edit-passing_marks" placeholder="40" >
        </div>

        <div class="form-line">
          @if(collect(request()->segments())->pull(1) == "mexamlisting")
            <input type="hidden" name="cour_id" value="{{ collect(request()->segments())->last() }}">
          @else
          <select name="cour_id" id="edit-cour_id" class="full-width">
            <option value="">Select Course</option>
            @if(count($Courses)) @foreach ($Courses as $course)
              <option value="{{ $course->id }}" {!! ($course->id == collect(request()->segments())->last()) ? "selected": "" !!}>{{ $course->course_title }}</option>
            @endforeach @else
              <option value="">No Course Listed</option>
            @endif
          </select>
          @endif
        </div>

       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
