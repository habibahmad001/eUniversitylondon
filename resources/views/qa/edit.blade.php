<style>
  #edit-category_div {
    display: none;
  }
</style>
<div class="add-new-form edit-current-data">
  <div class="form-header">
    <h3>Edit Question & Answer</h3>
    <div class="close-icon"></div>
  </div>
  <form method="post" action="/{{ collect(request()->segments())->first() }}/update-questionandanswer" onSubmit="return validate('edit-');">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cat_id" id="cat_id">
    <input type="hidden" name="user_folder" id="user_folder" value="{{ collect(request()->segments())->first() }}">
    <input type="hidden" id="edit-email_exist">
    <div class="form-height-control">
      <div class="loading-container">
        <img src="{{asset('images/loading.gif')}}" />
      </div>
      <div style="color:red" id="form-errors">
      </div>
      <div class="form-content-box">

        @if(collect(request()->segments())->pull(1) == "childqa")
          @if(App\Http\Controllers\QandAController::QAresID(collect(request()->segments())->last())->AnsType == "Text Based")
            <div class="form-line">
              <textarea name="qa_content" id="edit-qa_content" placeholder="Type some description."></textarea>
            </div>
          @else
            <div class="form-line">
              <input type="text" name="qa_title" id="edit-qa_title" placeholder="Title" >
            </div>
          @endif
        @else
          <div class="form-line">
            <input type="text" name="qa_title" id="edit-qa_title" placeholder="Title" >
          </div>
        @endif

        @if(collect(request()->segments())->last() == 'questionandanswer' or collect(request()->segments())->pull(1) == 'questionlist')
        <div class="form-line">
          <select name="anstype" id="edit-anstype" class="full-width">
            <option value="">Select Answer Type</option>
            <option value="Multiple Selection">Multiple Selection</option>
            <option value="Chose Single Option">Chose Single Option</option>
            <option value="True False">True False</option>
            <option value="Text Based">Text Based</option>
          </select>
        </div>
        @endif

        @if(collect(request()->segments())->pull(1) == 'childqa' or collect(request()->segments())->pull(1) == 'questionlist')
          <input type="hidden" name="sel_txt" value="{{ collect(request()->segments())->pull(2) }}">
          @if(collect(request()->segments())->pull(1) == 'questionlist')
            <input type="hidden" name="page_name" value="{{ collect(request()->segments())->pull(1) }}">
            <input type="hidden" name="table_name" value="{{ collect(request()->segments())->last() }}">
          @endif
        @else
          <div class="form-line">
            <input type="checkbox" name="child" id="edit-child" >&nbsp;&nbsp;&nbsp; Is Answer
          </div>

          <div class="form-line" id="edit-category_div">
            <select name="sel_txt" id="edit-sel_txt" class="full-width">
              <option value="0">Select Questions</option>
              @if(count($QandAALL)) @foreach ($QandAALL as $qa)
                <option value="{{ $qa->id }}">{{ $qa->qa_title }}</option>
              @endforeach @else
                <option value="">No Question Listed</option>
              @endif
            </select>
          </div>

          <div class="form-line exm_table" id="edit-exm_table">
            <select name="sel_table" id="edit-sel_table" class="full-width">
              <option value="0">Select Exam Type</option>
              <option value="Exam">Exam</option>
              <option value="MockExam">Mock Exam</option>
              <option value="Quiz">Quiz</option>
            </select>
          </div>

          <div class="form-line exm_item" id="edit-exm_item" style="display: none;">
            <select name="sel_ex_id" id="edit-sel_ex_id" class="full-width">
              <option value="0">Select Exam</option>
            </select>
          </div>
        @endif
       
      </div>
    </div>
    <div class="form-footer">
      <a href="javascript:void(0)" class="cancel-button">Cancel</a>
      <input type="submit" class="save-changes disable" value="Save Changes" disabled="disabled" />
    </div>
  </form>
</div>
