@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">
        <!-- header with two Bootstrap columns - left for logo and right for navigation and includes (search, social icons, additional links and buttons etc -->

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Course Categories</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Course Categories
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <section class="ls s-pt-55 s-pb-15 s-pt-lg-95 s-pb-lg-30 c-gutter-10 c-mb-20 category-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="special-heading fw-300 text-center">We have over 500 courses for you to choose from</h6>
                    <h2 class="text-center">Explore Course categories</h2>
                </div>
                <div class="divider-10 d-none d-md-block"></div>
                @if(count($ALLCats) > 0)
                    @foreach($ALLCats as $k=>$catval)
                        <div class="col-lg-4 col-sm-6">
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
                    <div class="col-lg-4 col-sm-6>
                        <div class="icon-box text-center">
                            <center>There is no record found yet !!!</center>
                        </div>
                    </div><!-- .col-* -->
                @endif
                <div class="d-none d-lg-block divider-20"></div>
                {{--<div class="col-lg-4 col-sm-6"></div>--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                    {{--<nav class="navigation pagination @@navClass" role="navigation">--}}
                        {{--<button type="button" class="btn btn-maincolor full-width">load more<i class="fa fa-spinner fa-pulse"></i></button>--}}
                    {{--</nav>--}}
                {{--</div>--}}
                {{--<div class="col-lg-4 col-sm-6"></div>--}}
            </div>


        </div>
    </section>

@endsection