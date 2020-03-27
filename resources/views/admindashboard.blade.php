@extends('layouts.app-admin')
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-admin')

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
                <div class="panel-heading">Recent Users</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <th>User Email</th>
                        </tr>
                        </thead>
                        @if(count($users)) @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
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
                <div class="panel-heading">Recent Instructor</div>

                <div class="panel-body">
                    <table class="dash_table">
                        <tbody>
                        <thead>
                        </tr>
                        <tr>
                            <th>Instructor Name</th>
                            <th>Instructor Email</th>
                        </tr>
                        </thead>
                        @if(count($instructor)) @foreach ($instructor as $ins)
                            <tr>
                                <td>{{ $ins->first_name }} {{ $ins->last_name }}</td>
                                <td>{{ $ins->email }}</td>
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
            <div class="panel-heading">Recent Learner</div>

            <div class="panel-body">
                <table class="dash_table">
                    <tbody>
                    <thead>
                    </tr>
                    <tr>
                        <th>Learner Name</th>
                        <th>Learner Email</th>
                    </tr>
                    </thead>
                    @if(count($learner)) @foreach ($learner as $ler)
                        <tr>
                            <td>{{ $ler->first_name }} {{ $ler->last_name }}</td>
                            <td>{{ $ler->email }}</td>
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
            <div class="panel-heading">Recent Courses</div>

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
                            <td>{{ $course->course_desc }}</td>
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
