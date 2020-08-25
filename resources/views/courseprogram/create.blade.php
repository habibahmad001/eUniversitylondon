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
        <label>Section Title</label>
        <input type="text" name="title" id="title" placeholder="Section Title" >
      </div>

      <div class="form-line">
        <label>Section Order</label>
        <input type="number" name="placement" id="placement" min="1" max="1000" placeholder="Section Order">
      </div>

      @if(collect(request()->segments())->pull(1) == "cplisting")
        <input type="hidden" name="cour_id" id="cour_id" value="{{ collect(request()->segments())->last() }}" />
      @else
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

      {{--<div class="form-line">--}}
        {{--<input type="file" name="cou_pdf" id="cou_pdf">--}}
        {{--<div id="pdf_div">--}}
          {{--<img src="{{ asset('/images/pdficon.png' ) }}" width="150" height="150">--}}
        {{--</div>--}}
      {{--</div>--}}

      {{--<div class="form-line">--}}
        {{--<input type="file" name="cou_doc" id="cou_doc"><br />--}}
        {{--<div id="doc_div">--}}
          {{--<img src="{{ asset('/images/word-icon.png' ) }}" width="150" height="150">--}}
        {{--</div>--}}
      {{--</div>--}}

      {{--<div class="form-line">--}}
        {{--<input type="file" name="cou_zip" id="cou_zip"><br />--}}
        {{--<div id="zip_div">--}}
          {{--<img src="{{ asset('/images/zip-icon.png' ) }}" width="150" height="150">--}}
        {{--</div>--}}
      {{--</div>--}}

    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes" value="Save Changes" />
    </div>
  </form>
</div>