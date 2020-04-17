<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{{ asset('images/favicons.ico') }}}">
    <title>Template</title>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/front.js') }}" type="text/javascript"></script>
	
	<!-- CSRF Token -->
  	<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrapLive.min.css') }}">
    <link href="{{ asset('css/style-new.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
</head>

<body>

    <div class="wrapper">
        <!-- Header Starts Here -->

        <header>
            <div class="container-fluid">
                <div class="logo-txt">
                    <a href="/">JobsToday</a>
                </div>
                <div class="login-form">
                	
                    <form id="login" method="POST" action="{{ route('login') }}">
                    	{{ csrf_field() }}
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
                                
                            </div>
                            <a class="underlined-text" href="password/reset">Forgot Password?</a>
                        </div>
                        <div class="login-btn">
                            <div class="form-group">
                                <button type="submit" name="submit_login" id="submit_login" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                        <?php print_r($errors->all());?>
                        @if ($errors->any())
                        <p class="text-center verification-error alert alert-warning">@foreach ($errors->all() as $error){{ $error }} @endforeach</p>
                        @endif

                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </header>
		{{-- @yield('content') --}}
        <!-- Banner Starts Here -->
        <section class="menu-section">
            <ul class="menu-ul">
                <li><a href="/">Home</a></li>
                <li><a href="/jobs/">Jobs</a></li>
                <li><a href="/contactus/">Contact us</a></li>
            </ul>
        </section>
        <section class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 desktop-img">
                        <div class="home-search">
                            <form id="search" method="POST" action="{{ route('search') }}">

                                <h2>Search Section</h2><input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                <input type="text" name="what" class="search-what" id="what" placeholder="What">
                                <select name="where-select" class="search-where" id="where-select">
                                    <option value="where">Where</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->location_title }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="super-quiz-img default-box-shadow" id="search-result">
                            <h4>Recent Jobs List</h4>
                            <hr width="100%" />
                            @if(isset($Jobs))
                                @foreach($Jobs as $job)
                                    <p><a href='/jobdetail/{{ $job->id }}'>{{ $job->job_title }}</a></p>
                                @endforeach
                            @else
                                No result found !
                            @endif
                        </div>

                    </div>
                    <div class="col-md-5 create-account">
                        <h2>Create Account</h2>
                        <div class="create-account-form">
                            <form id="signup"  method="POST" action="{{ route('register') }}">
								{{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" id="email_signup" class="form-control" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="con_email" id="con_email_signup" class="form-control" placeholder="Confirm Email" oninput="check(this);">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password_signup" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <select name="user_type" class="search-where" id="user_type">
                                                <option value="where">Please select type</option>
                                                <option value="employee">Employee</option>
                                                <option value="employer">Employer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit_signup" id="submit_signup" class="btn btn-default start-playing">Sign Up</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Starts Here -->

        <footer>
            <p class="copyrights">Copyright © 2020 eUniversitylondon. All Rights Reserved.</p>
        </footer>
    </div>


    
</body>

</html>
<script>

		    function check(input) {
		        if (input.value != document.getElementById('email').value) {
		            input.setCustomValidity('Password Must be Matching.');
		        } else {
		            // input is valid -- reset the error message
		            input.setCustomValidity('');
		        }
		    }
    </script>