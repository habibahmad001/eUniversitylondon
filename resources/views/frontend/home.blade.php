@extends("layouts.frontapp")
@section('content')

<section class="page_slider ds">
    <span class="flexslider-overlay"></span>
    <img src="{{ asset('images/slide01.jpg') }}" alt="">
    <div class="container">
        <div class="divider-15 d-none d-lg-block d-xl-none"></div>
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="intro_layers_wrapper">
                    <div class="intro_layers">
                        <div class="intro_layer">
                            {{ App\Http\Controllers\Front\CMSController::cmsBTN(10, 1) }}
                            <h6 class="intro_before_featured_word animate" data-animation="fadeInUp">
                                Empower Yourself
                            </h6>
                            <h2 class="intro_featured_word animate" data-animation="fadeInUp">
                                {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(10)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(10)->cms_title : "" }}
                            </h2>
                            <p class="intro_after_featured_word animate" data-animation="fadeInUp">
                                {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(10)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(10)->cms_desc : "" !!}
                            </p>
                        </div>
                        <form method="post" class="search-course animate home-course" action="{{ URL::to("/search") }}">
                            {{ csrf_field() }}
                            <div class="form-group has-placeholder">
                                <label for="search-form-widget">
                                    <span class="screen-reader-text">Search for:</span>
                                </label>
                                <i class="fa fa-search home-search-btn"></i>
                                <input type="search" id="search-form-widget" class="search-field form-control" placeholder="Enter course name" value="" name="search">
                                <button type="submit" class="search-submit btn btn-maincolor home-search-btn">Find courses</button>
                            </div>
                        </form>
                    </div> <!-- eof .intro_layers -->
                </div> <!-- eof .intro_layers_wrapper -->
            </div> <!-- eof .col-* -->
            <div class="col-md-5">
                <div class="intro_layers_wrapper icon-layer">
                    <div class="intro_layers">
                        <?php $i=1;?>
                        @foreach(App\Http\Controllers\Category::AllParentsCat() as $k=>$catval)
                                <a href="{{ URL::to('/category/' . $catval->page_slug) }}" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                                    <div class="color-main icon-styled fs-32 itia poumbnail"><i class="{{ $catval->selectedicon }}" aria-hidden="true"></i></div>
                                    <p>{{ $catval->category_title }}</p>
                                </a>
                            <?php if($i%3 == 0) {?>
                                </div>
                                <div class="intro_layers">
                            <?php }?>
                            <?php $i++;?>
                            @endforeach
                    </div> <!-- eof .intro_layers -->
                </div>
            </div> <!-- eof .col-* -->
        </div><!-- eof .row -->
    </div><!-- eof .container-fluid -->
</section>

