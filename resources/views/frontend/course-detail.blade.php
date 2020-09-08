@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>{{ $course->course_title }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to('/#HomeCourses') }}">Courses</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to('/category/' . App\Http\Controllers\Category::CatID(json_decode($course->category_id)[0])->page_slug) }}">{{ App\Http\Controllers\Category::CatID(json_decode($course->category_id)[0])->category_title }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $course->course_title }}
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <form method="POST" name="prod" id="prod" action="{{ URL::to("/addcart") }}">
    <section class="ls s-pt-60 s-pb-0 s-pt-lg-100 s-pb-lg-50 c-gutter-30 c-mb-30 c-mb-lg-50 single-course">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-40">
                        {!! ($course->OfferData && (strtotime($course->EndDate) >= strtotime(Carbon\Carbon::now()))) ? '<span class="onsale">'.$course->OfferData.'% Off</span>' : '' !!}
                        <img class="w-100 rounded" src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                    </div>

                    <h2>{{ (strlen(strip_tags($course->course_title)) > 32) ? substr(strip_tags($course->course_title), 0, 32) . "..." : strip_tags($course->course_title) }}</h2>

                    {!! $course->course_desc !!}

                    <h5 class="program-title">Course Content</h5>
                    <b class="program-states">{!! count($CourseProgram) !!} sections • 08 lectures</b>
                    <div id="accordion01" role="tablist" class="course-tab bordered rounded">
                        @if(count($CourseProgram) > 0)
                            <?php $cp_count = 0; ?>
                            @foreach($CourseProgram as $val)
                                <div class="tab-padding">
                                    <div role="tab" id="collapse01_header">
                                        <h6 class="tab-header">
                                            <a class="fw-700 <?php if($cp_count == 0) echo 'collapsed'; else echo ''; ?>" data-toggle="collapse" href="#{{ $val->id }}" aria-expanded="<?php if($cp_count == 0) echo 'true'; else echo 'false'; ?>" aria-controls="{{ $val->id }}">
                                                        <span class="float-left">
                                                            {{ str_pad($val->cp_placement, 2, '0', STR_PAD_LEFT) }}
                                                        </span>
                                                {{ $val->cp_title }}
                                            </a>
                                        </h6>
                                        {{--<span class="author-course">Author courses:<a href="jascript:void(0);"> {{ $val->cp_author }}</a> </span>--}}
                                    </div>
                                    <div id="{{ $val->id }}" class="collapse <?php if($cp_count == 0) echo 'show'; else echo 'hide'; ?>" role="tabpanel" aria-labelledby="collapse01_header" data-parent="#{{ $val->id }}">
                                        <div class="card-body">
                                            {{--{!! $val->cp_desc !!}--}}
                                            {{--<div class="bodyrow">--}}
                                                {{--<div class="bodyrowItem1">--}}
                                                    {{--<a href="javascript:void(0);" data-toggle="modal" data-target="#VideoModal" class="video-link" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk"> How to Start a Successful Company + Qualities of the Top Business People</a>--}}
                                                {{--</div>--}}
                                                {{--<div class="bodyrowItem2">--}}
                                                    {{--17:58--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            @if(is_array(json_decode($val->cp_desc, true)))
                                                <?php $count = 0;?>
                                                @foreach(json_decode($val->cp_desc, true) as $v)
                                                    @if($v["Type"] == "Youtube_" . $count)
                                                        <div class="bodyrow">
                                                            <div class="bodyrowItem1">
                                                                <i class="fa fa-youtube-play" aria-hidden="true"></i> <a href="javascript:void(0);" data-toggle="modal" data-target="#YouTubeModal" class="video-link" data-src="{!! $v["Content"] !!}"> {!! $v["Title"] !!}</a>
                                                            </div>
                                                            <div class="bodyrowItem2">
                                                                {!! $v["Duration"] !!}
                                                            </div>
                                                        </div>
                                                    @elseif($v["Type"] == "Content_" . $count)
                                                        <div class="bodyrow">
                                                            <div class="bodyrowItem1">
                                                                <i class="fa fa-file-text-o" aria-hidden="true"></i> <a href="javascript:void(0);" data-toggle="modal" data-target="#ContentModal" data-id="<?=$val->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-content<?=$val->id.$count?>" style="display: none;">{!! $v["Content"] !!}</div>
                                                            </div>
                                                            <div class="bodyrowItem2">
                                                                {!! $v["Duration"] !!}
                                                            </div>
                                                        </div>
                                                    @elseif($v["Type"] == "Iframe_" . $count)
                                                        <div class="bodyrow">
                                                            <div class="bodyrowItem1">
                                                                <i class="fa fa-picture-o" aria-hidden="true"></i> <a href="javascript:void(0);" data-toggle="modal" data-target="#ContentModal" data-id="<?=$val->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-content<?=$val->id.$count?>" style="display: none;">{!! $v["Content"] !!}</div>
                                                            </div>
                                                            <div class="bodyrowItem2">
                                                                {!! $v["Duration"] !!}
                                                            </div>
                                                        </div>
                                                    @elseif($v["Type"] == "Video_" . $count)
                                                        <div class="bodyrow">
                                                            <div class="bodyrowItem1">
                                                                <i class="fa fa-video-camera" aria-hidden="true"></i> <a href="javascript:void(0);" data-toggle="modal" data-target="#VideoModal" data-id="<?=$val->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-video<?=$val->id.$count?> playedvideos" style="width: 100%; display: none;">
                                                                    <video width="100%" controls>
                                                                        <source src="{!! "/uploads/courseprogramVIDEO/" . $v["Content"] !!}" type="video/mp4">
                                                                        <source src="{!! "/uploads/courseprogramVIDEO/" . $v["Content"] !!}" type="video/ogg">
                                                                        Your browser does not support HTML video.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                            <div class="bodyrowItem2">
                                                                {!! $v["Duration"] !!}
                                                            </div>
                                                        </div>
                                                    @elseif($v["Type"] == "Image_" . $count)
                                                        <div class="bodyrow">
                                                            <div class="bodyrowItem1">
                                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> <a href="javascript:void(0);" data-toggle="modal" data-target="#IMGModal" data-id="<?=$val->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-img<?=$val->id.$count?>" style="display: none;">{!! "/uploads/courseprogramIMG/" . $v["Content"] !!}</div>
                                                            </div>
                                                            <div class="bodyrowItem2">
                                                                {!! $v["Duration"] !!}
                                                            </div>
                                                        </div>
                                                    @elseif($v["Type"] == "Quiz_" . $count)
                                                        <div class="bodyrow">
                                                            <div class="bodyrowItem1">
                                                                <i class="fa fa-pied-piper-pp" aria-hidden="true"></i> {!! $v["Title"] !!}
                                                            </div>
                                                            <div class="bodyrowItem2">
                                                                {!! $v["Duration"] !!}
                                                            </div>
                                                        </div>
                                                    @endif
                                                <?php $count++;?>
                                                @endforeach
                                            @endif
                                            {{--<div class="bodyrow">--}}
                                                {{--<div class="bodyrowItem1">--}}
                                                    {{--Chapter 1 Quiz--}}
                                                {{--</div>--}}
                                                {{--<div class="bodyrowItem2">--}}
                                                    {{--10 questions--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div><?php $cp_count++; ?>
                            @endforeach
                        @else
                            <div class="tab-padding">
                                <div id="collapse01" class="collapse show">
                                    <div class="card-body">
                                        <center>There is no program listed Yet !!!</center>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div><!-- .col-* -->
                <div class="col-lg-4">
                    <div class="mb-50">
                        <div class="vertical-item content-padding bordered border-color2 rounded">
                            <div class="item-content">
                                <div class="tagcloud">
                                    <div class="divider-48" id="itm-post-{{ $course->id }}"></div>
                                    <a href="javascript:void(0);" onclick="javascript:product_submit({{ $course->id }});" class="btn btn-maincolor">Buy Now</a>
                                </div>
                                <div class="enrolled d-flex justify-content-between">
                                    <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                        <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                    </div>
                                    <div>
                                        <p class="fw-400">
                                            {{ App\Http\Controllers\Front\CourseController::StudentCount($course->id) }} Enrolled
                                        </p>
                                    </div>
                                </div>
                                <div class="tagcloud">
                                    @if(count(json_decode($course->category_id)) > 0)
                                        @foreach(json_decode($course->category_id) as $v)
                                            <a href="/category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
                                                {{ App\Http\Controllers\Category::CatID($v)->category_title }}
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                                <table class="table-course">
                                    <tbody>
                                    <tr>
                                        <th>Lectures:</th>
                                        <td>{{ $course->course_lectures }}</td>
                                    </tr>
                                    <tr>
                                        <th>Language:</th>
                                        <td>English, France</td>
                                    </tr>
                                    <tr>
                                        <th>Video:</th>
                                        <td>{{ $course->course_video }} Hours</td>
                                    </tr>
                                    <tr>
                                        <th>Duration:</th>
                                        <td>{{ $course->course_duration }} Days</td>
                                    <tr>
                                        <th>Includes:</th>
                                        <td>{{ $course->course_includes }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row courses-item c-mb-30">
                        @if(count($AllCourse) > 0)
                            @foreach($AllCourse as $course)
                                @if(in_array("most_popular", json_decode($course->setas)))
                                    <div class="col-12 col-md-6 col-lg-12 popular">
                                        <div class="course-flip h-100">
                                            <div class="course-front bordered rounded">
                                                <div class=" vertical-item content-padding">
                                                    <div class="item-media rounded-top">
                                                        {!! ($course->OfferData && (strtotime($course->EndDate) >= strtotime(Carbon\Carbon::now()))) ? '<span class="onsale">'.$course->OfferData.'% Off</span>' : '' !!}
                                                        <img src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                                                    </div>
                                                    <div class="item-content">
                                                        <h6 class="course-title">
                                                            <a href="{{ URL::to('/course_detail/' . strtolower(str_replace(' ', '-', $course->course_title))) }}">{{ (strlen(strip_tags($course->course_title)) > 32) ? substr(strip_tags($course->course_title), 0, 32) . "..." : strip_tags($course->course_title) }}</a>
                                                        </h6>

                                                        <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                                            <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>

                                                        <div class="product-price">£{{ $course->course_price }}</div>

                                                        <div class="tagcloud">
                                                            @if(count(json_decode($course->category_id)) > 0)
                                                                @foreach(json_decode($course->category_id) as $v)
                                                                    <a href="/category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
                                                                        {{ App\Http\Controllers\Category::CatID($v)->category_title }}
                                                                    </a>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-back rounded vertical-item content-padding ds">
                                                <div class="item-content">
                                                    <h6 class="course-title">
                                                        <a href="{{ URL::to('/course_detail/' . strtolower(str_replace(' ', '-', $course->course_title))) }}">{{ (strlen(strip_tags($course->course_title)) > 32) ? substr(strip_tags($course->course_title), 0, 32) . "..." : strip_tags($course->course_title) }}</a>
                                                    </h6>
                                                    {{ (strlen(strip_tags($course->course_desc)) > 150) ? substr(strip_tags($course->course_desc), 0, 150) . "..." : strip_tags($course->course_desc) }}
                                                    <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                                        <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                                    </div>{{ csrf_field() }}
                                                    <div class="product-price">£{{ $course->course_price }}</div>
                                                    <div class="divider-48" id="itm-post-{{ $course->id }}"></div>
                                                    <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $course->course_title))) }}" class="btn btn-maincolor">View More</a>
                                                    <a href="javascript:void(0);" onclick="javascript:product_submit({{ $course->id }});" class="btn btn-maincolor">Buy Now</a>
                                                    <div class="tagcloud">
                                                        @if(count(json_decode($course->category_id)) > 0)
                                                            @foreach(json_decode($course->category_id) as $v)
                                                                <a href="/category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
                                                                    {{ App\Http\Controllers\Category::CatID($v)->category_title }}
                                                                </a>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>

    <section class="ds s-pt-60 s-pb-55 s-py-lg-100 c-gutter-50 course-bio">
        <div class="container">
            <div class="row align-items-center text-center text-lg-left">
                <div class="col-lg-4">
                    <img class="rounded" src="/images/team/single-course.jpg" alt="">
                </div>
                <div class="col-lg-8 text-center text-lg-left">
                    <div>
                        <div class="divider-20 d-block d-lg-none"></div>
                        <h4 class="fw-500">Eneida F. Withrow</h4>
                        <p class="color-dark position">Autor courses</p>
                        <p>
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren
                        </p>
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">
                                Technology
                            </a>
                            <a href="#" class="tag-cloud-link">
                                Humanities
                            </a>
                        </div>
                        <p class="social-icons">
                            <a href="#" class="fa fa-facebook fs-20" title="facebook"></a>
                            <a href="#" class="fa fa-paper-plane" title="telegram"></a>
                            <a href="#" class="fa fa-linkedin" title="linkedin"></a>
                            <a href="#" class="fa fa-instagram" title="instagram"></a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="ls s-pt-55 s-pb-60 s-pt-lg-95 s-pb-lg-100 c-gutter-50 course-comment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <h4 class="fw-500">Students also bought</h4>
                    <div class="stu-container">
                        @if(count($AllCourse) > 0)
                            @foreach($AllCourse as $course)
                                {{--@if(in_array("most_popular", json_decode($course->setas)))--}}
                                    <div class="stu-row">
                                        <div class="stu-course">
                                            <div class="stu-course-avt"><img src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" /></div>
                                            <div class="stu-course-content">
                                                <div class="stu-course-content-title"><b>{{ $course->course_title }}</b></div>
                                                <div class="stu-course-content-detail">
                                                    @if(count(json_decode($course->category_id)) > 0)
                                                        @foreach(json_decode($course->category_id) as $v)
                                                            <a href="/category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
                                                                {{ App\Http\Controllers\Category::CatID($v)->category_title }}
                                                            </a> .
                                                        @endforeach
                                                    @endif  3.5 total hours . Updated</div>
                                            </div>
                                        </div>
                                        <div class="stu-rating">{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["RateNumb"] }} <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="stu-students">65,000</div>
                                        <div class="stu-price">&pound; {{ $course->course_price }}</div>
                                    </div>
                                {{--@endif--}}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls course-comment">{{--s-pt-55 s-pb-60 s-pt-lg-95 s-pb-lg-100 c-gutter-50--}}
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-xl-8">

                    <div id="comments" class="comments-area rounded">
                        <!-- #respond -->
                        <ol class="comment-list">
                            @if(count($MainComments) > 0)
                                @foreach($MainComments as $v)
                                    <li class="comment" id="commentID{{$v->id}}">
                                        <article class="comment-body">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="" src="/images/team/testimonials_01.jpg">
                                                </div>
                                                <!-- .comment-author -->
                                                <div class="comment-name">
                                                    <span class="says">By:</span>
                                                    <b class="fn">
                                                        <a href="javascript:void(0);" rel="nofollow" class="url fw-500">{{ $v->name }}</a>
                                                    </b>
                                                    <span class="comment-metadata d-block">
                                                        <a href="javascript:void(0);">
                                                            <time datetime="2019-03-14T08:01:21+00:00">
                                                                <div class="star-rating course-rating" style="margin-bottom: 0;" id="{{ App\Http\Controllers\Front\CourseController::GetStars($v->course_id)["ratingcount"] }}"><span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($v->course_id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($v->course_id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span></div> {{ Carbon\Carbon::parse($v->created_at)->format('F d, h:ia') }}
                                                            </time>
                                                        </a>
                                                    </span>
                                                    <!-- .comment-metadata -->
                                                </div>
                                            </footer>
                                            <!-- .comment-meta -->
                                            <div class="comment-content">
                                                <p>
                                                    {!! $v->ccomment !!}
                                                </p>
                                            </div>
                                            {{--<div class="d-flex justify-content-between">--}}
                                                {{--<div>--}}
                                                    {{--<span class="like">--}}
                                                        {{--<a class="like-link fw-500" href="javascript:void(0);" onclick="javascript:likeit({{ $v->id }});" aria-label="Reply to {{ $v->name }}">Like</a>--}}
                                                    {{--</span>--}}
                                                    {{--<span class="reply">--}}
                                                        {{--<a rel="nofollow" class="comment-reply-link fw-500" href="javascript:void(0);" onclick="javascript:replyit({{ $v->id }});" aria-label="Reply to {{ $v->name }}">Reply</a>--}}
                                                    {{--</span>--}}
                                                {{--</div>--}}
                                                {{--<div>--}}
                                                    {{--<span class="like-count color-dark" id="mainlike{{ $v->id }}">--}}
                                                        {{--<i class="fw-600 color-dark fa fa-heart-o"></i>--}}
                                                        {{--{{ json_decode($v->liked, true)["likes"] }}--}}
                                                    {{--</span>--}}
                                                    {{--<span class="comment-count color-dark">--}}
                                                        {{--<i class="color-dark icon-m-comment-alt"></i>--}}
                                                        {{--{{ json_decode($v->liked, true)["Comments"] }} Comment--}}
                                                    {{--</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        </article>

                                        {{--<div class="reply" id="reply{{ $v->id }}">--}}
                                            {{--<div id="respond" class="comment-respond ls d-flex">--}}
                                                {{--<form action="{{ URL::to("/storecomments") }}" method="post" id="savecomment" name="savecomment" class="comment-form" novalidate="">--}}
                                                    {{--<div class="comment-form-author form-group has-placeholder">--}}
                                                        {{--<label for="author">Name</label>--}}
                                                        {{--<input class="form-control" id="cuser" name="cuser" type="text" value="{{ (isset(Auth::user()->first_name)) ? Auth::user()->first_name . " " . Auth::user()->last_name : "" }}" size="30" maxlength="245" aria-required="true" required="required" placeholder="Name*">--}}
                                                    {{--</div>--}}
                                                    {{--<p class="comment-form-email form-group has-placeholder">--}}
                                                        {{--<label for="email">Email </label>--}}
                                                        {{--<input class="form-control" id="cemail" name="cemail" type="cemail" value="{{ isset(Auth::user()->email) ? Auth::user()->email : "" }}" size="30" maxlength="100" aria-required="true" required="required" placeholder="Email*">--}}
                                                    {{--</p>--}}
                                                    {{--<input type="hidden" name="cid" id="cid" value="{{ $course->id }}">--}}
                                                    {{--<input type="hidden" name="commentid" id="commentid" value="{{ $v->id }}">--}}
                                                    {{--<p class="comment-form-comment form-group has-placeholder">--}}
                                                        {{--<label for="comment">Comment</label>--}}
                                                        {{--<textarea class="form-control" id="ccomment" name="ccomment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Message*"></textarea>--}}
                                                    {{--</p>{{ csrf_field() }}--}}
                                                    {{--<p class="form-submit">--}}
                                                        {{--<button type="submit" class="w-100 d-block btn btn-maincolor">Send comment</button>--}}
                                                    {{--</p>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}


                                        <!-- .comment-body -->
                                        {{--<ol class="children">--}}
                                            {{--@if(count(App\Http\Controllers\Front\CourseController::GetSubComment($v->id)) > 0)--}}
                                                {{--@foreach(App\Http\Controllers\Front\CourseController::GetSubComment($v->id) as $k=>$subv)--}}
                                                    {{--<li class="comment" id="commentID{{$subv->id}}">--}}
                                                        {{--<article class="comment-body">--}}
                                                            {{--<footer class="comment-meta">--}}
                                                                {{--<div class="comment-author vcard">--}}
                                                                    {{--<img alt="" src="/images/team/testimonials_02.jpg">--}}
                                                                {{--</div>--}}
                                                                {{--<!-- .comment-author -->--}}
                                                                {{--<div class="comment-name">--}}
                                                                    {{--<span class="says">By:</span>--}}
                                                                    {{--<b class="fn">--}}
                                                                        {{--<a href="javascript:void(0);" rel="nofollow" class="url fw-500">{{ $subv->name }}</a>--}}
                                                                    {{--</b>--}}
                                                                    {{--<span class="comment-metadata d-block">--}}
                                                                        {{--<a href="javascript:void(0);">--}}
                                                                            {{--<time datetime="2019-03-14T08:01:21+00:00">--}}
                                                                                {{--{{ Carbon\Carbon::parse($subv->created_at)->format('F d, h:ia') }}--}}
                                                                            {{--</time>--}}
                                                                        {{--</a>--}}
                                                                    {{--</span>--}}
                                                                    {{--<!-- .comment-metadata -->--}}
                                                                {{--</div>--}}
                                                            {{--</footer>--}}
                                                            {{--<!-- .comment-meta -->--}}
                                                            {{--<div class="comment-content">--}}
                                                                {{--<p>{!! $subv->message !!}</p>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="d-flex justify-content-between">--}}
                                                                {{--<div>--}}
                                                                    {{--<span class="like">--}}
                                                                        {{--<a class="like-link fw-500" href="javascript:void(0);" onclick="javascript:likeit({{ $subv->id }});" aria-label="Reply to {{ $subv->name }}">Like</a>--}}
                                                                    {{--</span>--}}
{{--                                                                    <span class="reply">--}}
{{--                                                                        <a rel="nofollow" class="comment-reply-link fw-500" href="#comments" aria-label="Reply to {{ $subv->name }}">Reply</a>--}}
{{--                                                                    </span>--}}
                                                                {{--</div>--}}
                                                                {{--<div>--}}
                                                                    {{--<span class="like-count color-dark" id="mainlike{{ $subv->id }}">--}}
                                                                        {{--<i class="fw-600 color-dark fa fa-heart-o"></i>--}}
                                                                        {{--{{ json_decode($subv->liked, true)["likes"] }}--}}
                                                                    {{--</span>--}}
                                                                    {{--<span class="comment-count color-dark">--}}
                                                                        {{--<i class="color-dark icon-m-comment-alt"></i>--}}
                                                                        {{--{{ json_decode($subv->liked, true)["Comments"] }} Comment--}}
                                                                    {{--</span>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</article>--}}
                                                        {{--<!-- .comment-body -->--}}
                                                    {{--</li>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</ol>--}}
                                        <!-- .children -->
                                </li>
                                @endforeach
                            @endif
                            <!-- #comment-## -->
                        </ol>
                        <!-- .comment-list -->

                    </div>


                </div>
            </div>
        </div>
    </section>

    <section class="ls course-comment">{{--s-pt-55 s-pb-60 s-pt-lg-95 s-pb-lg-100 c-gutter-50--}}
        <div class="container">
            <div class="row instructore-more-course">
                <h4 class="fw-500">More Courses by Eneida F. Withrow</h4>
            </div>
            <div class="row writer-card">
                <div class="col-lg-3 col-xl-3">
                    <img src="http://127.0.0.1:8000/uploads/pavatar/269687077.jpg" width="300" height="300" />
                    <div class="writer-content">
                        <b>The Complete Financial Analyst Training & Investing Course Chris Haroun</b>
                        <div class="writer-rate">Rating: 4.5 out of 5
                            4.5
                            (20,960)</div>
                        <div class="writer-hours">22.5 total hours . 225 lectures</div>
                        <div class="writer-levels">. All Levels</div>
                        <div class="writer-price">&pound; 88</div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <img src="http://127.0.0.1:8000/uploads/pavatar/1287658438.jpg" width="300" height="300" />
                    <div class="writer-content">
                        <b>The Complete Financial Analyst Training & Investing Course Chris Haroun</b>
                        <div class="writer-rate">Rating: 4.5 out of 5
                            4.5
                            (20,960)</div>
                        <div class="writer-hours">22.5 total hours . 225 lectures</div>
                        <div class="writer-levels">. All Levels</div>
                        <div class="writer-price">&pound; 22</div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <img src="http://127.0.0.1:8000/uploads/pavatar/401966259.jpg" width="300" height="300" />
                    <div class="writer-content">
                        <b>The Complete Financial Analyst Training & Investing Course Chris Haroun</b>
                        <div class="writer-rate">Rating: 4.5 out of 5
                            4.5
                            (20,960)</div>
                        <div class="writer-hours">22.5 total hours . 225 lectures</div>
                        <div class="writer-levels">. All Levels</div>
                        <div class="writer-price">&pound; 99</div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <img src="http://127.0.0.1:8000/uploads/pavatar/8589637.jpg" width="300" height="300" />
                    <div class="writer-content">
                        <b>The Complete Financial Analyst Training & Investing Course Chris Haroun</b>
                        <div class="writer-rate">Rating: 4.5 out of 5
                            4.5
                            (20,960)</div>
                        <div class="writer-hours">22.5 total hours . 225 lectures</div>
                        <div class="writer-levels">. All Levels</div>
                        <div class="writer-price">&pound; 33</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="YouTubeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Video Modal -->



    <!-------------- Iframe Modal ------------>
    <div class="modal fade" id="IMGModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 600px; height: 650px">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9" style="height: 650px">
                        <iframe src="" class="puiframe" style="width:600px; height:650px;" frameborder="0"></iframe>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-------------- Iframe Modal ------------>

    <!-------------- Video Modal ------------>
    {{--<div class="modal fade" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}


                {{--<div class="modal-body">--}}

                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                    {{--<!-- 16:9 aspect ratio -->--}}
                    {{--<div class="embed-responsive embed-responsive-16by9 vm">--}}

                    {{--</div>--}}


                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!-------------- Video Modal ------------>

    <!-- --------------- Content Model ------------------- -->
    <div class="modal fade" id="ContentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body popup-data-div">

                </div>
                <div class="modal-footer">
                    {{--<button type="button" name="RConfirmBTN" id="RConfirmBTN" data-key="0" class="btn btn-primary">Confirm</button>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- --------------- Content Model ------------------- -->

@endsection