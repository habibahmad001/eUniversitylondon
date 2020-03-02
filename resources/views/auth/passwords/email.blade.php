@extends('layouts.reset')

@section('content')


<section class="banner">
            <div class="custom-container">
                <div class="row">
                    <div class="col-md-6 create-account">
                        <h2>Reset Password</h2>
                        @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="create-account-form reset-password-form ">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form id="reset_password" method="POST" action="{{ route('password.email') }}">
                                 {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default start-playing">Send Password Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
