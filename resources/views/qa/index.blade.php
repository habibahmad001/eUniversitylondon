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
                        <th>Title</th>
                        <th>Is Parent</th>
                        @if(collect(request()->segments())->pull(1) != 'childitem')
                            <th>View Answers</th>
                        @endif
                    </tr>
                </thead>
                @if(count($QandA)) @foreach ($QandA as $qa)
                <tr>
                    <th class="edit-icon-container">
                            <span class="edit-icon" data-id="{{ $qa->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_qanda[]" value="{{ $qa->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $qa->qa_title }}</td>
                    <td>@if(empty($qa->qa_cid)) Yes @else No @endif</td>
                    <!--td>@if($QandA->total() > 0)<a href="/admin/childitem/{{ $qa->id }}">View Answers</a> @else No Child @endif</td-->
                    @if(collect(request()->segments())->pull(1) != 'childqa')
                        <td> @if(App\Http\Controllers\QandAController::HasItems($qa->id) == 0) Has no answer @else <a href="/{{ collect(request()->segments())->first() }}/childqa/{{ $qa->id }}">View Answers {{ App\Http\Controllers\QandAController::AnswerCount($qa->id) }}</a> @endif </td>
                    @else
                        <td>It's Answers</td>
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
@include('../blocks/delete-form', ['model' => 'QandA'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/qanda.js')}}"></script>
@endsection