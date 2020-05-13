<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Course Program</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-courseprogram" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cp_id" id="cp_id">
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
          <input type="text" name="title" id="edit-title" placeholder="Course Curriculum Title" >
        </div>

        <div class="form-line">
          <textarea name="desc" id="edit-desc" placeholder="Type some description."></textarea>
        </div>

        <div class="form-line">
          <input type="text" name="author" id="edit-author" placeholder="Author" >
        </div>

        <div class="form-line">
          <input type="number" name="placement" id="edit-placement" min="1" max="1000" >
        </div>

        <div class="form-line">
          <select name="cour_id" id="edit-cour_id" class="full-width">
            <option value="">Select Course</option>
            @if(count($Courses)) @foreach ($Courses as $course)
              <option value="{{ $course->id }}">{{ $course->course_title }}</option>
            @endforeach @else
              <option value="">No Course Listed</option>
            @endif
          </select>
        </div>
        
       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
