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
                                <a href="javascript:void(0);">Page</a>
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
                        <img class="w-100 rounded" src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                    </div>

                    <h2>{{ (strlen(strip_tags($course->course_title)) > 32) ? substr(strip_tags($course->course_title), 0, 32) . "..." : strip_tags($course->course_title) }}</h2>

                    {!! $course->course_desc !!}

                    <h5 class="program-title">Course program</h5>

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
                                        <span class="author-course">Autor courses:<a href="jascript:void(0);"> {{ $val->cp_author }}</a> </span>
                                    </div>
                                    <div id="{{ $val->id }}" class="collapse <?php if($cp_count == 0) echo 'show'; else echo 'hide'; ?>" role="tabpanel" aria-labelledby="collapse01_header" data-parent="#{{ $val->id }}">
                                        <div class="card-body">
                                            {!! $val->cp_desc !!}
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
                                            <a href="category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
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
                                                        <img src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                                                    </div>
                                                    <div class="item-content">
                                                        <h6 class="course-title">
                                                            <a href="{{ URL::to('course_detail/' . strtolower(str_replace(' ', '-', $course->course_title))) }}">{{ (strlen(strip_tags($course->course_title)) > 32) ? substr(strip_tags($course->course_title), 0, 32) . "..." : strip_tags($course->course_title) }}</a>
                                                        </h6>

                                                        <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                                            <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>

                                                        <div class="product-price">£{{ $course->course_price }}.00</div>

                                                        <div class="tagcloud">
                                                            @if(count(json_decode($course->category_id)) > 0)
                                                                @foreach(json_decode($course->category_id) as $v)
                                                                    <a href="category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
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
                                                        <a href="{{ URL::to('course_detail/' . strtolower(str_replace(' ', '-', $course->course_title))) }}">{{ (strlen(strip_tags($course->course_title)) > 32) ? substr(strip_tags($course->course_title), 0, 32) . "..." : strip_tags($course->course_title) }}</a>
                                                    </h6>
                                                    {{ (strlen(strip_tags($course->course_desc)) > 150) ? substr(strip_tags($course->course_desc), 0, 150) . "..." : strip_tags($course->course_desc) }}
                                                    <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                                        <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                                    </div>{{ csrf_field() }}
                                                    <div class="product-price">£{{ $course->course_price }}.00</div>
                                                    <div class="divider-48" id="itm-post-{{ $course->id }}"></div>
                                                    <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $course->course_title))) }}" class="btn btn-maincolor">View More</a>
                                                    <a href="javascript:void(0);" onclick="javascript:product_submit({{ $course->id }});" class="btn btn-maincolor">Buy Now</a>
                                                    <div class="tagcloud">
                                                        @if(count(json_decode($course->category_id)) > 0)
                                                            @foreach(json_decode($course->category_id) as $v)
                                                                <a href="category/{{ App\Http\Controllers\Category::CatID($v)->page_slug }}" class="tag-cloud-link">
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
                    <img class="rounded" src="images/team/single-course.jpg" alt="">
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
                <div class="col-lg-7 col-xl-8">

                    <div id="comments" class="comments-area rounded">
                        <h5 id="reply-title" class="comment-reply-title">Leave a comment</h5>

                        <div id="respond" class="comment-respond ls d-flex">
                            <div class="form-avatar w-38 h-100">
                                <img src="images/empty-avatar.png" alt="">
                            </div>
                            <form action="http://webdesign-finder.com/" method="post" id="commentform" class="comment-form" novalidate="">
                                <div class="comment-form-author form-group has-placeholder">
                                    <label for="author">Name</label>
                                    <input class="form-control" id="author" name="author" type="text" value="" size="30" maxlength="245" aria-required="true" required="required" placeholder="Name*">
                                </div>
                                <p class="comment-form-email form-group has-placeholder">
                                    <label for="email">Email </label>
                                    <input class="form-control" id="email" name="email" type="email" value="" size="30" maxlength="100" aria-required="true" required="required" placeholder="Email*">
                                </p>

                                <p class="comment-form-comment form-group has-placeholder">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Message*"></textarea>
                                </p>
                                <p class="form-submit">
                                    <button type="button" class="w-100 d-block btn btn-maincolor">Send comment</button>
                                </p>
                            </form>
                        </div>
                        <!-- #respond -->
                        <ol class="comment-list">
                            <li class="comment">
                                <article class="comment-body">
                                    <footer class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img alt="" src="images/team/testimonials_01.jpg">
                                        </div>
                                        <!-- .comment-author -->
                                        <div class="comment-name">
                                            <span class="says">By:</span>
                                            <b class="fn">
                                                <a href="#" rel="nofollow" class="url fw-500">Keith M. Jordan</a>
                                            </b>
                                            <span class="comment-metadata d-block">
														<a href="#">
															<time datetime="2019-03-14T08:01:21+00:00">
																17 Jan, 11:32 AM
															</time>
														</a>
													</span>
                                            <!-- .comment-metadata -->
                                        </div>
                                    </footer>
                                    <!-- .comment-meta -->
                                    <div class="comment-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
													<span class="like">
														<a class="like-link fw-500" href="#" aria-label="Reply to John Doe">Like</a>
													</span>
                                            <span class="reply">
														<a rel="nofollow" class="comment-reply-link fw-500" href="#comments" aria-label="Reply to John Doe">Reply</a>
													</span>
                                        </div>
                                        <div>
													<span class="like-count color-dark">
														<i class="fw-600 color-dark fa fa-heart-o"></i>
														12
													</span>
                                            <span class="comment-count color-dark">
														<i class="color-dark icon-m-comment-alt"></i>
														1 Comment
													</span>
                                        </div>
                                    </div>
                                </article>
                                <!-- .comment-body -->
                                <ol class="children">
                                    <li class="comment">
                                        <article class="comment-body">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="" src="images/team/testimonials_02.jpg">
                                                </div>
                                                <!-- .comment-author -->
                                                <div class="comment-name">
                                                    <span class="says">By:</span>
                                                    <b class="fn">
                                                        <a href="#" rel="nofollow" class="url fw-500">John B. Lewis</a>
                                                    </b>
                                                    <span class="comment-metadata d-block">
																<a href="#">
																	<time datetime="2019-03-14T08:01:21+00:00">
																		17 Jan, 11:32 AM
																	</time>
																</a>
															</span>
                                                    <!-- .comment-metadata -->
                                                </div>
                                            </footer>
                                            <!-- .comment-meta -->
                                            <div class="comment-content">
                                                <p>
                                                    Ut wisi enim ad minim veniam, quis nostrud exerci tation. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div>
															<span class="like">
																<a class="like-link fw-500" href="#" aria-label="Reply to John Doe">Like</a>
															</span>
                                                    <span class="reply">
																<a rel="nofollow" class="comment-reply-link fw-500" href="#comments" aria-label="Reply to John Doe">Reply</a>
															</span>
                                                </div>
                                                <div>
															<span class="like-count color-dark">
																<i class="fw-600 color-dark fa fa-heart-o"></i>
																0
															</span>
                                                    <span class="comment-count color-dark">
																<i class="color-dark icon-m-comment-alt"></i>
																0 Comment
															</span>
                                                </div>
                                            </div>
                                        </article>
                                        <!-- .comment-body -->
                                    </li>
                                    <!-- #comment-## -->
                                    <li class="comment">
                                        <article class="comment-body">
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="" src="images/team/testimonials_03.jpg">
                                                </div>
                                                <!-- .comment-author -->
                                                <div class="comment-name">
                                                    <span class="says">By:</span>
                                                    <b class="fn">
                                                        <a href="#" rel="nofollow" class="url fw-500">Lani C. Duffy</a>
                                                    </b>
                                                    <span class="comment-metadata d-block">
																<a href="#">
																	<time datetime="2019-03-14T08:01:21+00:00">
																		17 Jan, 11:32 AM
																	</time>
																</a>
															</span>
                                                    <!-- .comment-metadata -->
                                                </div>
                                            </footer>
                                            <!-- .comment-meta -->
                                            <div class="comment-content">
                                                <p>
                                                    Ut wisi enim ad minim veniam, quis nostrud exerci tation. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div>
															<span class="like">
																<a class="like-link fw-500" href="#" aria-label="Reply to John Doe">Like</a>
															</span>
                                                    <span class="reply">
																<a rel="nofollow" class="comment-reply-link fw-500" href="#comments" aria-label="Reply to John Doe">Reply</a>
															</span>
                                                </div>
                                                <div>
															<span class="like-count color-dark">
																<i class="fw-600 color-dark fa fa-heart-o"></i>
																0
															</span>
                                                    <span class="comment-count color-dark">
																<i class="color-dark icon-m-comment-alt"></i>
																0 Comment
															</span>
                                                </div>
                                            </div>
                                        </article>
                                        <!-- .comment-body -->
                                    </li>
                                    <!-- #comment-## -->
                                </ol>
                                <!-- .children -->
                            </li>
                            <!-- #comment-## -->

                            <li class="comment">
                                <article class="comment-body">
                                    <footer class="comment-meta">
                                        <div class="comment-author vcard">
                                            <img alt="" src="images/team/testimonials_01.jpg">
                                        </div>
                                        <!-- .comment-author -->
                                        <div class="comment-name">
                                            <span class="says">By:</span>
                                            <b class="fn">
                                                <a href="#" rel="nofollow" class="url fw-500">Keith M. Jordan</a>
                                            </b>
                                            <span class="comment-metadata d-block">
														<a href="#">
															<time datetime="2019-03-14T08:01:21+00:00">
																17 Jan, 11:32 AM
															</time>
														</a>
													</span>
                                            <!-- .comment-metadata -->
                                        </div>
                                    </footer>
                                    <!-- .comment-meta -->
                                    <div class="comment-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
													<span class="like">
														<a class="like-link fw-500" href="#" aria-label="Reply to John Doe">Like</a>
													</span>
                                            <span class="reply">
														<a rel="nofollow" class="comment-reply-link fw-500" href="#comments" aria-label="Reply to John Doe">Reply</a>
													</span>
                                        </div>
                                        <div>
													<span class="like-count color-dark">
														<i class="fw-600 color-dark fa fa-heart-o"></i>
														12
													</span>
                                            <span class="comment-count color-dark">
														<i class="color-dark icon-m-comment-alt"></i>
														1 Comment
													</span>
                                        </div>
                                    </div>
                                </article>
                                <!-- .comment-body -->
                            </li>
                            <!-- #comment-## -->
                        </ol>
                        <!-- .comment-list -->

                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection