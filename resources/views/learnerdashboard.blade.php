@extends('layouts.app-learner')
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-learner')

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
        <div class="col-sm-9 col-md-4 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Course</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        <tr>
                            <th>Course Title</th>
                            <th>Course Description</th>
                        </tr>
                        </thead>
                        @if(count($courses)) @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->course_title }}</td>
                                <td>{{ (strlen(strip_tags($course->course_desc)) > 350) ? substr(strip_tags($course->course_desc), 0, 350) : strip_tags($course->course_desc) }}</td>
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
                        <tr>
                            <th>Exam Title</th>
                            <th>Exam Description</th>
                        </tr>
                        </thead>
                        @if(count($exam)) @foreach ($exam as $exm)
                            <tr>
                                <td>{{ $exm->exam_title }}</td>
                                <td>{{ (strlen(strip_tags($exm->exam_content)) > 350) ? substr(strip_tags($exm->exam_content), 0, 350) : strip_tags($exm->exam_content) }}</td>
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
                        <tr>
                            <th>Mock Exam Title</th>
                            <th>Mock Exam Description</th>
                        </tr>
                        </thead>
                        @if(count($mexam)) @foreach ($mexam as $mexm)
                            <tr>
                                <td>{{ $mexm->exam_title }}</td>
                                <td>{{ (strlen(strip_tags($mexm->exam_content)) > 350) ? substr(strip_tags($mexm->exam_content), 0, 350) : strip_tags($mexm->exam_content) }}</td>
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
