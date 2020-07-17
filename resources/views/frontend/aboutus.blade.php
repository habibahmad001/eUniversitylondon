@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>About Us</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Pages</a>
                            </li>
                            <li class="breadcrumb-item active">
                                About Us
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-60 s-pb-60 s-py-lg-100 c-gutter-50 about-section text-center text-lg-left container-px-lg-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5">
                    <div class="about-image">
                        <img src="{{ asset('images/about.jpg') }}" alt="">
                    </div>
                    <div class="divider-30 d-block d-lg-none"></div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="item-content">
                        {{ App\Http\Controllers\Front\CMSController::cmsBTN(1, 3) }}
                        <h6 class="special-heading fw-300">Who we are </h6>
                        <h2>{{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(1)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(1)->cms_title : "" }}</h2>
                        <div class="d-none d-lg-block divider-35"></div>
                        <div class="row c-gutter-25">
                            <div class="divider-15 d-block d-lg-none"></div>
                            <div class="col-md-10 mb-20">
                                {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(1)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(1)->cms_desc : "" !!}
                            </div>
                            <div class="col-md-6">
                                {{ App\Http\Controllers\Front\CMSController::cmsBTN(2, 3) }}
                                <h6 class="fw-700">
                                    {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(2)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(2)->cms_title : "" }}
                                </h6>
                                    {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(2)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(2)->cms_desc : "" !!}
                            </div>
                            <div class="col-md-6">
                                {{ App\Http\Controllers\Front\CMSController::cmsBTN(3, 3) }}
                                <h6 class="fw-700">
                                    {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(3)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(3)->cms_title : "" }}
                                </h6>
                                <p>
                                    {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(3)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(3)->cms_desc : "" !!}
                                </p>
                            </div>
                        </div>
                        <a href="{{ URL::to("/allcategories") }}" class="btn btn-maincolor">Find courses</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls ms s-pt-30 s-pb-15 s-pt-lg-70 s-pb-lg-30 c-gutter-10 c-mb-20 category-section">
        <div class="container">
            <div class="row">
                @if(count($Topics) > 0)
                    @foreach($Topics as $Topic)
                        <div class="col-lg-4 col-sm-6">
                            <div class="icon-box text-center">
                                <div class="color-main icon-styled fs-77">
                                    <i class="{{ $Topic->selectedicon }}" aria-hidden="true"></i>
                                </div>
                                <h6 class="fw-700">
                                    <a href="javascript:void(0);">{{ $Topic->topics_title }}</a>
                                </h6>
                                {!! $Topic->topics_desc !!}
                            </div>
                            <div class="media-links">
                                <a class="abs-link" title="" href="javascript:void(0);"></a>
                            </div>
                        </div><!-- .col-* -->
                    @endforeach
                @endif
                <div class="d-none d-lg-block divider-20"></div>
            </div>

        </div>
    </section>


    <section class="ls s-pt-50 s-pb-55 s-pt-lg-90 s-pb-lg-95">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>eUniversity London Team</h2>
                    <div class="divider-43 d-none d-md-block"></div>
                </div>
                <div class="col-md-12">
                    <div class="testimonials-slider owl-carousel" data-autoplay="true" data-loop="true" data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2" data-nav="false" data-dots="false">
                        @if(count($Teams) > 0)
                            @foreach($Teams as $team)
                                <div class="vertical-item text-center">
                                    <div class="item-media rounded">
                                        <img src="{{ asset('uploads/teams/' . $team->teams_img) }}" alt="">
                                        <div class="media-links">
                                            <a class="abs-link" title="" href="javascript:void(0);"></a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <h6 class="title-content">
                                            <a href="javascript:void(0);">{{ $team->teams_name }}</a>
                                        </h6>
                                        <p class="position">
                                            {{ $team->teams_role }}
                                        </p>
                                        <p class="social-icons">
                                            <a href="javascript:void(0);" class="fa fa-facebook" title="facebook"></a>
                                            <a href="javascript:void(0);" class="fa fa-instagram" title="instagram"></a>
                                            <a href="javascript:void(0);" class="fa fa-youtube-play" title="youtube"></a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div><!-- .team-slider -->

                </div>
            </div>
        </div>
    </section>


    <section class="ls s-pt-60 s-pb-50 s-py-lg-100 partners-section">
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