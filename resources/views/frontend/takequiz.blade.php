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
                    @if(count($ExamData) > 0)
                        <h1>Final Exam : {{ $ExamData[0]->exam_title }}</h1>
                    @else
                        <div>No exam setup yet by instructor !!!</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection