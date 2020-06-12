<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Course</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-course" enctype="multipart/form-data" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cou_id" id="cou_id">
    <input type="hidden" name="img_path" id="img_path" value="{{URL::asset('/uploads/pavatar/')}}">
    <input type="hidden" name="user_folder" id="user_folder" value="{{ collect(request()->segments())->first() }}">
    <input type="hidden" id="edit-email_exist">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        <div class="form-line">
          <input type="text" name="cou_title" id="edit-cou_title" placeholder="Course Title" >
        </div>

        <div class="form-line">
          <textarea name="cou_desc" id="edit-cou_desc" placeholder="Type some description."></textarea>
        </div>

        <div class="form-line">
          <input type="text" name="cou_lectures" id="edit-cou_lectures" placeholder="Lectures e.g(30 Lectures)" >
        </div>

        <div class="form-line">
          <select name="cou_language[]" id="edit-cou_language" class="form-control"  multiple>
            <option value="english">English</option>
            <option value="france">France</option>
          </select>
        </div>

        <div class="form-line">
          <input type="text" name="cou_video" id="edit-cou_video" placeholder="Video Hours e.g (8 Hours)" >
        </div>

        <div class="form-line">
          <input type="text" name="cou_duration" id="edit-cou_duration" placeholder="Course Duration e.g (20 Days)" >
        </div>

        <div class="form-line">
          <input type="text" name="cou_includes" id="edit-cou_includes" placeholder="Course Includes e.g (Personal support)" >
        </div>

        <div class="form-line">
          <input type="text" name="youtube" id="edit-youtube" placeholder="YouTube Video Link" >
        </div>

        <div class="form-line">
          <input type="text" name="cou_price" id="edit-cou_price" placeholder="Course Price" >
        </div>

        <div class="form-line">
          <input type="text" name="cou_discounted_price" id="edit-cou_discounted_price" placeholder="Course Discounted Price" >
        </div>

        <div class="form-line">
          <select name="cou_category[]" id="edit-cou_category" class="form-control"  multiple>
            @if(count($Category)) @foreach ($Category as $cat) @if($cat->category_cid == 0)
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

        <div class="form-line">
          <input type="file" name="cou_pdf" id="edit-cou_pdf">
          <div id="edit-pdf_div">
            <img src="{{ asset('/images/pdficon.png' ) }}" width="150" height="150">
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
