@extends('layouts.app-admin')
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu-admin')
@include('termservices.edit')
@include('termservices.create')

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
                        <th>Term And Services Title</th>
                        <th width="40%">Term And Services Content</th>
                    </tr>
                </thead>
                @if(count($TermAndServices)) @foreach ($TermAndServices as $TermAndService)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $TermAndService->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_termandservices[]" value="{{ $TermAndService->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $TermAndService->termandservices_title }}</td>
                    <td width="40%">@if(strlen(strip_tags($TermAndService->termandservices_desc)) > 350) {{ substr(strip_tags($TermAndService->termandservices_desc) , 0, 350). "..." }} @else {{ strip_tags($TermAndService->termandservices_desc) }} @endif</td>
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
            Total: <span>{{ $TermAndServices->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $TermAndServices])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'termandservices'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/termservices.js')}}"></script>
@endsection