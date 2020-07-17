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

    <form method="post" name="result-frm" id="result-frm" action="{{ URL::to('/saveresult') }}">
        <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75 shop-order-received">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($ExamData) > 0)
                        <h5>{{ (isset($DBTable) && $DBTable == "Exam") ? $DBTable : "Mock Exam"}}: {{ $ExamData[0]->exam_title }}</h5>
                        @if(count($QandAData) > 0)
                            <ul class="qa-outer">
                            @foreach($QandAData as $v)
                                <li class="qa-question-section"><b>Q.</b> {{ $v->qa_title }}
                                    @if(count(App\Http\Controllers\Front\CourseController::GetAnswer($ExamData[0]->id, $DBTable, $v->id)) > 0)
                                        <ul class="qa-inner">
                                        @foreach(App\Http\Controllers\Front\CourseController::GetAnswer($ExamData[0]->id, $DBTable, $v->id) as $answer)
                                                <li><input type="radio" name="{{ $v->id }}" value="{{ $answer->id }}">{{ $answer->qa_title }}</li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        @else
                            <div>No Question setup yet by instructor !!!</div>
                        @endif
                    @else
                        <div>No exam setup yet by instructor !!!</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div>
                        {{ csrf_field() }}
                        <input type="hidden" name="course" value="{{ (isset($cid)) ? $cid : 0}}">
                        <input type="hidden" name="exam" value="{{ (isset($ExamData[0]->id)) ? $ExamData[0]->id : 0}}">
                        <input type="hidden" name="DBTable" value="{{ (isset($DBTable)) ? $DBTable : ""}}">
                        <button type="button" class="btn btn-outline-primary" onclick="javascript:window.location.href='{{ URL::to("/startcourse/" . $cid) }}';">Cancel</button>
                        <button type="button" class="btn btn-outline-success" onclick="javascript:$('#result-frm').submit();">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>

@endsection