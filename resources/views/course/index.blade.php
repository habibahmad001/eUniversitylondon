@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('course.edit')
@include('course.create')
@include('course.set_product')
@include('course.specialOffer')

<style>
    .spinnerdiv {
        visibility: hidden;
        display: inline-block;
        position: absolute;
        /*margin-left: 3px;*/
    }
    #startdate, #enddate{
         width: 70%;
     }
    .spacialOffer .form-line * {
        display: inline-block;
    }


    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #e3eaef;
        border-radius: .25rem;
    }
    .p-0 {
        padding: 0!important;
    }
    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.5rem;
    }
    .no-gutters {
        margin-right: 0;
        margin-left: 0;
    }
    .text-secondary {
        color: #6c757d!important;
    }
    .card {
        border: none;
        -webkit-box-shadow: 0 0 35px 0 rgba(154,161,171,.15);
        box-shadow: 0 0 35px 0 rgba(154,161,171,.15);
        margin-bottom: 30px;
    }
    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.5rem;
    }
    .text-muted {
        color: #98a6ad!important;
    }
    .font-15 {
        font-size: 15px!important;
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