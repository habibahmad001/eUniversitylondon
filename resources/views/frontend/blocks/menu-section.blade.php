<div class="header_absolute ds cover-background s-overlay">
    <!-- header with two Bootstrap columns - left for logo and right for navigation and includes (search, social icons, additional links and buttons etc -->
    <header class="page_header ds justify-nav-center s-borderbottom container-px-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-4 col-md-5 col-11">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                        <span class="logo-text color-darkgrey"></span>
                    </a>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-7 col-1">
                    <div class="nav-wrap">
                        <!-- main nav start -->
                        <nav class="top-nav">
                            <ul class="nav sf-menu euniversity">

                                <li class="active">
                                    <div class="widget course-dropdown">
                                        <a class="dropdown-toggle" id="course-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Categories
                                        </a>
                                        <div class="dropdown-menu dropdown-multicol dropdown-menu-right ds" aria-labelledby="course-dropdown">
                                            <div class="row c-gutter-75">
                                                <div class=" col-lg-4 col-md-4 col-xs-12">
                                                    <?php $i=1;?>
                                                    @foreach(App\Http\Controllers\Category::AllParentsCat() as $k=>$catval)
                                                        <a class="dropdown-item" href="course-categories.html">
                                                            <i class="fs-31 {{ $catval->selectedicon }}" aria-hidden="true"></i>
                                                            {{ $catval->category_title }}
                                                        </a>
                                                        <?php if($i%3 == 0) {?>
                                                            </div>
                                                            <div class=" col-lg-4 col-md-4 col-xs-12">
                                                        <?php }?>
                                                        <?php $i++;?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="widget widget_search">
                                        <form role="search" method="get" class="search-form" action="http://webdesign-finder.com/">
                                            <label for="search-form-top">
                                                <span class="screen-reader-text">Search for:</span>
                                            </label>
                                            <input type="search" id="search-form-top" class="search-field" placeholder="Search keyword" value="" name="search">
                                            <button type="submit" class="search-submit">
                                                <span class="screen-reader-text">Search</span>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <!-- eof pages -->




                            </ul>


                        </nav>
                        <!-- eof main nav -->
                        <!--hidding includes on small devices. They are duplicated in topline-->
                    </div>
                </div>
                <div class="col-4 d-none d-xl-block">
                    <div class="top-includes main-includes">
                        <button type="button" class="sign-btn-form" data-toggle="modal" data-target="#form2"><i class="fw-900 s-16 fa fa-sign-in" aria-hidden="true"></i>Sign Up</button>
                        <button type="button" class="login-btn-form login_modal_window" data-toggle="modal" data-target="#form1"><i class="fs-16 fa fa-user" aria-hidden="true"></i>Login</button>


                    </div>
                </div>
            </div>
        </div>
        <!-- header toggler -->
        <span class="toggle_menu"><span></span></span>
    </header>
</div>