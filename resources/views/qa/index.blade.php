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
        @if(collect(request()->segments())->first() == "admin")
            @include('qa.parts.admin')
        @elseif(collect(request()->segments())->first() == "instructor")
            @include('qa.parts.instructor')
         @elseif(collect(request()->segments())->first() == "learner")
            @include('qa.parts.learner')
         @endif
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