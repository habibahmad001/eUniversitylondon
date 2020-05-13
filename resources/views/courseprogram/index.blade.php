@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('courseprogram.edit')
@include('courseprogram.create')

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
                        <th>Course Program Title</th>
                        <th>Course Program Description</th>
                        <th>Course Name</th>
                    </tr>
                </thead>
                @if(count($CourseProgram)) @foreach ($CourseProgram as $cp)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $cp->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_courseprogram[]" value="{{ $cp->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $cp->cp_title }}</td>
                    <td>@if(strlen(strip_tags($cp->cp_desc)) > 150) {{ substr(strip_tags($cp->cp_desc) , 0, 150). "..." }} @else {{ strip_tags($cp->cp_desc) }} @endif</td>
                    <td>{{ (array_key_exists($cp->id, $Array_Course_Name)) ? $Array_Course_Name[$cp->id] : "" }}</td>
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
            Total: <span>{{ $CourseProgram->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $CourseProgram])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'courseprogram'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/courseprogram.js')}}"></script>
@endsection