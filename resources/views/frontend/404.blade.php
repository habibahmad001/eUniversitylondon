@extends("layouts.frontapp")
@section('content')

    <section class="ds ds s-pt-70 s-pb-70 error-404 not-found page_404">
        <div class="container">
            <div class="row">

                <div class="d-none d-lg-block divider-70"></div>

                <div class="col-sm-12 text-center">

                    <header class="page-header">
                        <img src="img/404.png" alt="">
                        <h2 class="not-found">
                            Error. Page Not Found
                        </h2>
                    </header>
                    <!-- .page-header -->

                    <div class="page-content">
                        <div id="search-404" class="widget">
                            <form role="search" method="get" class="search-form search-course" action="http://webdesign-finder.com/">
                                <div class="form-group has-placeholder">
                                    <label for="search-form-widget">
                                        <span class="screen-reader-text">Search for:</span>
                                    </label>
                                    <i class="fa fa-search"></i>
                                    <input type="search" id="search-form-widget" autocomplete="off" class="search-field form-control" placeholder="" value="" name="search">
                                    <button type="submit" class="search-submit btn btn-maincolor">Find courses</button>
                                </div>
                            </form>
                        </div>
                        <!-- .page-content -->
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block divider-70"></div>
        </div>
    </section>

@endsection