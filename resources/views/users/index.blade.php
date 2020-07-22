@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('users.edit')
@include('users.create')

<!-- Edit form -->
<div class="center-content-area table-set">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <select name="pagename" id="pagename" class="form-control w-50 text-right" onchange="javascript:($(this).val() == 0) ? window.location.href='/admin/users' : window.location.href='/admin/' + $(this).val()">
                    <option value="0">-------- Select one ---------</option>
                    <option value="users">All</option>
                    <option value="instructor">Instructor</option>
                    <option value="learner">Learner</option>
                </select>
            </div>
        </div>
    </div>
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
                    <th class="edit-icon-container">
                        @if(collect(request()->segments())->pull(1) != 'students')
                            <span class="edit-icon" data-id="{{ $user->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                        @endif
                    </th>
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
                    <th colspan="7" class="error">No results found</th>
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