<div class="left-menu">
  <ul class="">

    <li @if(collect(request()->segments())->last()=='home') class="active" @endif>
      <a href="{{ URL::to('/home') }}">
        <div class="icon">U</div>
        <div class="icon-detail">Dashboard</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='users') class="active" @endif>
      <a href="{{ URL::to('/users') }}">
        <div class="icon">U</div>
        <div class="icon-detail">Users</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='instructor') class="active" @endif>
      <a href="{{ URL::to('/instructor') }}">
        <div class="icon">I</div>
        <div class="icon-detail">Instructor</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='learner') class="active" @endif>
      <a href="{{ URL::to('/learner') }}">
        {{--manage-rules--}}
        <div class="icon">L</div>
        <div class="icon-detail">Learner</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='category') class="active" @endif>
      <a href="{{ URL::to('/category') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Categories</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='course') class="active" @endif>
      <a href="{{ URL::to('/course') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Course</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='curriculum') class="active" @endif>
      <a href="{{ URL::to('/curriculum') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Curriculum</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='mexam') class="active" @endif>
      <a href="{{ URL::to('/mexam') }}">
        {{--manage-rules--}}
        <div class="icon">ME</div>
        <div class="icon-detail">Mock Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='exam') class="active" @endif>
      <a href="{{ URL::to('/exam') }}">
        {{--manage-rules--}}
        <div class="icon">E</div>
        <div class="icon-detail">Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='cms') class="active" @endif>
      <a href="{{ URL::to('/cms') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">CMS</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='orders') class="active" @endif>
      <a href="{{ URL::to('/orders') }}">
        {{--manage-rules--}}
        <div class="icon">O</div>
        <div class="icon-detail">Orders</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='termservices') class="active" @endif>
      <a href="{{ URL::to('/termservices') }}">
        {{--manage-rules--}}
        <div class="icon">TS</div>
        <div class="icon-detail">Term & Services</div>
      </a>
    </li>

  </ul>
</div>
