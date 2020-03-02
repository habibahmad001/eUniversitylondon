@extends('layouts.app') 
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu') 
@include('users.edit')
@include('users.create')

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
                        <th>Title</th>
                        <th>Is Parent</th>
                        <th>View Childs</th>
                    </tr>
                </thead>
                @if(count($categories)) @foreach ($categories as $cat)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $cat->id }}"><img src="images/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_user[]" value="{{ $cat->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $cat->category_title }}</td>
                    <td>{{ $cat->category_cid }}</td>
                    <td><a href="#">View Child</a></td>
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
            Total: <span>{{ $categories->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $categories])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'user'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/user.js')}}"></script>
@endsection