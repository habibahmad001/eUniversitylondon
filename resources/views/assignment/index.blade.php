@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('assignment.edit')
@include('assignment.create')

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
                        <th>Assignment Title</th>
                        <th>Assignment File</th>
                        <th width="40%">Course Name</th>
                    </tr>
                </thead>
                @if(count($Assignment)) @foreach ($Assignment as $assignment)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $assignment->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_assignment[]" value="{{ $assignment->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $assignment->assignment_title }}</td>
                    <td>
                    @if(!empty($assignment->assignment_file))
                        <a href="{{asset('/uploads/assignment/') . "/" . $assignment->assignment_file}} " target="_blank">Download File</a>
                    @else
                       No file Uploaded
                    @endif
                    </td>
                    <td width="40%">{{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($assignment->course_id)->course_title }}</td>
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
            Total: <span>{{ $Assignment->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Assignment])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'assignment'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/assignment.js')}}"></script>
@endsection