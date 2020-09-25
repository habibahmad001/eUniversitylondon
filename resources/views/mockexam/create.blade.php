<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Mock Exam</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/mexam_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <label>Mock Exam Title</label>
        <input type="text" name="exe_title" id="exe_title" placeholder="Mock Exam Title" >
      </div>

      <div class="form-line">
        <label>Mock Exam Content</label>
        <textarea name="exe_content" id="exe_content" placeholder="Type some description."></textarea>
      </div>

      <div class="form-line">
        <label>Mock Exam Duration</label>
        <input type="text" name="duration" id="duration" placeholder="3 Hours" >
      </div>

      <div class="form-line">
        <label>Total Marks</label>
        <input type="text" name="total_marks" id="total_marks" placeholder="100" >
      </div>

      <div class="form-line">
        <label>Passing Marks</label>
        <input type="text" name="passing_marks" id="passing_marks" placeholder="40" >
      </div>

      <div class="form-line">
        @if(collect(request()->segments())->pull(1) == "mexamlisting")
          <input type="hidden" name="cour_id" value="{{ collect(request()->segments())->last() }}">
        @else
          <select name="cour_id" id="cour_id" class="full-width">
            <option value="">Select Course</option>
            @if(count($Courses)) @foreach ($Courses as $course)
              <option value="{{ $course->id }}">{{ $course->course_title }}</option>
            @endforeach @else
              <option value="">No Course Listed</option>
            @endif
          </select>
        @endif
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>