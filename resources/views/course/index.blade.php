@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('course.edit')
@include('course.create')

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
                        <th>Course Title</th>
                        <th>Course Content</th>
                        <th>Number of User's</th>
                        @if(collect(request()->segments())->first() == "admin")
                            <th>Instructor Name</th>
                        @endif
                    </tr>
                </thead>
                @if(count($Courses)) @foreach ($Courses as $Course)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $Course->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_course[]" value="{{ $Course->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Course->course_title }}</td>
                    <td>{{ $Course->course_desc }}</td>
                    <td><a href="#">View User's({{ (array_key_exists($Course->id, $Array_User_Count)) ? $Array_User_Count[$Course->id] : 0 }}) </a> </td>
                    @if(collect(request()->segments())->first() == "admin")
                        <td>{{ (array_key_exists($Course->id, $Array_Instructor_Name)) ? $Array_Instructor_Name[$Course->id] : "" }}</td>
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