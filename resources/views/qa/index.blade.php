@extends('layouts.app-' . collect(request()->segments())->first())
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('qa.edit')
@include('qa.create')

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
                        <th>{!! (collect(request()->segments())->pull(1) == 'childqa') ? "Answer" : "Question" !!}</th>
                        <th>{!! (collect(request()->segments())->pull(1) == 'childqa') ? "Question Name" : "Exam Name" !!}</th>
                        <th>View Answers</th>
                        @if(collect(request()->segments())->pull(1) == 'childqa')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                @if(count($QandA)) @foreach ($QandA as $qa)
                <tr>
                    <th class="edit-icon-container">
                            <span class="edit-icon" data-id="{{ $qa->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_questionandanswer[]" value="{{ $qa->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $qa->qa_title }}</td>
                    <td>{!! (collect(request()->segments())->pull(1) == 'childqa') ? App\Http\Controllers\QandAController::QuestionData($qa->qa_cid)->qa_title : App\Http\Controllers\QandAController::ExamData($qa->exam_qa_id)->exam_title !!}</td>
                    <!--td>@if($QandA->total() > 0)<a href="/admin/childitem/{{ $qa->id }}">View Answers</a> @else No Child @endif</td-->
                    @if(collect(request()->segments())->pull(1) != 'childqa')
                        <td> @if(App\Http\Controllers\QandAController::HasItems($qa->id) == 0) <a href="/{{ collect(request()->segments())->first() }}/childqa/{{ $qa->id }}">Has no answer {{ App\Http\Controllers\QandAController::AnswerCount($qa->id) }}</a> @else <a href="/{{ collect(request()->segments())->first() }}/childqa/{{ $qa->id }}">View Answers {{ App\Http\Controllers\QandAController::AnswerCount($qa->id) }}</a> @endif </td>
                    @else
                        <td>It's Answers</td>
                    @endif
                    @if(collect(request()->segments())->pull(1) == 'childqa')
                        <td>{!! ($qa->isCorrect == "no") ? '<button type="button" class="btn btn-danger" onclick="javascript:window.location.href=\'/'.collect(request()->segments())->first().'/updateansstatus/'.$qa->id.'\';">Mark as Correct</button>' : '<button type="button" class="btn btn-success" onclick="javascript:window.location.href=\'/'.collect(request()->segments())->first().'/updateansstatus/'.$qa->id.'\';">Mark as Wrong</button>' !!}</td>
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
            Total: <span>{{ $QandA->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $QandA])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'questionandanswer'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/qanda.js')}}"></script>
@endsection