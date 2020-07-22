@extends('layouts.app-instructor')
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-instructor')

<style>
    .dash_table {
        border: 1px solid;
        width: 100%;
    }
    .dash_table thead {
        background: #cccccc;
        padding: 5px;
    }

    .dash_table tr {
        height: 35px;
        border-bottom: 1px solid;
    }

    .dash_table th, td {
        padding-left: 10px;
    }

    .table-set .row > div:nth-child(1) {
        padding-left: 3%;
    }

    .table-set .row > div:nth-child(2) {
        padding-right: 3%;
    }

    @media (max-width: 1770px) {
        .margin_17 {
            margin-left: 17%;
        }
    }
</style>
<div class="center-content-area table-set">
    <br />
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @auth
                @if(count(App\Http\Controllers\CoursesController::ExamInCourse()) > 0)
                    <div class="alert alert-danger" id="examMSG" role="alert" style="color: #843534; background: #f2dede;border-color: #ebccd1;">
                        <ul>
                            @foreach(App\Http\Controllers\CoursesController::ExamInCourse() as $k=>$v)
                                <li>{!! $v !!}</li>
                            @endforeach
                        </ul>
                        <div class="cancel"></div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-md-4 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Course</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        </tr>
                        <tr>
                            <th>Course Title</th>
                            <th>Course Description</th>
                        </tr>
                        </thead>
                        @if(count($courses)) @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->course_title }}</td>
                                <td>{{ (strlen(strip_tags($course->course_desc)) > 70) ? substr(strip_tags($course->course_desc), 0, 70) : strip_tags($course->course_desc) }}</td>
                            </tr>
                        @endforeach @else
                            <tr>
                                <th colspan="6" class="error">No results found</th>
                            </tr>
                            @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-4 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Exam</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        </tr>
                        <tr>
                            <th>Exam Title</th>
                            <th>Exam Description</th>
                        </tr>
                        </thead>
                        @if(count($exam)) @foreach ($exam as $exm)
                            <tr>
                                <td>{{ $exm->exam_title }}</td>
                                <td>@if(strlen(strip_tags($exm->exam_content)) > 70) {{ substr(strip_tags($exm->exam_content) , 0, 70). "..." }} @else {{ strip_tags($exm->exam_content) }} @endif</td>
                            </tr>
                        @endforeach @else
                            <tr>
                                <th colspan="6" class="error">No results found</th>
                            </tr>
                            @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-md-4 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Mock Exam</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        </tr>
                        <tr>
                            <th>Mock Exam Title</th>
                            <th>Mock Exam Description</th>
                        </tr>
                        </thead>
                        @if(count($mexam)) @foreach ($mexam as $mexm)
                            <tr>
                                <td>{{ $mexm->exam_title }}</td>
                                <td>@if(strlen(strip_tags($mexm->exam_content)) > 70) {{ substr(strip_tags($mexm->exam_content) , 0, 70). "..." }} @else {{ strip_tags($mexm->exam_content) }} @endif</td>
                            </tr>
                        @endforeach @else
                            <tr>
                                <th colspan="6" class="error">No results found</th>
                            </tr>
                            @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-4 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Curriculum</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        </tr>
                        <tr>
                            <th>Curriculum Title</th>
                            <th>Curriculum Description</th>
                        </tr>
                        </thead>
                        @if(count($coursecurriculum)) @foreach ($coursecurriculum as $curriculum)
                            <tr>
                                <td>{{ $curriculum->curriculum_title }}</td>
                                <td>@if(strlen(strip_tags($curriculum->curriculum_content)) > 70) {{ substr(strip_tags($curriculum->curriculum_content) , 0, 70). "..." }} @else {{ strip_tags($curriculum->curriculum_content) }} @endif</td>
                            </tr>
                        @endforeach @else
                            <tr>
                                <th colspan="6" class="error">No results found</th>
                            </tr>
                            @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
