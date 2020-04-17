@extends('layouts.app-admin')
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu-admin')
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
                            <input type="checkbox" name="all">
                        </th>
                        <th>Title</th>
                        <th>Is Parent</th>
                        @if(collect(request()->segments())->pull(1) != 'childitem')
                            <th>View Childs</th>
                        @endif
                    </tr>
                </thead>
                @if(count($categories)) @foreach ($categories as $cat)
                <tr>
                    <th class="edit-icon-container">
                            <span class="edit-icon" data-id="{{ $cat->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_categories[]" value="{{ $cat->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $cat->category_title }}</td>
                    <td>@if(empty($cat->category_cid)) Yes @else No @endif</td>
                    <!--td>@if($categories->total() > 0)<a href="/admin/childitem/{{ $cat->id }}">View Child</a> @else No Child @endif</td-->
                    @if(collect(request()->segments())->pull(1) != 'childitem')
                        <td>@if(App\Http\Controllers\Category::HasSubItem($cat->id) == 0) Has no child @else <a href="/admin/childitem/{{ $cat->id }}">View Child {{ App\Http\Controllers\Category::ChildCount($cat->id) }}</a> @endif</td>
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
            Total: <span>{{ $categories->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $categories])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'categories'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/categories.js')}}"></script>
@endsection