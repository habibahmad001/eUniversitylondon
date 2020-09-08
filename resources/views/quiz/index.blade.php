@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('quiz.edit')
@include('quiz.create')

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
                        <th>Quiz Title</th>
                        <th>{!! (collect(request()->segments())->first() == "admin" || collect(request()->segments())->first() == "instructor") ? "Quiz Question's" : "Obtained Mark's" !!}</th>
                        <th>Course Name</th>
                        @if(collect(request()->segments())->first() == "admin")
                            {{--<th>Instructor Name</th>--}}
                        @endif
                    </tr>
                </thead>
                @if(count($Quizs)) @foreach ($Quizs as $Quiz)
                <tr>
                    <th class="edit-icon-container">
                        @if(collect(request()->segments())->first() != 'learner')
                            <span class="edit-icon" data-id="{{ $Quiz->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                        @endif
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_quiz[]" value="{{ $Quiz->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Quiz->quiz_title }}</td>
                    <td>@if(collect(request()->segments())->first() == "admin" || collect(request()->segments())->first() == "instructor")<a href="/{{ collect(request()->segments())->first() }}/questionlist/{{ $Quiz->id }}/Quiz">No of Question's ({{ (App\Http\Controllers\QandAController::QuestionCount($Quiz->id, "Quiz")) ? App\Http\Controllers\QandAController::QuestionCount($Quiz->id, "Quiz") : 0 }})</a>@else <a href="javascript:void(0);">{!! (isset(App\Http\Controllers\Front\CourseController::GetQuizResult($Quiz->id, "Quiz")->result)) ? json_decode(App\Http\Controllers\Front\CourseController::GetQuizResult($Quiz->id, "Quiz")->result, true)["Result"]. " (".(json_decode(App\Http\Controllers\Front\CourseController::GetQuizResult($Quiz->id, "Quiz")->result, true)["MarksObtain"]).")" : 0 !!}</a> @endif</td>
                    <td>{{ (array_key_exists($Quiz->id, $Array_Course_Name)) ? $Array_Course_Name[$Quiz->id] : "" }}</td>
                    @if(collect(request()->segments())->first() == "admin")
                        {{--<td>{{ (array_key_exists($Quiz->id, $Array_Instructor_Name)) ? $Array_Instructor_Name[$Quiz->id] : "" }}</td>--}}
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
            Total: <span>{{ $Quizs->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Quizs])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'quiz'])

@endsection

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/quiz.js')}}"></script>
@endsection