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
          <label>Section Title</label>
          <input type="text" name="title" id="edit-title" placeholder="Section Title" >
        </div>

        <div class="form-line">
          <label>Section Order</label>
          <input type="number" name="placement" id="edit-placement" min="1" max="1000" placeholder="Section Order" >
        </div>

        @if(collect(request()->segments())->pull(1) == "cplisting")
          <input type="hidden" name="cour_id" id="cour_id" value="{{ collect(request()->segments())->last() }}" />
        @else
          <div class="form-line">
            <label>Select Course</label>
            <select name="cour_id" id="edit-cour_id" class="full-width">
              <option value="">Select Course</option>
              @if(count($Courses)) @foreach ($Courses as $course)
                <option value="{{ $course->id }}">{{ $course->course_title }}</option>
              @endforeach @else
                <option value="">No Course Listed</option>
              @endif
            </select>
          </div>
        @endif

        {{--<div class="form-line">--}}
          {{--<label>PDF</label>--}}
          {{--<input type="file" name="cou_pdf" id="edit-cou_pdf">--}}
          {{--<div id="edit-pdf_div">--}}
            {{--<img src="{{ asset('/images/pdficon.png' ) }}" width="150" height="150">--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-line">--}}
          {{--<label>Document</label>--}}
          {{--<input type="file" name="cou_doc" id="edit-cou_doc"><br />--}}
          {{--<div id="edit-doc_div">--}}
            {{--<img src="{{ asset('/images/word-icon.png' ) }}" width="150" height="150">--}}
          {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-line">--}}
          {{--<label>ZIP Upload</label>--}}
          {{--<input type="file" name="cou_zip" id="edit-cou_zip"><br />--}}
          {{--<div id="edit-zip_div">--}}
            {{--<img src="{{ asset('/images/zip-icon.png' ) }}" width="150" height="150">--}}
          {{--</div>--}}
        {{--</div>--}}
       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
