@extends('layouts.app-admin')
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu-admin')

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">

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
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Enrolled course</th>
                    <th>Enrolment date</th>
                    <th>Instructor</th>
                    <th>Total amount</th>
                    <th>Instructor revenue</th>
                </tr>
                </thead>
                <tbody>
                @if(count($Reports)) @foreach ($Reports as $outer) @foreach (json_decode($outer->val, true) as $v)
                    @if(App\Http\Controllers\OrderController::GetUserOnID(App\Http\Controllers\Front\UserFrontController::GetCourseOnID($v[4])->course_user_id)->user_type != "admin")
                        <tr>
                            <td>{{ $v[1] }}</td>
                            <td>{{ Carbon\Carbon::parse($outer->created)->format('F d, Y') }}</td>
                            <td>{{ App\Http\Controllers\OrderController::GetUserOnID(App\Http\Controllers\Front\UserFrontController::GetCourseOnID($v[4])->course_user_id)->last_name  }}</td>
                            <td>&pound; {{ ($TotalPrice[$outer->id]) ? $TotalPrice[$outer->id] : 0 }} for {{ $outer->order_items }} items</td>
                            <td>&pound; {{ (80/100)*$v[3] }}</td>
                            {{--<td><a href="{{ URL::to("/admin/vieworder/" . $v->id) }}" class="woocommerce-button btn btn-outline-maincolor view">View</a></td>--}}
                        </tr>
                    @endif @endforeach @endforeach @else
                    <tr>
                        <th colspan="6" class="error">No results found</th>
                    </tr>
                @endif
                </tbody>
                {{--<tfoot>--}}
                {{--<tr>--}}
                    {{--<th>Enrolled course</th>--}}
                    {{--<th>Enrolment date</th>--}}
                    {{--<th>Instructor</th>--}}
                    {{--<th>Total amount</th>--}}
                    {{--<th>Admin revenue</th>--}}
                {{--</tr>--}}
                {{--</tfoot>--}}
            </table>
    </div>
    {{--<div class="pagination-container">--}}
        {{--<div class="number-container">--}}
            {{--Total: <span>{{ $Reports->total() }}</span>--}}
        {{--</div>--}}
        {{--<nav aria-label="Page navigation">--}}
            {{--@include('pagination.default', ['paginator' => $Reports])--}}
        {{--</nav>--}}
    {{--</div>--}}
</div>
@include('../blocks/delete-form', ['model' => 'Reports'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/cms.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script language="JavaScript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection