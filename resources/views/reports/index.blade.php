@extends('layouts.app-admin')
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu-admin')

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
                        <th>Enrolled course</th>
                        <th>Enrolment date</th>
                        <th>Total amount</th>
                        <th>Admin revenue</th>
                        {{--<th>Actions</th>--}}
                    </tr>
                </thead>
                @if(count($Reports)) @foreach ($Reports as $outer) @foreach (json_decode($outer->val, true) as $v)
                <tr>
                    <th class="edit-icon-container">&nbsp;</th>
                    <td>{{ $v[1] }}</td>
                    <td>{{ Carbon\Carbon::parse($outer->created)->format('F d, Y') }}</td>
                    <td>&pound; {{ ($TotalPrice[$outer->id]) ? $TotalPrice[$outer->id] : 0 }} for {{ $outer->order_items }} items</td>
                    <td>&pound; {{ (20/100)*$v[3] }}</td>
                    {{--<td><a href="{{ URL::to("/admin/vieworder/" . $v->id) }}" class="woocommerce-button btn btn-outline-maincolor view">View</a></td>--}}
                </tr>
                @endforeach @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <div class="number-container">
            Total: <span>{{ $Reports->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Reports])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'Reports'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/cms.js')}}"></script>
@endsection