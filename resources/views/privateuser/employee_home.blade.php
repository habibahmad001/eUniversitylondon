@if(Auth::user()->status == "active")
    <script lang="javascript">
        window.location.href = "/logout";
    </script>
@endif
@extends('layouts.demo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 4% 0;">
            <div class="panel panel-default">
                <div class="panel-heading">Alert !</div>

                <div class="panel-body">
                    Congragulation you'r account has been created successfuly, But it's not active now, Please wait for the admin approval.
                    And <a href="/logout">Back Login</a> once you are active.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
