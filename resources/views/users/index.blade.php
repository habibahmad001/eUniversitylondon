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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>
                            Username
                        </th>
                        <th>Email</th>
                        <th>Date/Time Added</th>
                    </tr>
                </thead>
                @if(count($users)) @foreach ($users as $user)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $user->id }}"><img src="images/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_user[]" value="{{ $user->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ Carbon\Carbon::parse($user->created_at)->format('F d, Y h:ia') }}</td>
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
            Total: <span>{{ $users->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $users])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'user'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/user.js')}}"></script>
@endsection