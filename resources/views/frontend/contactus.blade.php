@extends("layouts.frontapp")
@section('content')

    <div class="header_absolute ds s-parallax s-overlay title-bg2">

        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Contact Us</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Pages</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Contact us
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="s-pt-60 s-pb-15 s-pb-md-60 s-py-lg-90 ls ms">
        <div class="container">
            <div class="row c-mb-40 c-mb-md-0 text-center text-md-left">
                <div class="col-md-6 col-lg-3">
                    <div class="media contact-icon">
                        <div class="icon-styled color-main fs-52">
                            <i class="icon-m-location"></i>
                            {{ App\Http\Controllers\Front\CMSController::cmsBTN(4, 2) }}
                        </div>

                        <div class="media-body">
                            <h6 class="fw-700">
                                {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(4)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(4)->cms_title : "" }}
                            </h6>
                            {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(4)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(4)->cms_desc : "" !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="media contact-icon">
                        <div class="icon-styled color-main fs-52">
                            <i class="icon-m-phone"></i>
                            {{ App\Http\Controllers\Front\CMSController::cmsBTN(5, 2) }}
                        </div>

                        <div class="media-body">
                            <h6 class="fw-700">
                                {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(5)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(5)->cms_title : "" }}
                            </h6>
                            {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(5)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(5)->cms_desc : "" !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="media contact-icon">
                        <div class="icon-styled color-main fs-52">
                            <i class="icon-m-fax"></i>
                            {{ App\Http\Controllers\Front\CMSController::cmsBTN(6, 2) }}
                        </div>

                        <div class="media-body">
                            <h6 class="fw-700">
                                {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(6)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(6)->cms_title : "" }}
                            </h6>
                            {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(6)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(6)->cms_desc : "" !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="media contact-icon">
                        <div class="icon-styled color-main fs-52">
                            <i class="icon-m-e-mail"></i>
                            {{ App\Http\Controllers\Front\CMSController::cmsBTN(7, 2) }}
                        </div>

                        <div class="media-body">
                            <h6 class="fw-700">
                                {{ isset(App\Http\Controllers\Front\CMSController::CMSPageItems(7)->cms_title) ? App\Http\Controllers\Front\CMSController::CMSPageItems(7)->cms_title : "" }}
                            </h6>
                            {!! isset(App\Http\Controllers\Front\CMSController::CMSPageItems(7)->cms_desc) ? App\Http\Controllers\Front\CMSController::CMSPageItems(7)->cms_desc : "" !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="ls s-py-60 s-pt-lg-95 s-pb-lg-100 c-gutter-60 container-px-30">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2 animate" data-animation="scaleAppear">

                    <h6 class="special-heading fw-300 text-center">Empower Yourself</h6>
                    <h2 class="text-center">Ask question</h2>

                    <form class="contact-form c-mb-10 c-gutter-10" method="post" action="http://webdesign-finder.com/">

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group has-placeholder">
                                    <label for="first-name">First name<span class="required">*</span></label>
                                    <input type="text" aria-required="true" size="30" value="" name="first-name" id="first-name" class="form-control" placeholder="First name">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group has-placeholder">
                                    <label for="first-name">last name<span class="required">*</span></label>
                                    <input type="text" aria-required="true" size="30" value="" name="last-name" id="last-name" class="form-control" placeholder="Last name">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group has-placeholder">
                                    <label for="email">Email address<span class="required">*</span></label>
                                    <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Your email adress">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group has-placeholder">
                                    <label for="phone">Phone<span class="required">*</span></label>
                                    <input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control" placeholder="Phone number">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="form-group has-placeholder">
                                    <label for="message">Message</label>
                                    <textarea aria-required="true" rows="4" cols="45" name="message" id="message" class="form-control" placeholder="Message"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-12 text-center mt-20">

                                <div class="form-group">
                                    <button type="submit" id="contact_form_submit" name="contact_submit" class="btn btn-maincolor full-width">Contact Us</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <!--.col-* -->
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=study365&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com"></a></div><style>.mapouter{position:relative;text-align:right;height:450px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:450px;width:100%;}</style></div>

                </div>
            </div>
        </div>
    </section>

@endsection