@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Course Catalog</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Course Catalog
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <form method="POST" name="prod" id="prod" action="{{ URL::to("/addcart") }}">
        {{ csrf_field() }}
    <section class="ls s-py-60 s-pt-lg-100 s-pb-lg-70">
        <div class="container">
            <div class="row c-gutter-30">
                <aside class="col-lg-5 col-xl-4 course-widgets order-2 order-lg-1">
                    <div class="widget widget_search ds p-30 rounded">
                        <h3 class="widget-title">Search</h3>
                        <form role="search" method="get" class="search-form" action="http://webdesign-finder.com/">
                            <label for="search-form-widget">
                                <span class="screen-reader-text">Search for:</span>
                            </label>
                            <input type="search" id="search-form-widget" class="search-field" placeholder="" value="" name="search">
                            <button type="submit" class="search-submit">
                                <span class="screen-reader-text">Search</span>
                            </button>
                        </form>
                    </div>


                    <div class="bordered rounded">
                        <div class="widget widget_course_tag">

                            <h3 class="widget-title">Selected Options:</h3>

                            <div class="tagcloud">
                                <a href="#" class="tag-cloud-link">
                                    Science <span class="remove" aria-label="Remove this item">×</span>
                                </a>
                                <a href="#" class="tag-cloud-link">
                                    Business <span class="remove" aria-label="Remove this item">×</span>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="bordered rounded">
                        <div class="widget widget_categories">

                            <h3 class="widget-title">Select Category</h3>

                            <ul>
                                {{--<li class="cat-item">--}}
                                    {{--<a href="blog-right.html">Technology</a>--}}
                                    {{--60--}}
                                    {{--<ul class="children">--}}
                                        {{--<li class="cat-item">--}}
                                            {{--<a href="blog-right.html">Language--}}
                                            {{--</a>--}}
                                            {{--15--}}
                                        {{--</li>--}}
                                        {{--<li class="cat-item">--}}
                                            {{--<a href="blog-right.html">Science--}}
                                            {{--</a>--}}
                                            {{--23--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                @foreach(App\Http\Controllers\Category::AllParentsCat() as $k=>$catval)
                                <li class="cat-item">
                                    <a href="{{ URL::to('/category/' . $catval->page_slug) }}">{{ $catval->category_title }}</a>
                                    <span>{{ ($course_cat[trim(strtolower($catval->category_title))]) ? $course_cat[trim(strtolower($catval->category_title))] : 0 }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="bordered rounded">
                        <div class="widget widget_course_type">

                            <h3 class="widget-title">Course Type</h3>

                            <ul>
                                <li class="cat-item">
                                    <a href="blog-right.html">Certificate</a>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Diploma</a>
                                </li>
                            </ul>
                        </div>


                    </div>

                    <div class="bordered rounded">
                        <div class="widget widget_learning_area">

                            <h3 class="widget-title">Learning Area</h3>

                            <ul>
                                <li class="cat-item">
                                    <a href="blog-right.html">Academic</a>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Workplace</a>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Personal Development</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="bordered rounded">
                        <div class="widget widget_course_level">

                            <h3 class="widget-title">Course Level</h3>

                            <ul>

                                <li class="cat-item">
                                    <a href="blog-right.html">Level 1</a>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Level 2</a>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Level 3</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="bordered rounded">
                        <div class="widget widget_course_features">

                            <h3 class="widget-title">Course Features</h3>

                            <ul>
                                <li class="cat-item">
                                    <a href="blog-right.html">Audio</a>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Video</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </aside>

                <main class="col-lg-7 col-xl-8 order-1 order-lg-2">
                    <div class="row c-mb-30">
                        @if(count($Courses) > 0)
                            @foreach($Courses as $course)
                                @if(in_array($categories->id, (array) json_decode($course->category_id)))
                                    <div class="col-12 col-md-6">
                                        <div class="course-flip h-100 bordered rounded">
                                            <div class="course-front">
                                                <div class=" vertical-item content-padding">
                                                    <div class="item-media rounded-top">
                                                        <img src="{{ asset('/uploads/pavatar/' . $course->course_avatar ) }}" alt="">
                                                    </div>
                                                    <div class="item-content">
                                                        <h6 class="course-title">
                                                            <a href="javascript:void(0);">{{ $course->course_title }}</a>
                                                        </h6>

                                                        <div class="star-rating course-rating">
                                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                                        </div>

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
                                                        <a href="javascript:void(0);">{{ $course->course_title }}</a>
                                                    </h6>
                                                    <p>
                                                        {{ (strlen(strip_tags($course->course_desc)) > 150) ? substr(strip_tags($course->course_desc), 0, 150) . "..." : strip_tags($course->course_desc) }}
                                                    </p>
                                                    <div class="star-rating course-rating">
                                                        <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                                    </div>
                                                    <div class="divider-48" id="itm-post-{{ $course->id }}"></div>
                                                    <a href="javascript:void(0);" onclick="javascript:product_submit({{ $course->id }});" class="btn btn-maincolor">Start now</a>
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
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <nav class="navigation pagination @@navClass" role="navigation">
                                <button type="button" class="btn btn-maincolor full-width">load more<i class="fa fa-spinner fa-pulse"></i></button>
                            </nav>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
    </form>
@endsection