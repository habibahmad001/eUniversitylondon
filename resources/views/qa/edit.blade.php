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

        <div class="form-line">
          <input type="text" name="qa_title" id="edit-qa_title" placeholder="Title" >
        </div>

        <div class="form-line">
          <textarea name="qa_content" id="edit-qa_content" placeholder="Type some description."></textarea>
        </div>

        <div class="form-line">
          <input type="checkbox" name="child" id="edit-child" >&nbsp;&nbsp;&nbsp; Is Answer
        </div>

        <div class="form-line" id="edit-category_div">
          <select name="sel_txt" id="edit-sel_txt" class="half-width">
            <option value="0">Select Questions</option>
            @if(count($QandAALL)) @foreach ($QandAALL as $qa)
              <option value="{{ $qa->id }}">{{ $qa->qa_title }}</option>
              @endforeach @else
              <option value="">No Question Listed</option>
            @endif
          </select>
        </div>

        <div class="form-line exm_table" id="edit-exm_table">
          <select name="sel_table" id="edit-sel_table" class="half-width">
            <option value="0">Select Exam Type</option>
            <option value="Exam">Exam</option>
            <option value="MockExam">Mock Exam</option>
          </select>
        </div>

        <div class="form-line exm_table" id="edit-exm_item" style="display: none;">
          <select name="sel_ex_id" id="sel_ex_id" class="half-width">
            <option value="0">Select Exam</option>
            @if(count($ExamList)) @foreach ($ExamList as $el)
              <option value="{{ $el->id }}">{{ $el->exam_title }}</option>
            @endforeach @else
              <option value="">No Question Listed</option>
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
