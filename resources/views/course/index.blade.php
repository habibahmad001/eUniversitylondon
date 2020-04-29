@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('course.edit')
@include('course.create')
@include('course.set_product')

<style>
    .fa-spinner {
        display: none;
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
                        <th width="20%">Course Content</th>
                        @if(collect(request()->segments())->first() == "admin" or collect(request()->segments())->first() == "instructor")
                            <th>Status</th>
                        @endif
                        @if(collect(request()->segments())->first() == "admin" or collect(request()->segments())->first() == "instructor")
                            <th>Number of User's</th>
                        @endif
                        @if(collect(request()->segments())->first() == "admin")
                            <th>Set As</th>
                        @endif
                        @if(collect(request()->segments())->first() == "admin")
                            <th>Instructor Name</th>
                        @endif
                    </tr>
                </thead>
                @if(count($Courses)) @foreach ($Courses as $Course)
                <tr>
                    <th class="edit-icon-container">
                        @if(collect(request()->segments())->first() != 'learner')
                            <span class="edit-icon" data-id="{{ $Course->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                        @endif
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_course[]" value="{{ $Course->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Course->course_title }}</td>
                    <td width="20%">{{ (strlen(strip_tags($Course->course_desc)) > 150) ? substr(strip_tags($Course->course_desc), 0, 150) . "..." : strip_tags($Course->course_desc) }}</td>
                    @if(collect(request()->segments())->first() == "instructor")
                        <td>
                            @if($Course->course_status == "no")
                                <button class="btn btn-warning">Pending</button>
                            @else
                                <button class="btn btn-success">Approved</button>
                            @endif
                        </td>
                    @endif
                    @if(collect(request()->segments())->first() == "admin")
                        <td>
                            @if($Course->course_status == "no")
                                <button type="button" class="btn btn-success approve-course" id="approve-course{{ $Course->id }}" data-id="{{ $Course->id }}" data-status="yes" value="">Approve It <!--i class="fa fa-spinner fa-pulse"></i--></button>
                            @else
                                <button type="button" class="btn btn-danger block-course" id="block-course{{ $Course->id }}" data-id="{{ $Course->id }}" data-status="no" value="">Block It <!--i class="fa fa-spinner fa-pulse"></i--></button>
                            @endif
                        </td>
                    @endif
                    @if(collect(request()->segments())->first() == "admin" or collect(request()->segments())->first() == "instructor")
                        <td><a href="{{ URL::to('/' . collect(request()->segments())->first() .'/students/' . $Course->id) }}">View User's({{ (array_key_exists($Course->id, $Array_User_Count)) ? $Array_User_Count[$Course->id] : 0 }}) </a> </td>
                    @endif
                    @if(collect(request()->segments())->first() == "admin")
                        <td><a href="javascript:void(0);" class="set-as" data-id="{{ $Course->id }}">Set As</a> </td>
                    @endif
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