@extends("layouts.frontapp")
@section('content')
    <style>
        .page_title h1 {
            line-height: 2;
        }
    </style>
    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Course: {{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_title }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75 shop-order-received">
        <div class="container">
            <div class="row">
                @if(session()->has('message'))
                    <div class="woocommerce-message">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        {!! $ShowMSG !!} <br />
                        {!! (isset($status) && ($status == "unsuccessful")) ? '<a href="'. URL::to('/user/exam/' . $cid) .'">Retake Exam Fee</a>' : "" !!}
                        {!! (isset($retake)) ? '<a href="'. URL::to('/retake_exam/' . $cid) .'" target="_blank">Just Pay £19 and retake exam</a>' : "" !!}
                    </div>
                </div>
            </div>
            @if(isset($status) && ($status == "success"))
                <form name="rating-frm" id="rating-frm" method="post" action="{{ URL::to('/saveratings') }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="ratings-id">
                                {{ csrf_field() }}
                                <input type="hidden" name="star_val" id="star_val" value="0">
                                <input type="hidden" name="cid" id="cid" value="{{ $cid }}">
                                <ul>
                                    <li data-starval="5"><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    <li data-starval="4"><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    <li data-starval="3"><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    <li data-starval="2"><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    <li data-starval="1"><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                            <div id="comment-id">
                                <textarea cols="10" rows="8" name="ccomments" id="ccomments" placeholder="Type some text . . ."></textarea>
                                <button type="submit" class="btn btn-success" name="savecomment" id="savecomment">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    @include('frontend.blocks.prevnext')
                </div>
            </div>
        </div>
    </section>

@endsection