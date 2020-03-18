@extends('layouts.app-admin')

@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-admin')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $page_title }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $msg }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
