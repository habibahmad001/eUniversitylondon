<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Course Program</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/courseprogram_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="title" id="title" placeholder="Course Curriculum Title" >
      </div>

      <div class="form-line">
        <textarea name="desc" id="desc" placeholder="Type some description."></textarea>
      </div>

      <div class="form-line">
        <input type="text" name="author" id="author" placeholder="Author" >
      </div>

      <div class="form-line">
        <input type="number" name="placement" id="placement" min="1" max="1000" >
      </div>
      
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
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>