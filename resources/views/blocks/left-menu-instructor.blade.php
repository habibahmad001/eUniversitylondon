<div class="left-menu">
  <ul class="">

    <li @if(collect(request()->segments())->last()=='home') class="active" @endif>
      <a href="{{ URL::to('/instructor/home') }}">
        <div class="icon">D</div>
        <div class="icon-detail">Dashboard</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='course') class="active" @endif>
      <a href="{{ URL::to('/instructor/course') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Course</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='courseprogram') class="active" @endif>
      <a href="{{ URL::to('/instructor/courseprogram') }}">
        {{--manage-rules--}}
        <div class="icon">CC</div>
        <div class="icon-detail">Section's / Units</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='assignment') class="active" @endif>
      <a href="{{ URL::to('/instructor/assignment') }}">
        {{--manage-rules--}}
        <div class="icon">A</div>
        <div class="icon-detail">Assignment</div>
      </a>
    </li>

    {{--    <li @if(collect(request()->segments())->last()=='curriculum') class="active" @endif>--}}
    {{--      <a href="{{ URL::to('/admin/curriculum') }}">--}}
    {{--        --}}{{--manage-rules--}}
    {{--        <div class="icon">CC</div>--}}
    {{--        <div class="icon-detail">Curriculum</div>--}}
    {{--      </a>--}}
    {{--    </li>--}}

    <li @if(collect(request()->segments())->last()=='exam') class="active" @endif>
      <a href="{{ URL::to('/instructor/exam') }}">
        {{--manage-rules--}}
        <div class="icon">E</div>
        <div class="icon-detail">Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='mexam') class="active" @endif>
      <a href="{{ URL::to('/instructor/mexam') }}">
        {{--manage-rules--}}
        <div class="icon">ME</div>
        <div class="icon-detail">Mock Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='questionandanswer') class="active" @endif>
      <a href="{{ URL::to('/instructor/questionandanswer') }}">
        {{--manage-rules--}}
        <div class="icon">QA</div>
        <div class="icon-detail">Question Bank</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='my_account') class="active" @endif>
      <a href="{{ URL::to('/instructor/my-account') }}">
        {{--manage-rules--}}
        <div class="icon">S</div>
        <div class="icon-detail">Settings</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='logout') class="active" @endif>
      <a href="{{ URL::to('/logout') }}">
        {{--manage-rules--}}
        <div class="icon">L</div>
        <div class="icon-detail">Logout</div>
      </a>
    </li>

  </ul>
</div>
