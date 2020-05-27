<div class="left-menu">
  <ul class="">

    <li @if(collect(request()->segments())->last()=='home') class="active" @endif>
      <a href="{{ URL::to('/admin/home') }}">
        <div class="icon">D</div>
        <div class="icon-detail">Dashboard</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='users') class="active" @endif>
      <a href="{{ URL::to('/admin/users') }}">
        <div class="icon">U</div>
        <div class="icon-detail">Users</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='instructor') class="active" @endif>
      <a href="{{ URL::to('/admin/instructor') }}">
        <div class="icon">I</div>
        <div class="icon-detail">Instructor</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='learner') class="active" @endif>
      <a href="{{ URL::to('/admin/learner') }}">
        {{--manage-rules--}}
        <div class="icon">L</div>
        <div class="icon-detail">Learner</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='category') class="active" @endif>
      <a href="{{ URL::to('/admin/category') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Categories</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='course') class="active" @endif>
      <a href="{{ URL::to('/admin/course') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">Course</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='courseprogram') class="active" @endif>
      <a href="{{ URL::to('/admin/courseprogram') }}">
        {{--manage-rules--}}
        <div class="icon">CP</div>
        <div class="icon-detail">Course Program</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='curriculum') class="active" @endif>
      <a href="{{ URL::to('/admin/curriculum') }}">
        {{--manage-rules--}}
        <div class="icon">CC</div>
        <div class="icon-detail">Curriculum</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='exam') class="active" @endif>
      <a href="{{ URL::to('/admin/exam') }}">
        {{--manage-rules--}}
        <div class="icon">E</div>
        <div class="icon-detail">Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='mexam') class="active" @endif>
      <a href="{{ URL::to('/admin/mexam') }}">
        {{--manage-rules--}}
        <div class="icon">ME</div>
        <div class="icon-detail">Mock Exams</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='questionandanswer') class="active" @endif>
      <a href="{{ URL::to('/admin/questionandanswer') }}">
        {{--manage-rules--}}
        <div class="icon">QA</div>
        <div class="icon-detail">Question & Ans</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='testimonial') class="active" @endif>
      <a href="{{ URL::to('/admin/testimonial') }}">
        {{--manage-rules--}}
        <div class="icon">T</div>
        <div class="icon-detail">Testimonial</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='client') class="active" @endif>
      <a href="{{ URL::to('/admin/client') }}">
        {{--manage-rules--}}
        <div class="icon">OC</div>
        <div class="icon-detail">Our Clients</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='cms') class="active" @endif>
      <a href="{{ URL::to('/admin/cms') }}">
        {{--manage-rules--}}
        <div class="icon">C</div>
        <div class="icon-detail">CMS</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='orders') class="active" @endif>
      <a href="{{ URL::to('/admin/orders') }}">
        {{--manage-rules--}}
        <div class="icon">O</div>
        <div class="icon-detail">Orders</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='termservices') class="active" @endif>
      <a href="{{ URL::to('/admin/termservices') }}">
        {{--manage-rules--}}
        <div class="icon">TS</div>
        <div class="icon-detail">Term & Services</div>
      </a>
    </li>

  </ul>
</div>
