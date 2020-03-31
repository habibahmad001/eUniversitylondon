
<div class="sub-header">
  <h2>{{ $sub_heading }}</h2>

  @if(collect(request()->segments())->pull(1) != 'students')
      <a href="javascript:void(0)" class="delete-btn">Delete</a>
  @endif

  @if(collect(request()->segments())->pull(1) == 'students' or collect(request()->segments())->pull(1) == 'childitem' or collect(request()->segments())->pull(0) == 'learner' or collect(request()->segments())->last() == 'home')
    &nbsp;
  @else
      @if(!isset($is_reload_btn))
        <div class="add-button"></div>
      @endif
  @endif

  @if($sub_heading=='Reports')
<div class="report_form">
<form style="width:50%; margin:2px auto;" method="POST" id="category_form" action="/reports" accept-charset="UTF-8" onSubmit="return validate();">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group col-sm-3">
    <div class="form-line">

   <input type="text" class="form-control" id="start_Date" name="startDate" value="{{@$start_date}}" placeholder="Start Date">

</div>
  </div>
  <div class="form-group col-sm-3">
    <div class="form-line">
    <input type="text" class="form-control" id="end_Date" value="{{@$end_Date}}" name="endDate" placeholder="End Date">
    </div>
  </div>

  <div class="form-group col-sm-3">
    <div class="form-line">
    <select class="form-control" name="sessiondate" id="sessiondate">
      <option value="">Select Session</option>
      @foreach ($sessions as $ses)
      <option value="{{ $ses->id }}" @if(session('active_session')==$ses->id) selected  @endif>{{ Carbon\Carbon::parse($ses->start_date)->format('M') }}-{{ Carbon\Carbon::parse($ses->end_date)->format('M') }}-{{ Carbon\Carbon::parse($ses->end_date)->format('Y') }}</option>
      @endforeach
    </select>
    </div>
  </div>

  <div class="form-group col-sm-3">
    <input type="Submit" class="form-control btn-success" value="Submit">
  </div>
<div class="clearfix"></div>
</form>
</div>
  @endif


</div>
