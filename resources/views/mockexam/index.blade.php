@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('mockexam.edit')
@include('mockexam.create')

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
                        <th>Exam's Title</th>
                        <th>Exam's Content</th>
                        <!--th>Curriculum Course</th-->
                    </tr>
                </thead>
                @if(count($Exams)) @foreach ($Exams as $Exam)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $Exam->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_mockexam[]" value="{{ $Exam->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Exam->exam_title }}</td>
                    <td>{{ $Exam->exam_content }}</td>
                    <!--td>{{ $Exam->exam_status }}</td-->
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
            Total: <span>{{ $Exams->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Exams])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'mockexam'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/mockexam.js')}}"></script>
@endsection