<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->


<!-- eUniversity London designed by BiG Inc, Fri, 20 Mar 2020 11:09:59 GMT -->
<head>
    <title>eUniversity London - {{ (isset($page_title)) ? $page_title : "Online Tutorials And Courses" }}</title>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" class="color-switcher-link">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <script src="{{ asset('js/vendor/modernizr-2.6.2.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('js/vendor/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/vendor/respond.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <![endif]-->

</head>

<body>
<!--[if lt IE 9]>
<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="color-main">upgrade your browser</a> to improve your experience.</div>
<![endif]-->

<div class="preloader">
    <div class="preloader_image"></div>
</div>
@if ($errors->any())
    <div class="woocommerce-message">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@include('frontend.blocks.model-popups')
<!-- wrappers for visual page editor and boxed version of template -->
<div id="canvas">
    <div id="box_wrapper">

        <!--topline section visible only on small screens|-->
        @include('frontend.blocks.topbar')
        <!--eof topline-->
        <!-- template sections -->
        <!--topline section visible only on small screens|-->
        <section class="page_topline ds c-my-10 d-xl-none">
            <div class="container-fluid">
                <div class="row align-items-center text-center">
                    <div class="col-12">
                        <div class="top-includes main-includes">
                            <button type="button" class="sign-btn-form" data-toggle="modal" data-target="#form2"><i class="fw-900 s-16 fa fa-sign-in" aria-hidden="true"></i>Sign Up</button>
                            <button type="button" class="login-btn-form login_modal_window" data-toggle="modal" data-target="#form1"><i class="fs-16 fa fa-user" aria-hidden="true"></i>Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--eof topline-->
        @include('frontend.blocks.menu-section')

        @yield('content')

        <footer class="page_footer ds s-pt-60 s-pb-20 s-pt-lg-100 s-pb-lg-55 c-gutter-40 container-px-md-0 text-center text-md-left">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 animate" data-animation="fadeInUp">

                        <div class="widget widget_text">
                            <a href="{{ URL::to('/') }}" class="logo">
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                <span class="logo-text color-darkgrey"></span>
                            </a>
                            <p>
                                Isn't days fill, after him bring. Set likeness meat seed whose for itself you can't seas itself. Herb replenish he, dry he. Firmament their.
                            </p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 animate" data-animation="fadeInUp">
                        <div class="widget widget_tag_cloud">
                            <h3 class="widget-title">Tag</h3>
                            <div class="tagcloud">
                                @foreach(App\Http\Controllers\Category::AllParentsCat() as $k=>$catval)
                                    <a href="{{ URL::to('/category/' . $catval->page_slug) }}" class="tag-cloud-link">
                                        {{ $catval->category_title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-6 col-lg-3 animate" data-animation="fadeInUp">
                        <div class="widget widget_social_button">
                            <h3 class="widget-title">Follow us</h3>
                            <a class="facebook" href="#">
                                <i class="fa fa-facebook" title="facebook"></i>
                                TutorFacebook
                            </a>
                            <a class="twitter-linka" href="#">
                                <i class="fa fa-twitter" title="twitter"></i>
                                TutorTwitter
                            </a>
                            <a class="telegram" href="#">
                                <i class="fa fa-paper-plane" title="telegram"></i>
                                TutorTelegram
                            </a>
                            <a class="linkedin" href="#">
                                <i class="fa fa-linkedin" title="linkedin"></i>
                                TutorLinkedIn
                            </a>
                            <a class="instagram" href="#">
                                <i class="fa fa-instagram" title="instagram"></i>
                                TutorInstagram
                            </a>
                            <a class="youtube" href="#">
                                <i class="fa fa-youtube-play" title="youtube"></i>
                                TutorYoutube
                            </a>

                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 animate" data-animation="fadeInUp">
                        <div class="widget widget_icons_list">
                            <h3>Contacts</h3>
                            <div class="media side-icon-box">
                                <div class="icon-styled fs-14">
                                    <i class="icon-m-marker-alt"></i>
                                </div>
                                <p class="media-body">USA, 3280 Cabell Avenue Alexandria, VA 22301</p>
                            </div>
                            <div class="media side-icon-box">
                                <div class="icon-styled fs-14">
                                    <i class="icon-m-phone-alt"></i>
                                </div>
                                <p class="media-body">Tel.: +1 703-518-6099</p>
                            </div>
                            <div class="media side-icon-box">
                                <div class="icon-styled fs-14">
                                    <i class="icon-m-fax-alt"></i>
                                </div>
                                <p class="media-body">Fax: +1 709-834-2693</p>
                            </div>
                            <div class="media side-icon-box">
                                <div class="icon-styled fs-14">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <p class="media-body">
                                    <a href="#">info@eUniversityLondon.com</a>
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </footer>


        <section class="page_copyright ds ms s-py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="divider-20 d-none d-lg-block"></div>
                    <div class="col-md-12 text-center">
                        <p>&copy; <span class="copyright_year">2020</span> eUniversityLondon Copyright</p>
                    </div>
                    <div class="divider-20 d-none d-lg-block"></div>
                </div>
            </div>
        </section>


    </div><!-- eof #box_wrapper -->
</div><!-- eof #canvas -->


<script src="{{ asset('js/compressed.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>


<script type="text/javascript" src="{{ asset('../../../themera.net/embed/themera227f.js?id=%d1%85%d1%85%d1%85%d1%85%d1%85') }}"></script></body>
<script src="{{ asset('js/front/signup.js') }}"></script>

<!-- eUniversity London designed by BiG Inc, Fri, 20 Mar 2020 11:11:58 GMT -->
</html>
