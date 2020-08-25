<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Assignment</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/assignment_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <label>Title</label>
        <input type="text" name="ass_title" id="ass_title" placeholder="Assignment Title" >
      </div>

      <div class="form-line">
        <label>Content</label>
        <textarea name="contents" id="contents" placeholder="Type some description."></textarea>
      </div>

      {{--<div class="form-line">--}}
        {{--<label>Exam Type</label>--}}
        {{--<select name="tab_name" id="tab_name" class="full-width">--}}
          {{--<option value="">Select Exam</option>--}}
          {{--<option value="Exam">Exam</option>--}}
          {{--<option value="MockExam">Mock Exam</option>--}}
        {{--</select>--}}
      {{--</div>--}}

      {{--<div class="form-line exam_div">--}}
        {{--<label>Exam</label>--}}
        {{--<select name="exam_id" id="exam_id" class="full-width">--}}
          {{--<option value="">Select Exam</option>--}}
        {{--</select>--}}
      {{--</div>--}}

      <div class="form-line">
        <label>Course</label>
        <select name="cour_id" id="cour_id" class="full-width">
          <option value="">Select Course</option>
          @if(count($Courses)) @foreach ($Courses as $course)
            <option value="{{ $course->id }}">{{ $course->course_title }}</option>
          @endforeach @else
            <option value="">No Course Listed</option>
          @endif
        </select>
      </div>

      <div class="form-line">
        <input type="file" name="assignment_f" id="assignment_f">
        <div id="avatar_div">
          {{--<a href="javascript:void(0);"><img src="{{ asset('images/excel-icon.png') }}" width="150" height="150"></a>--}}
        </div>
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>