@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('exam.edit')
@include('exam.create')

<!-- Edit form -->
<div class="center-content-area table-set">
    <div class="table-responsive">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <table class="table">
            <tbody class="table">
                <thead>
                    </tr>
                    <tr>
                        <th width="3%" class="edit-icon-container">&nbsp;</th>
                        <th width="2%" class="checkbox-container">
                            <input type="checkbox" name="all">
                        </th>
                        <th>Exam's Title</th>
                        <th>{!! (collect(request()->segments())->first() == "admin" || collect(request()->segments())->first() == "instructor") ? "Exam Question's" : "Obtained Mark's" !!}</th>
                        <th>Course Name</th>
                        @if(collect(request()->segments())->first() == "admin")
                            <th>Instructor Name</th>
                        @endif
                    </tr>
                </thead>
                @if(count($Exams)) @foreach ($Exams as $Exam)
                <tr>
                    <th class="edit-icon-container">
                        @if(collect(request()->segments())->first() != 'learner')
                            <span class="edit-icon" data-id="{{ $Exam->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                        @endif
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_exam[]" value="{{ $Exam->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Exam->exam_title }}</td>
                    <td>@if(collect(request()->segments())->first() == "admin" || collect(request()->segments())->first() == "instructor")<a href="/{{ collect(request()->segments())->first() }}/questionlist/{{ $Exam->id }}">No of Question's ({{ (App\Http\Controllers\QandAController::QuestionCount($Exam->id)) ? App\Http\Controllers\QandAController::QuestionCount($Exam->id) : 0 }})</a>@else <a href="javascript:void(0);">{!! (isset(App\Http\Controllers\Front\CourseController::GetQuizResult($Exam->id)->result)) ? json_decode(App\Http\Controllers\Front\CourseController::GetQuizResult($Exam->id)->result, true)["Result"]. " (".(json_decode(App\Http\Controllers\Front\CourseController::GetQuizResult($Exam->id)->result, true)["MarksObtain"]).")" : 0 !!}</a> @endif</td>
                    <td>{{ (array_key_exists($Exam->id, $Array_Course_Name)) ? $Array_Course_Name[$Exam->id] : "" }}</td>
                    @if(collect(request()->segments())->first() == "admin")
                        <td>{{ (array_key_exists($Exam->id, $Array_Instructor_Name)) ? $Array_Instructor_Name[$Exam->id] : "" }}</td>
                    @endif
                </tr>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <div class="number-container">
            Total: <span>{{ $Exams->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Exams])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'exam'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/exam.js')}}"></script>
@endsection