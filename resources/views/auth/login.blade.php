@extends('layouts.front')

@section('content')
<div class="banner">
    <div class="container">
        <div class="login-and-register">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], 'login') !== false || $_SERVER['REQUEST_URI'] == "/"){ active @endif">
                    <a class="nav-link @if (strpos($_SERVER['REQUEST_URI'], 'login') !== false || $_SERVER['REQUEST_URI'] == "/"){ active @endif" href="/login" role="tab" data-toggle="tab1">Login</a>
                </li>
                <li class="nav-item @if (strpos($_SERVER['REQUEST_URI'], 'register') !== false){ active @endif">
                    <a class="nav-link @if (strpos($_SERVER['REQUEST_URI'], 'register') !== false){ active @endif" href="/register" role="tab" data-toggle="tab1">Register</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade user-credentials @if (strpos($_SERVER['REQUEST_URI'], 'login') !== false || $_SERVER['REQUEST_URI'] == "/"){ active in @endif" id="login">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                         @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        @if ($errors->has('email'))
                        <span class="error-message" style="display:block">
                          {{ $errors->first('email') }}
                        </span>
                        @endif
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="|" name="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="|" name="password">
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                              <a href="{{url('/redirect')}}" class="btn btn-primary">Login with Facebook</a>
                            </div>
                        </div>

                        <button class="go-btn" type="" name="button">Go!</button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade user-credentials @if (strpos($_SERVER['REQUEST_URI'], 'register') !== false){ active in @endif" id="register">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class=" control-label">First Name</label>

                            <div class="">
                                <input id="first_name" type="text" class="form-control" placeholder="|" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                         <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class=" control-label">Last Name</label>

                            <div class="">
                                <input id="last_name" type="text" class="form-control" placeholder="|" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class=" control-label">E-Mail Address</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" placeholder="|" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class=" control-label">Phone Number</label>

                            <div class="">
                                <input id="phone" type="text" class="form-control" placeholder="|" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class=" control-label">Password</label>

                            <div class="">
                                <input id="password" type="password" placeholder="|" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Confirm Password</label>

                            <div class="">
                                <input id="password-confirm" placeholder="|" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <button class="go-btn" type="submit" name="submit">Go!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

