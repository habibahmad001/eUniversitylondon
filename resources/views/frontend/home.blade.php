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
                            <h6 class="intro_before_featured_word animate" data-animation="fadeInUp">
                                Empower Yourself
                            </h6>
                            <h2 class="intro_featured_word animate" data-animation="fadeInUp">
                                Free online courses from the experts
                            </h2>
                            <p class="intro_after_featured_word animate" data-animation="fadeInUp">
                                We are proud to say that since our opening in ’98
                            </p>
                        </div>
                        <form role="search" method="get" class="search-form search-course animate" action="http://webdesign-finder.com/" data-animation="fadeInUp">
                            <div class="form-group has-placeholder">
                                <label for="search-form-widget">
                                    <span class="screen-reader-text">Search for:</span>
                                </label>
                                <i class="fa fa-search"></i>
                                <input type="search" id="search-form-widget" class="search-field form-control" placeholder="" value="" name="search">
                                <button type="submit" class="search-submit btn btn-maincolor">Find courses</button>
                            </div>
                        </form>
                    </div> <!-- eof .intro_layers -->
                </div> <!-- eof .intro_layers_wrapper -->
            </div> <!-- eof .col-* -->
            <div class="col-md-5">
                <div class="intro_layers_wrapper icon-layer">
                    <div class="intro_layers">
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32 itia poumbnail"><i class="icon-m-technology" aria-hidden="true"></i></div>
                            <p>Technology</p>
                        </a>
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-language" aria-hidden="true"></i></div>
                            <p>Language</p>
                        </a>
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-science" aria-hidden="true"></i></div>
                            <p>Science</p>
                        </a>
                    </div> <!-- eof .intro_layers -->
                    <div class="intro_layers">
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-business" aria-hidden="true"></i></div>
                            <p>Business</p>
                        </a>
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-marketing" aria-hidden="true"></i></div>
                            <p>Marketing</p>
                        </a>
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-health" aria-hidden="true"></i></div>
                            <p>Health</p>
                        </a>
                    </div> <!-- eof .intro_layers -->
                    <div class="intro_layers">
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-humanities" aria-hidden="true"></i></div>
                            <p>Humanities</p>
                        </a>
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-math" aria-hidden="true"></i></div>
                            <p>Math1</p>
                        </a>
                        <a href="course-categories.html" class="icon-box text-center bordered rounded animate" data-animation="moveFromLeft">
                            <div class="color-main icon-styled fs-32"><i class="icon-m-lifestyle" aria-hidden="true"></i></div>
                            <p>Lifestyle</p>
                        </a>
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
                        14345 Learners
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
                        1050 Courses
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
                        350 Countries
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
                            <a href="#" data-filter=".popular">Most Popular</a>
                            <a href="#" data-filter=".resent">Most Recent</a>
                            <a href="#" data-filter=".certified">Most Certified</a>
                        </div>
                    </div>
                </div>
                <div class="row isotope-wrapper c-mb-30" data-filters=".course-filters">
                    <div class="col-12 col-md-6 col-lg-4 popular">
                        <div class="course-flip h-100 ">
                            <div class="course-front rounded bordered">
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
                    <div class="col-12 col-md-6 col-lg-4 popular">
                        <div class="course-flip h-100">
                            <div class="course-front rounded bordered">
                                <div class="vertical-item content-padding">
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
                    <div class="col-12 col-md-6 col-lg-4 resent">
                        <div class="course-flip h-100">
                            <div class="course-front rounded bordered">
                                <div class="vertical-item content-padding">
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
                    <div class="col-12 col-md-6 col-lg-4 resent">
                        <div class="course-flip h-100">
                            <div class="course-front rounded bordered">
                                <div class="vertical-item content-padding">
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
                    <div class="col-12 col-md-6 col-lg-4 certified">
                        <div class="course-flip h-100">
                            <div class="course-front rounded bordered">
                                <div class="vertical-item content-padding">
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
                    <div class="col-12 col-md-6 col-lg-4 certified">
                        <div class="course-flip h-100">
                            <div class="course-front rounded bordered">
                                <div class="vertical-item content-padding">
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
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ds s-py-60 s-py-lg-100 call-to-action s-parallax s-overlay text-center text-lg-left" id="action">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-6">
                <h6 class="special-heading fw-300">Personable Virtual Assistants</h6>
                <h2>Why We Are</h2>
                <div class="divider-35 d-none d-md-block"></div>
                <p class="mt-20 mb-20">
                    We are proud to say that since our opening in ’98 we have been serving our visitors in the best possible way. In Hotel Nanovi, where each one of
                </p>
                <div class="divider-43 d-none d-md-block"></div>
                <a href="#" class="btn btn-maincolor">Learn More about us</a>
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
            <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">
                <div class="icon-box text-center">
                    <div class="color-main icon-styled fs-77">
                        <i class="icon-m-technology" aria-hidden="true"></i>
                    </div>
                    <h6 class="fw-700">
                        <a href="single-course.html">Technology</a>
                    </h6>
                    <p>
                        Lorem ipsum dolor sit amet, contetur adipiscing diam
                    </p>
                </div>
                <span class="media-links">
								<a class="abs-link" title="" href="course-categories.html"></a>
							</span>
            </div><!-- .col-* -->
            <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">

                <div class="icon-box text-center">
                    <div class="color-main icon-styled fs-77">
                        <i class="icon-m-language" aria-hidden="true"></i>
                    </div>
                    <h6 class="fw-700">
                        <a href="single-course.html">Language</a>
                    </h6>
                    <p>
                        Phasellus porttitor justo elit, ac tempus ligula sodales
                    </p>
                </div>
                <div class="media-links">
                    <a class="abs-link" title="" href="course-categories.html"></a>
                </div>
            </div><!-- .col-* -->
            <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">

                <div class="icon-box text-center">
                    <div class="color-main icon-styled fs-77">
                        <i class="icon-m-science" aria-hidden="true"></i>
                    </div>

                    <h6 class="fw-700">
                        <a href="single-course.html">Science</a>
                    </h6>

                    <p>
                        Nunc vehicula metus et massa tincidunt ultrices tincidunt
                    </p>


                </div>
                <div class="media-links">
                    <a class="abs-link" title="" href="course-categories.html"></a>
                </div>
            </div><!-- .col-* -->
            <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">

                <div class="icon-box text-center">
                    <div class="color-main icon-styled fs-77">
                        <i class="icon-m-humanities" aria-hidden="true"></i>
                    </div>

                    <h6 class="fw-700">
                        <a href="single-course.html">Humanities</a>
                    </h6>

                    <p>
                        Curabitur pretium elit mi, non sollicitudin massa ac
                    </p>
                </div>
                <div class="media-links">
                    <a class="abs-link" title="" href="course-categories.html"></a>
                </div>
            </div><!-- .col-* -->
            <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">

                <div class="icon-box text-center">
                    <div class="color-main icon-styled fs-77">
                        <i class="icon-m-business" aria-hidden="true"></i>
                    </div>

                    <h6 class="fw-700">
                        <a href="single-course.html">Business</a>
                    </h6>

                    <p>
                        In porta urna risus, ut imperdiet nisl condimentum lobortis
                    </p>
                </div>
                <div class="media-links">
                    <a class="abs-link" title="" href="course-categories.html"></a>
                </div>
            </div><!-- .col-* -->
            <div class="col-lg-4 col-sm-6 animate" data-animation="fadeInUp">

                <div class="icon-box text-center">
                    <div class="color-main icon-styled fs-77">
                        <i class="icon-m-marketing" aria-hidden="true"></i>
                    </div>

                    <h6 class="fw-700">
                        <a href="single-course.html">Marketing</a>
                    </h6>

                    <p>
                        Sed pellentesque pulvinar arcu ac congue. Sed sed est nec
                    </p>


                </div>
                <div class="media-links">

                    <a class="abs-link" title="" href="course-categories.html"></a>
                </div>
            </div><!-- .col-* -->
            <div class="col-12  text-center">
                <a href="#" class="btn btn-maincolor">View More Categories</a>
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
                    <div class="quote-item">
                        <div class="quote-image">
                            <img src="{{ asset('images/team/testimonials_01.jpg') }}" alt="">
                        </div>
                        <p>
                            <em class="big">
                                I met so many interesting people over the last couple of months, who proved to stay ahead of the modern technologies in the world of branding and web design. I loved working with you all, thank you so much!
                            </em>
                        </p>
                        <img src="{{ asset('images/quote.png') }}" alt="">
                        <h6 class="quote-meta fw-700">
                            Keith M. Jordan
                        </h6>
                        <p>Applied Researcher</p>
                    </div>
                    <div class="quote-item">
                        <div class="quote-image">
                            <img src="{{ asset('images/team/testimonials_02.jpg') }}" alt="">
                        </div>
                        <p>
                            <em class="big">
                                I am inspired by the UN Declaration that “everyone is entitled to a free education”. We are committed to equality and access to education irrespective of gender, geography, economic status or any other barriers to access.
                            </em>
                        </p>
                        <img src="{{ asset('images/quote.png') }}" alt="">
                        <h6 class="quote-meta fw-700">
                            Ron M. Martin
                        </h6>
                        <p>Applied Researcher</p>
                    </div>
                    <div class="quote-item">
                        <div class="quote-image">
                            <img src="{{ asset('images/team/testimonials_03.jpg') }}" alt="">
                        </div>
                        <p>
                            <em class="big">
                                I am drive by our belief in the power of free education and skills training to change people’s lives for the better and are passionate about providing an overall learning experience that meets their needs and helps them to achieve life goals.
                            </em>
                        </p>
                        <img src="{{ asset('images/quote.png') }}" alt="">
                        <h6 class="quote-meta fw-700">
                            Thelma R. Furman
                        </h6>
                        <p>Autor courses</p>
                    </div>

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
                    <h6 class="special-heading fw-300">Personable Virtual Assistants</h6>
                    <h2>Don't just take our</h2>
                    <div class="d-none d-lg-block divider-38"></div>
                    <p class="mt-20">We are proud to say that since our opening in ’98 we have been serving our visitors in the best possible way. In Hotel Nanovi, where </p>
                    <div class="d-none d-lg-block divider-43"></div>
                    <a href="#" class="btn btn-maincolor">Find courses</a>
                </div>
            </div>
        </div>
        <div class="divider-40 d-none d-md-block"></div>
    </div>
</section>

<section class="ls s-pt-60 s-pb-50 s-py-lg-100 partners-section" id="partners">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="{{ asset('images/partners/06.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="{{ asset('images/partners/05.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="{{ asset('images/partners/04.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="{{ asset('images/partners/03.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="{{ asset('images/partners/02.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="{{ asset('images/partners/01.jpg') }}" alt="">
                </a>
            </div>
        </div>
    </div>
</section>
@endsection