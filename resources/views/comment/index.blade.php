@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('comment.edit')
@include('comment.create')

<style>
    #edit-startsFrom, #edit-endsTo, #startsFrom, #endsTo{
        width: 70%;
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
                    <tr>
                        <th width="3%" class="edit-icon-container">&nbsp;</th>
                        <th width="2%" class="checkbox-container">
                            <input type="checkbox" name="all">
                        </th>
                        <th>Name</th>
                        <th>Comment Text</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if(count($Comment)) @foreach ($Comment as $v)
                <tr>
                    <th class="edit-icon-container">{{--<span class="edit-icon" data-id="{{ $v->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>--}}</th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_comment[]" value="{{ $v->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $v->name }}</td>
                    <td>@if(strlen(strip_tags($v->ccomment)) > 100) {{ substr(strip_tags($v->ccomment) , 0, 100). "..." }} @else {{ strip_tags($v->ccomment) }} @endif</td>
                    <td>{{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($v->course_id)->course_title }}</td>
                    <td>{{ Carbon\Carbon::parse($v->created_at)->format('F d, Y h:ia') }}</td>
                    <td><button type="button" class="btn btn-{{ ($v->status == "yes") ? "danger" : "success" }} w-93px" onclick="javascript:window.location.href='{{ URL::to('/admin/comments_blocked/' . $v->id) }}';">{!! ($v->status == "yes") ? "Block It" : "Approve It" !!}</button></td>
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
            Total: <span>{{ $Comment->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Comment])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'comment'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/comment.js')}}"></script>
@endsection