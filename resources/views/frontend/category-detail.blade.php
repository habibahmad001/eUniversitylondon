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
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Pages</a>
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
                                <li class="cat-item">
                                    <a href="blog-right.html">Technology</a>
                                    60
                                    <ul class="children">
                                        <li class="cat-item">
                                            <a href="blog-right.html">Language
                                            </a>
                                            15
                                        </li>
                                        <li class="cat-item">
                                            <a href="blog-right.html">Science
                                            </a>
                                            23
                                        </li>
                                    </ul>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Health</a>
                                    <span>12</span>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Humanities</a>
                                    <span>45</span>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Business</a>
                                    <span>78</span>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Math</a>
                                    <span>55</span>
                                </li>
                                <li class="cat-item">
                                    <a href="blog-right.html">Marketing</a>
                                    <span>23</span>
                                </li>

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
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front">
                                    <div class=" vertical-item content-padding">
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/01.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Diploma in Basic English Grammar</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>

                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Technology
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Humanities
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Diploma in Basic English Grammar</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Technology
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Humanities
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/02.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Diploma in Legal Studies - Revised 2017</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>
                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Marketing
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Lifestyle
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Diploma in Legal Studies - Revised 2017</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95 d-block d-lg-none d-xl-block"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Marketing
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Lifestyle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/03.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Working with Students with Special Educational Needs</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>

                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Language
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Science
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Working with Students with Special Educational Needs</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95 d-block d-lg-none d-xl-block"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Language
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Science
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/04.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Introduction to Human Nutrition</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>

                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Science
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Business
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Introduction to Human Nutrition</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95 d-block d-lg-none d-xl-block"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Science
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Business
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/05.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Skills for Speaking Effectively: The Art of Speaking</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>

                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Humanities
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Language
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Skills for Speaking Effectively: The Art of Speaking</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95 d-block d-lg-none d-xl-block"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Humanities
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Language
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/06.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">General Data Protection Regulation (GDPR)</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>

                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Technology
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Lifestyle
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">General Data Protection Regulation (GDPR)</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95 d-block d-lg-none d-xl-block"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Technology
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Lifestyle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/08.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Introduction to Human Nutrition</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>

                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Science
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Business
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Introduction to Human Nutrition</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Science
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Business
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="course-flip h-100 bordered rounded">
                                <div class="course-front vertical-item content-padding">
                                    <div>
                                        <div class="item-media rounded-top">
                                            <img src="{{ asset('images/courses/09.jpg') }}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <h6 class="course-title">
                                                <a href="single-course.html">Skills for Speaking Effectively: The Art of Speaking</a>
                                            </h6>

                                            <div class="star-rating course-rating">
                                                <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                            </div>
                                            <div class="tagcloud">
                                                <a href="#" class="tag-cloud-link">
                                                    Humanities
                                                </a>
                                                <a href="#" class="tag-cloud-link">
                                                    Technology
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-back rounded vertical-item content-padding ds">
                                    <div class="item-content">
                                        <h6 class="course-title">
                                            <a href="single-course.html">Skills for Speaking Effectively: The Art of Speaking</a>
                                        </h6>
                                        <p>
                                            Learn about corporate governance of organizations: internal and external factors
                                        </p>
                                        <div class="star-rating course-rating">
                                            <span style="width:91.5%">Rated <strong class="rating">4.00</strong> out of 5</span>
                                        </div>
                                        <div class="divider-48"></div>
                                        <a href="#" class="btn btn-maincolor">Start now</a>
                                        <div class="divider-95"></div>
                                        <div class="tagcloud">
                                            <a href="#" class="tag-cloud-link">
                                                Humanities
                                            </a>
                                            <a href="#" class="tag-cloud-link">
                                                Technology
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


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

@endsection