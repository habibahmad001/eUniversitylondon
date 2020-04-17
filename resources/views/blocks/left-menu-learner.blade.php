<div class="left-menu">
  <ul class="">

    <li @if(collect(request()->segments())->last()=='home') class="active" @endif>
      <a href="{{ URL::to('/learner/home') }}">
        <div class="icon">D</div>
        <div class="icon-detail">Dashboard</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='course') class="active" @endif>
      <a href="{{ URL::to('/learner/course') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Course</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='mexam') class="active" @endif>
      <a href="{{ URL::to('/learner/mexam') }}">
        {{--manage-rules--}}
        <div class="icon">ME</div>
        <div class="icon-detail">Mock Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='exam') class="active" @endif>
      <a href="{{ URL::to('/learner/exam') }}">
        {{--manage-rules--}}
        <div class="icon">E</div>
        <div class="icon-detail">Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='assignment') class="active" @endif>
      <a href="{{ URL::to('/learner/assignment') }}">
        {{--manage-rules--}}
        <div class="icon">A</div>
        <div class="icon-detail">Assignment</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='my_account') class="active" @endif>
      <a href="{{ URL::to('/learner/my-account') }}">
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