<section class="s-py-40 ds gradient-background d-none d-md-block" id="feature">
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="media align-items-center justify-content-center">
                <div class="icon-styled fs-42">
                    <i class="icon-m-people" aria-hidden="true"></i>
                </div>

                <div class="media-body">
                    <h6>
                        {{ str_pad($AllLearner, 5, '0', STR_PAD_LEFT) }} Learners
                    </h6>
                    <p>
                        We are proud to say that
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="media align-items-center justify-content-center">
                <div class="icon-styled fs-42">
                    <i class="icon-m-study" aria-hidden="true"></i>
                </div>

                <div class="media-body">
                    <h6>
                        {{ str_pad($AllCourses, 5, '0', STR_PAD_LEFT) }} Courses
                    </h6>
                    <p>
                        We are proud to say that
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="media align-items-center justify-content-center">
                <div class="icon-styled fs-42">
                    <i class="icon-m-language" aria-hidden="true"></i>
                </div>

                <div class="media-body">
                    <h6>
                        {{ str_pad($AllInstructor, 5, '0', STR_PAD_LEFT) }} Instructors
                    </h6>
                    <p>
                        We are proud to say that
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<form method="POST" name="prod" id="prod" action="{{ URL::to("/addcart") }}">
<section class="ls s-pt-55 s-pb-30 s-pt-lg-95 s-pb-lg-70" id="courses">
    <div class="container">
        <div class="divider-3"></div>
        <div class="row">
            <div class="col-lg-12">
                <h6 class="special-heading fw-300 text-center">Empower Yourself</h6>
                <h2 class="text-center">Popular courses</h2>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-xl-7">
                        <div class="filters course-filters text-lg-right">
                            <a href="#" data-filter="*" class="active selected">Trending now</a>
                            <a href="#" data-filter=".most_popular">Most Popular</a>
                            <a href="#" data-filter=".most_recent">Most Recent</a>
                            <a href="#" data-filter=".most_certified">Most Certified</a>
                        </div>
                    </div>
                </div>
                <div class="row isotope-wrapper c-mb-30" data-filters=".course-filters">
                    @if(count($Courses) > 0)
                        @foreach($Courses as $course)
                            <div class="col-12 col-md-6 col-lg-4 @if(count(json_decode($course->setas)) > 0) @foreach(json_decode($course->setas) as $v) {{ $v }} @endforeach @endif">
                                <div class="course-flip h-100 ">
                                    <div class="course-front rounded bordered">
                                        <div class=" vertical-item content-padding">
                                            <div class="item-media rounded-top">
                                                <img src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                                            </div>
                                            <div class="item-content">
                                                <h6 class="course-title">
                                                    <a href="javascript:void(0);">{{ $course->course_title }}</a>
                                                </h6>

                                                <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                                    <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                                </div>

                                                <div class="product-price">£{{ $course->course_price }}.00</div>

                                                <div class="tagcloud">
                                                    @if(count(json_decode($course->category_id)) > 0)
                                                        @foreach(json_decode($course->category_id) as $v)
                                                            <a href="#" class="tag-cloud-link">
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
                                                <a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $course->course_title))) }}">{{ $course->course_title }}</a>
                                            </h6>
                                            <p>
                                                {{ (strlen(strip_tags($course->course_desc)) > 150) ? substr(strip_tags($course->course_desc), 0, 150) . "..." : strip_tags($course->course_desc) }}
                                            </p>

                                            <div class="star-rating course-rating" id="{{ App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}">
                                                <span style="width: {{ (App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] == 0) ? 100 : App\Http\Controllers\Front\CourseController::GetStars($course->id)["ratingcount"] }}%">Rated <strong class="rating">5.00</strong> out of 5</span>
                                            </div>

                                            {{ csrf_field() }}
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
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
</form>


<section class="ds s-py-60 s-py-lg-100 call-to-action s-parallax s-overlay text-center text-lg-left" id="action">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-6">
                {{ App\Http\Controllers\Front\CMSController::cmsBTN(8, 1) }}
                <h6 class="special-heading fw-300">Personable Virtual Assistants</h6>
                <h2>{{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(8)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(8)->cms_title : "" }}</h2>
                <div class="divider-35 d-none d-md-block"></div>
                <p class="mt-20 mb-20">
                    {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(8)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(8)->cms_desc : "" !!}
                </p>
                <div class="divider-43 d-none d-md-block"></div>
                <a href="javascript:void(0);" class="btn btn-maincolor">Learn More about us</a>
            </div>
        </div>
    </div>
</section>

