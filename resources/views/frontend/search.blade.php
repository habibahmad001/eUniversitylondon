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
                            <label for="search-form-widget">
                                <span class="screen-reader-text">Search for:</span>
                            </label>
                            <input type="search" id="search-form-widget" class="search-field" placeholder="" value="" name="search">
                            <button type="submit" class="search-submit" id="cat_search">
                                <span class="screen-reader-text">Search</span>
                            </button>
                    </div>


                    <div class="bordered rounded">
                        <div class="widget widget_course_tag">

                            <h3 class="widget-title">Selected Options:</h3>

                            <div class="tagcloud">
                                @foreach(App\Http\Controllers\Category::AllParentsCat() as $k=>$catval)
                                    <a href="{{ URL::to('/category/' . $catval->page_slug) }}" class="tag-cloud-link">
                                        {{ $catval->category_title }}<span class="remove" aria-label="Remove this item">×</span>
                                    </a>
                                @endforeach
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
                                    <span>{{ ($course_cat[$catval->id]) ? $course_cat[$catval->id] : 0 }}</span>
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
                                    <a href="{{ URL::to("/searchtype/certificate") }}">Certificate</a>
                                </li>
                                <li class="cat-item">
                                    <a href="{{ URL::to("/searchtype/diploma") }}">Diploma</a>
                                </li>
                            </ul>
                        </div>


                    </div>

                    <div class="bordered rounded">
                        <div class="widget widget_learning_area">

                            <h3 class="widget-title">Learning Area</h3>

                            <ul>
                                <li class="cat-item">
                                    <a href="{{ URL::to("/searchtype/academic") }}">Academic</a>
                                </li>
                                <li class="cat-item">
                                    <a href="{{ URL::to("/searchtype/workplace") }}">Workplace</a>
                                </li>
                                <li class="cat-item">
                                    <a href="{{ URL::to("/searchtype/personal development") }}">Personal Development</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    {{--<div class="bordered rounded">--}}
                        {{--<div class="widget widget_course_level">--}}

                            {{--<h3 class="widget-title">Course Level</h3>--}}

                            {{--<ul>--}}

                                {{--<li class="cat-item">--}}
                                    {{--<a href="blog-right.html">Level 1</a>--}}
                                {{--</li>--}}
                                {{--<li class="cat-item">--}}
                                    {{--<a href="blog-right.html">Level 2</a>--}}
                                {{--</li>--}}
                                {{--<li class="cat-item">--}}
                                    {{--<a href="blog-right.html">Level 3</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                    {{--</div>--}}

                    {{--<div class="bordered rounded">--}}
                        {{--<div class="widget widget_course_features">--}}

                            {{--<h3 class="widget-title">Course Features</h3>--}}

                            {{--<ul>--}}
                                {{--<li class="cat-item">--}}
                                    {{--<a href="blog-right.html">Audio</a>--}}
                                {{--</li>--}}
                                {{--<li class="cat-item">--}}
                                    {{--<a href="blog-right.html">Video</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                    {{--</div>--}}

                </aside>

                <main class="col-lg-7 col-xl-8 order-1 order-lg-2">
                    <div class="row c-mb-30 search-row-container">
                        @if(count($Search) > 0)
                            @foreach($Search as $val)
                                <div><a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $val->course_title))) }}"><h3 class="search-title">{{ $val->course_title }}</h3></a></div>
                                <div>{{ (strlen(strip_tags($val->course_desc)) > 200) ? substr(strip_tags($val->course_desc), 0, 200) . "..." : strip_tags($val->course_desc) }}</div><br />
                                <div><a href="{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', $val->course_title))) }}">Link</a></div>
                                <hr width="100%" color="#555" />
                            @endforeach
                        @else
                                <div class="text-center">No result found !!!</div>
                        @endif
                    </div>
                </main>
            </div>
        </div>
    </section>
    </form>
@endsection