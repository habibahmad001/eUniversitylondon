@extends('layouts.Instructor')

@section('content')

    <div class="admin-login-form-wraper">
        <div class="admin-login-form-container">
            <div class="login-form">

                <form id="login" method="POST" action="{{ route('login') }}" class="login-text-white">
                    {{ csrf_field() }}
                    <input type="hidden" name="formtype" id="formtype" value="instructor">
                    <div class="login-block">
                        <div class="form-group">
                            <label class="" for="email-address">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="">
                        </div>
                    </div>
                    <div class="login-block">
                        <div class="form-group">
                            <label class="" for="pwd">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="">
                            <input type="hidden" name="login_flag" class="form-control" value="admin">

                        </div>
                        <a class="underlined-text" href="password/reset">Forgot Password?</a>
                    </div>
                    <div class="login-btn">
                        <div class="form-group">
                            <button type="submit" name="submit_login" id="submit_login" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                    <?php // print_r($errors->all());?>
                    @if ($errors->any())
                        <p class="text-center verification-error alert alert-warning">@foreach ($errors->all() as $error){{ $error }} @endforeach</p>
                    @endif

                </form>
            </div>
        </div>
    </div>

@endsection

