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
                        <th width="2%" class="checkbox-container">
                            <input type="checkbox" name="all">
                        </th>
                        <th>Order</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        {{--<th>Actions</th>--}}
                    </tr>
                </thead>
                @if(count($Orders)) @foreach ($Orders as $v)
                <tr>
                    <th class="edit-icon-container">&nbsp;</th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_Order[]" value="{{ $v->id }}" class="checkbox-selector">
                    </th>
                    <td>#{{ str_pad($v->order_id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ App\Http\Controllers\OrderController::GetUserOnID($v->user_id)->first_name }}</td>
                    <td>{{ Carbon\Carbon::parse($v->created)->format('F d, Y') }}</td>
                    <td>{{ $v->order_state }}</td>
                    <td>${{ ($TotalPrice[$v->id]) ? $TotalPrice[$v->id] : 0 }} for {{ $v->order_items }} items</td>
                    {{--<td><a href="{{ URL::to("/admin/vieworder/" . $v->id) }}" class="woocommerce-button btn btn-outline-maincolor view">View</a></td>--}}
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
            Total: <span>{{ $Orders->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Orders])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'Order'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/cms.js')}}"></script>
@endsection