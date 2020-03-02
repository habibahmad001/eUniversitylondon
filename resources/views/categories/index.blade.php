@extends('layouts.app') 
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu') 
@include('categories.edit')
@include('categories.create')

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
                        </th>
                        <th>Category ID</th>
                        <th>Category Name</th>
                    </tr>
                </thead>
                @if(count($categories)) @foreach ($categories as $category)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $category->id }}"><img src="images/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                    </th>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category }}</td>
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
@include('../blocks/delete-form', ['model' => 'category'])
@endsection @section('js_libraries')
<script type="text/javascript" src="{{ asset('js/category.js')}}"></script>
@endsection