<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Exam</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{!! collect(request()->segments())->first() !!}/{!! (collect(request()->segments())->pull(1) == "examlisting") ? "selected_exam_add" : "exam_add"!!}" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    @if(collect(request()->segments())->pull(1) == "examlisting")
      <input type="hidden" id="cid" name="cid" value="{{ collect(request()->segments())->pull(2) }}">
    @endif
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="exe_title" id="exe_title" placeholder="Exam Title" >
      </div>

      <div class="form-line">
        <textarea name="exe_content" id="exe_content" placeholder="Type some description."></textarea>
      </div>
      @if(collect(request()->segments())->pull(1) != "examlisting")
      <div class="form-line">
        <select name="cour_id" id="cour_id" class="half-width">
          <option value="">Select Course</option>
          @if(count($Courses)) @foreach ($Courses as $course)
            <option value="{{ $course->id }}">{{ $course->course_title }}</option>
          @endforeach @else
            <option value="">No Course Listed</option>
          @endif
        </select>
      </div>
      @endif

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>