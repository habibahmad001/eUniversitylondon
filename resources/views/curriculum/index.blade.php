@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('curriculum.edit')
@include('curriculum.create')

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
                        <th>Curriculum Title</th>
                        <th>Curriculum Content</th>
                        <th>Course Name</th>
                        @if(collect(request()->segments())->first() == "admin")
                            <th>Instructor Name</th>
                        @endif
                    </tr>
                </thead>
                @if(count($Curriculums)) @foreach ($Curriculums as $Curriculum)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $Curriculum->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_coursecurriculum[]" value="{{ $Curriculum->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Curriculum->curriculum_title }}</td>
                    <td>{{ $Curriculum->curriculum_content }}</td>
                    <td>{{ (array_key_exists($Curriculum->id, $Array_Course_Name)) ? $Array_Course_Name[$Curriculum->id] : "" }}</td>
                    @if(collect(request()->segments())->first() == "admin")
                        <td>{{ (array_key_exists($Curriculum->id, $Array_Instructor_Name)) ? $Array_Instructor_Name[$Curriculum->id] : "" }}</td>
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
            Total: <span>{{ $Curriculums->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Curriculums])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'coursecurriculum'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/curriculum.js')}}"></script>
@endsection