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

{{--    <li @if(collect(request()->segments())->last()=='instructor') class="active" @endif>--}}
{{--      <a href="{{ URL::to('/admin/instructor') }}">--}}
{{--        <div class="icon">I</div>--}}
{{--        <div class="icon-detail">Instructor</div>--}}
{{--      </a>--}}
{{--    </li>--}}

    <li class="outer-menu {!! (collect(request()->segments())->last()=='course' || collect(request()->segments())->last()=='courseprogram' || collect(request()->segments())->last()=='exam' || collect(request()->segments())->last()=='mexam') ? "active" : "" !!}">
      <a href="javascript:void(0);">
        <div class="icon">L</div>
        <div class="icon-detail">LMS</div>
      </a>
      <ul class="inner-menu" {!! (collect(request()->segments())->last()=='course' || collect(request()->segments())->last()=='category' || collect(request()->segments())->last()=='courseprogram' || collect(request()->segments())->last()=='exam' || collect(request()->segments())->last()=='mexam') ? "style='display: block'" : "" !!}>
        <li>
          <a href="{{ URL::to('/admin/course') }}">
            <div class="icon-detail"><i class="fa fa-globe" aria-hidden="true"></i> Course</div>
          </a>
          <a href="{{ URL::to('/admin/category') }}">
            <div class="icon-detail"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Categories</div>
          </a>
          <a href="{{ URL::to('/admin/courseprogram') }}">
            <div class="icon-detail"><i class="fa fa-underline" aria-hidden="true"></i> Sections / Units</div>
          </a>
          <a href="{{ URL::to('/admin/exam') }}">
            <div class="icon-detail"><i class="fa fa-file-text-o" aria-hidden="true"></i> Exams</div>
          </a>
          <a href="{{ URL::to('/admin/mexam') }}">
            <div class="icon-detail"><i class="fa fa-file-text" aria-hidden="true"></i> Mock Exams</div>
          </a>
          <a href="{{ URL::to('/admin/quiz') }}">
            <div class="icon-detail"><i class="fa fa-pied-piper-pp" aria-hidden="true"></i> Quiz's</div>
          </a>
          <a href="javascript:void(0);">
            <div class="icon-detail"><i class="fa fa-shield" aria-hidden="true"></i> Certificates</div>
          </a>
        </li>
      </ul>
    </li>

    <li @if(collect(request()->segments())->last()=='questionandanswer') class="active" @endif>
      <a href="{{ URL::to('/admin/questionandanswer') }}">
        {{--manage-rules--}}
        <div class="icon">QA</div>
        <div class="icon-detail">Question Bank</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='assignment') class="active" @endif>
      <a href="{{ URL::to('/admin/assignment') }}">
        {{--manage-rules--}}
        <div class="icon">A</div>
        <div class="icon-detail">Assignment</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='cms') class="active" @endif>
      <a href="{{ URL::to('/admin/cms') }}">
        {{--manage-rules--}}
        <div class="icon">P</div>
        <div class="icon-detail">Pages</div>
      </a>
    </li>

    <li class="outer-menu {{ (collect(request()->segments())->last()=='areports' || collect(request()->segments())->last()=='ireports') ? "active" : "" }}">
      <a href="javascript:void(0);">
        <div class="icon">R</div>
        <div class="icon-detail">Reports</div>
      </a>
      <ul class="inner-menu" {!! (collect(request()->segments())->last()=='areports' || collect(request()->segments())->last()=='ireports') ? "style='display: block'" : "" !!}>
        <li>
          <a href="{{ URL::to('/admin/areports') }}">
            <div class="icon-detail">Admin revenue</div>
          </a>
          <a href="{{ URL::to('/admin/ireports') }}">
            <div class="icon-detail">Instructor revenue</div>
          </a>
        </li>
      </ul>
    </li>

    <li @if(collect(request()->segments())->last()=='comment') class="active" @endif>
      <a href="{{ URL::to('/admin/comment') }}">
{{--        manage-rules--}}
        <div class="icon">R</div>
        <div class="icon-detail">Reviews</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='coupan') class="active" @endif>
      <a href="{{ URL::to('/admin/coupan') }}">
        {{--manage-rules--}}
        <div class="icon">PC</div>
        <div class="icon-detail">Promo code</div>
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

    <li @if(collect(request()->segments())->last()=='orders') class="active" @endif>
      <a href="{{ URL::to('/admin/orders') }}">
        {{--manage-rules--}}
        <div class="icon">O</div>
        <div class="icon-detail">Orders</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='topics') class="active" @endif>
      <a href="{{ URL::to('/admin/topics') }}">
        {{--manage-rules--}}
        <div class="icon">TS</div>
        <div class="icon-detail">Topics</div>
      </a>
    </li>

    <li @if(collect(request()->segments())->last()=='teams') class="active" @endif>
      <a href="{{ URL::to('/admin/teams') }}">
        {{--manage-rules--}}
        <div class="icon">T</div>
        <div class="icon-detail">Teams</div>
      </a>
    </li>

  </ul>
</div>