<section class="ls s-pt-60 s-pb-10 s-pt-lg-100 s-pb-lg-30 c-gutter-10 c-mb-20 category-section" id="categories">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h6 class="special-heading fw-300 text-center">Empower Yourself</h6>
                <h2 class="text-center">Popular categories</h2>
            </div>
            <div class="divider-10 d-none d-lg-block"></div>
            @if(count($AllParents) > 0)
                @foreach($AllParents as $k=>$catval)
                    <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="color-main icon-styled fs-77">
                            <i class="{{ $catval->selectedicon }}" aria-hidden="true"></i>
                        </div>
                        <h6 class="fw-700">
                            <a href="{{ URL::to('/category/' . $catval->page_slug) }}">{{ $catval->category_title }}</a>
                        </h6>
                        <p>
                            {{ (strlen(strip_tags($catval->category_desc)) > 150) ? substr(strip_tags($catval->category_desc), 0, 150) . "..." : strip_tags($catval->category_desc) }}
                        </p>
                    </div>
                    <span class="media-links">
                        <a class="abs-link" title="" href="{{ URL::to('/category/' . $catval->page_slug) }}"></a>
                    </span>
                </div><!-- .col-* -->
                @endforeach
            @else
                <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <center>There is no record found yet !!!</center>
                    </div>
                </div><!-- .col-* -->
            @endif

           <div class="col-12  text-center">
                <a href="{{ URL::to("/allcategories") }}" class="btn btn-maincolor">View More Categories</a>
            </div>
            <div class="d-none d-lg-block divider-20"></div>
        </div>

    </div>
</section>

<section id="section_testimonials" class="s-pt-60 s-pb-55 s-pt-lg-100 s-pb-lg-95 ls ms">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="testimonials-slider owl-carousel" data-autoplay="true" data-loop="true" data-responsive-lg="1" data-responsive-md="1" data-responsive-sm="1" data-nav="false" data-dots="false">
                    @if(count($AllTestimonial) > 0)
                        @foreach($AllTestimonial as $Testimonial)
                            <div class="quote-item">
                                <div class="quote-image">
                                    <img src="{{ asset('uploads/testimonial/' . $Testimonial->testimonial_img) }}" height="100" width="100" alt="">
                                </div>
                                <p>
                                    <em class="big">
                                        {{ strip_tags($Testimonial->testimonial_desc) }}
                                    </em>
                                </p>
                                <img src="{{ asset('images/quote.png') }}" alt="">
                                <h6 class="quote-meta fw-700">
                                    {{ $Testimonial->testimonial_name }}
                                </h6>
                                <p>{{ $Testimonial->testimonial_role }}</p>
                            </div>
                        @endforeach
                    @endif
                </div><!-- .testimonials-slider -->

            </div>
        </div>
    </div>
</section>

<section class="ds ms s-pt-60 s-pb-20 s-pt-lg-125 s-pb-lg-130 c-gutter-100 c-mb-40 c-mb-md-0 video-section text-center text-md-left" id="video">
    <div class="cover-image s-cover-left"></div><!-- half image background element -->
    <div class="container">
        <div class="divider-45 d-none d-lg-block"></div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="item-media post-thumbnail">
                    <div class="embed-responsive embed-responsive-3by2">
                        <a href="https://www.youtube.com/embed/bo316DYYy80" class="embed-placeholder">
                            <img src="{{ asset('images/video-image.jpg') }}" alt="">
                        </a>
                    </div>
                </div><!-- .post-thumbnail -->
            </div>
            <div class="col-md-6">
                <div class="item-content">
                    {{ App\Http\Controllers\Front\CMSController::cmsBTN(9, 1) }}
                    <h6 class="special-heading fw-300">Personable Virtual Assistants</h6>
                    <h2>{{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(9)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(9)->cms_title : "" }}</h2>
                    <div class="d-none d-lg-block divider-38"></div>
                    <p class="mt-20">{!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(9)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(9)->cms_desc : "" !!} </p>
                    <div class="d-none d-lg-block divider-43"></div>
                    <a href="{{ URL::to("/allcategories") }}" class="btn btn-maincolor">Find courses</a>
                </div>
            </div>
        </div>
        <div class="divider-40 d-none d-md-block"></div>
    </div>
</section>

<section class="ls s-pt-60 s-pb-50 s-py-lg-100 partners-section" id="partners">
    <div class="container">
        <div class="row">
            @if(count($AllClients) > 0)
                @foreach($AllClients as $Client)
                    <div class="col-4 col-md-2">
                        <a href="#">
                            <img src="{{ asset('uploads/client/' . $Client->client_logo) }}" width="170" height="69" alt="">
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection