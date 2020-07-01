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
                        <h1>Exam: {{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_title }}</h1>
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
                <div class="col-lg-12">
                    <div>
                        {!! $ShowMSG !!} <br />
                        {!! ($status == "unsuccessful") ? '<a href="'. URL::to('/retake_exam') .'" target="_blank">Retake Exam Fee</a>' : "" !!}
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="unit_prevnext">
                        <div class="col-md-4 text-center"><a href="{{ URL::to('/startcourse/' . $cid) }}" id="prev_unit" data-unit="159231" class="unit unit_button"><span><< Back to Course</span></a></div>
                        <div class="col-md-3 text-center"><a href="{{ URL::to('/quizstart/' . $cid) }}" class="quiz_results_popup"><span>Start Exam</span></a></div>
                        <div class="col-md-4 text-center"><a href="{{ URL::to('/quizstart/' . $cid) }}" id="next_quiz" data-unit="159692" class="unit unit_button"><span>Proceed to Exam >></span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection