@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('coupan.edit')
@include('coupan.create')

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
                        <th>Promo code</th>
                        <th>Description</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Value</th>
                    </tr>
                </thead>
                @if(count($Coupan)) @foreach ($Coupan as $v)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $v->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_coupan[]" value="{{ $v->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $v->title }}</td>
                    <td>@if(strlen(strip_tags($v->ccomments)) > 100) {{ substr(strip_tags($v->ccomments) , 0, 100). "..." }} @else {{ strip_tags($v->ccomments) }} @endif</td>
                    <td>{{ Carbon\Carbon::parse($v->startsFrom)->format('F d, Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($v->endsTo)->format('F d, Y') }}</td>
                    <td>{{ $v->value }} %</td>
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
            Total: <span>{{ $Coupan->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Coupan])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'coupan'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/coupan.js')}}"></script>
@endsection