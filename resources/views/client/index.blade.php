@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('client.edit')
@include('client.create')

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
                        <th>Client Name</th>
                        <th>Client Logo</th>
                    </tr>
                </thead>
                @if(count($Client)) @foreach ($Client as $cli)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $cli->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_client[]" value="{{ $cli->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $cli->client_name }}</td>
                    <td>
                    @if(!empty($cli->client_logo))
                        <a href="{{asset('/uploads/client/') . "/" . $cli->client_logo}} " target="_blank">Download File</a>
                    @else
                       No file Uploaded
                    @endif
                    </td>
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
            Total: <span>{{ $Client->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Client])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'client'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/client.js')}}"></script>
@endsection