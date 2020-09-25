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


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h3>Exams Results</h3> <br />
                        <table width="100%" border="1px">
                            <thead>
                                <td>Title</td>
                                <td>Mark's</td>
                                <td>Date</td>
                                <td>Action</td>
                            </thead>
                            @if(count($ResultData) > 0)
                                <?php $count = 1;?>
                                @foreach($ResultData as $v)
                                    <tr>
                                        <td>
                                            @if($count == 1)
                                                First Attempt
                                            @elseif($count == 2)
                                                Second Attempt
                                            @elseif($count == 3)
                                                Third Attempt
                                            @elseif($count == 4)
                                                Fourth Attempt
                                            @elseif($count == 5)
                                                Fifth Attempt
                                            @elseif($count == 6)
                                                Sixth Attempt
                                            @endif
                                        </td>
                                        <td>{!! json_decode($v->result, true)["Result"] !!} ({!! json_decode($v->result, true)["MarksObtain"] !!})</td>
                                        <td>{{ Carbon\Carbon::parse($v->created_at)->format('F d, Y h:ia') }}</td>
                                        <td><a href="{{URL::to("/courseresult/Exam/" . $cid . "/" . $v->exam_id)}}"> View Detail</a></td>
                                    </tr>
                                        <?php $count++;?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No record found !!!</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                </div>
            </div><br /><br />
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h3>Mock Exams Results</h3> <br />
                        <table width="100%" border="1px">
                            <thead>
                            <td>Title</td>
                            <td>Mark's</td>
                            <td>Date</td>
                            <td>Action</td>
                            </thead>
                            @if(count($MockResultData) > 0)
                                <?php $mcount = 1;?>
                                @foreach($MockResultData as $v)
                                    <tr>
                                        <td>
                                            @if($mcount == 1)
                                                First Attempt
                                            @elseif($mcount == 2)
                                                Second Attempt
                                            @elseif($mcount == 3)
                                                Third Attempt
                                            @elseif($mcount == 4)
                                                Fourth Attempt
                                            @elseif($mcount == 5)
                                                Fifth Attempt
                                            @elseif($mcount == 6)
                                                Sixth Attempt
                                            @endif
                                        </td>
                                        <td>{!! json_decode($v->result, true)["Result"] !!} ({!! json_decode($v->result, true)["MarksObtain"] !!})</td>
                                        <td>{{ Carbon\Carbon::parse($v->created_at)->format('F d, Y h:ia') }}</td>
                                        <td><a href="{{URL::to("/courseresult/MockExam/" . $cid . "/" . $v->exam_id)}}"> View Detail</a></td>
                                    </tr>
                                    <?php $mcount++;?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No record found !!!</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                </div>
            </div><br /><br />
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h3>Quiz Results</h3> <br />
                        <table width="100%" border="1px">
                            <thead>
                            <td>Title</td>
                            <td>Mark's</td>
                            <td>Date</td>
                            <td>Action</td>
                            </thead>
                            @if(count($QuizResultData) > 0)
                                @foreach($QuizResultData as $v)
                                    <tr>
                                        <td>{!! App\Http\Controllers\Front\CourseController::GetQuizData($v->exam_id)->quiz_title !!}</td>
                                        <td>{!! json_decode($v->result, true)["Result"] !!} ({!! json_decode($v->result, true)["MarksObtain"] !!})</td>
                                        <td>{{ Carbon\Carbon::parse($v->created_at)->format('F d, Y h:ia') }}</td>
                                        <td><a href="{{URL::to("/courseresult/Quiz/" . $cid . "/" . $v->exam_id)}}"> View Detail</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No record found !!!</td>
                                </tr>
                            @endif
                        </table>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('frontend.blocks.prevnext')
                </div>
            </div>
        </div>
    </section>

@endsection