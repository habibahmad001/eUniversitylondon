<!-- Add form -->
<div class="add-new-form add-new-data">
  <div class="form-header">
    <h3>Create New Course</h3>
    <div class="close-icon"></div>
  </div>
  <form method="POST" action="/{{ collect(request()->segments())->first() }}/course_add" enctype="multipart/form-data" onSubmit="return validate('');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="email_exist">
    <div class="form-height-control">
      <div style="color:red" id="form-errors">
      </div>

      <div class="form-line">
        <input type="text" name="cou_title" id="cou_title" placeholder="Course Title" >
      </div>

      <div class="form-line">
        <textarea name="cou_desc" id="cou_desc" placeholder="Type some description."></textarea>
      </div>

      <div class="form-line">
        <textarea name="cou_company" id="cou_company" placeholder="Type Company by text."></textarea>
      </div>

      <div class="form-line">
        <textarea name="cou_what_you_learn" id="cou_what_you_learn" placeholder="Type What you learn text."></textarea>
      </div>

      <div class="form-line">
        <textarea name="cou_includes" id="cou_includes" placeholder="Type Course includes."></textarea>
      </div>

      <div class="form-line">
        <textarea name="cou_requirements" id="cou_requirements" placeholder="Type Course requriments."></textarea>
      </div>

      <div class="form-line">
        <textarea name="cou_course_for" id="cou_course_for" placeholder="Type Course for text."></textarea>
      </div>

      <div class="form-line">
        <input type="text" name="cou_price" id="cou_price" placeholder="Course Price" >
      </div>

      <div class="form-line">
        <input type="text" name="cou_discounted_price" id="cou_discounted_price" placeholder="Course Discounted Price" >
      </div>

      <div class="form-line">
        <select name="cou_category" id="cou_category" class="half-width">
          <option value="">Select Category</option>
          @if(count($Category)) @foreach ($Category as $cat) @if($cat->category_cid == NULL)
            <option value="{{ $cat->id }}">{{ $cat->category_title }}</option>
          @endif @endforeach @else
            <option value="0">No Category</option>
          @endif
        </select>
      </div>

      <div class="form-line">
        <input type="file" name="cou_avatar" id="cou_avatar">
        <div id="avatar_div">
          <img src="http://via.placeholder.com/150x150" width="150" height="150">
        </div>
      </div>

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>