@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('course.edit')
@include('course.create')
@include('course.set_product')

<style>
    .spinnerdiv {
        visibility: hidden;
        display: inline-block;
        position: absolute;
        /*margin-left: 3px;*/
    }
</style>

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
        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "admin")
            @include('course.parts.admin')
        @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == "instructor")
            @include('course.parts.instructor')
        @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == "learner")
           @include('course.parts.learner')
        @endif

    </div>
    <div class="pagination-container">
        <div class="number-container">
            Total: <span>{{ $Courses->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Courses])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'course'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/course.js')}}"></script>
@endsection