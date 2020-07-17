<!-- search modal -->
<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <a href="{{ URL::to("/") }}" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="">
        <span class="logo-text color-darkgrey">eUniversityLondon</span>
    </a>
    <div class="widget widget_search">
        <form method="get" class="searchform search-form" action="http://webdesign-finder.com/">
            <div class="form-group">
                <input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input">
            </div>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>
</div>

<!-- Unyson messages modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
    <div class="fw-messages-wrap ls p-normal">
        <!-- Uncomment this UL with LI to show messages in modal popup to your user: -->
        <!--
    <ul class="list-unstyled">
        <li>Message To User</li>
    </ul>
    -->
    </div>
</div><!-- eof .modal -->

<div class="modal fade login-form text-center" id="form1" tabindex="-1" role="dialog" aria-labelledby="formlogin" aria-hidden="true">
    <div class="modal-dialog ls">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-header">
                <h6 class="modal-title sign-mod" id="formlogin">Sign Up</h6>
                <button type="button" class="btn btn-maincolor btn-sign login-mod">Log In</button>

            </div>
            <div class="modal-body">
                <div class="form-title">
                    <h2>Log In</h2>
                    <p>Log in to save your progress and obtain a certificate in Alison’s free Diploma in Web</p>
                </div>
                <form  id="login" method="POST" action="/homelogin" onSubmit="return login_validate('');">
                    {{ csrf_field() }}
                    <div class="form-group has-placeholder">
                        <label for="email-login">Email:</label>
                        <input type="email" class="form-control" id="email-login" placeholder="Your email adress" name="email">
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="password-login">Password:</label>
                        <input type="password" class="form-control" id="password-login" placeholder="Password" name="password">
                    </div>
                    <!--div class="social-account">
                        <h6>
                            or
                        </h6>
                        <h6>
                            Sign up with your Social Account
                        </h6>
                        <span class="social-icons">
								<a href="#" class="fa fa-facebook " title="facebook"></a>
								<a href="#" class="fa fa-twitter " title="twitter"></a>
								<a href="#" class="fa fa-paper-plane " title="telegram"></a>
								<a href="#" class="fa fa-linkedin " title="linkedin"></a>
								<a href="#" class="fa fa-instagram " title="instagram"></a>
								<a href="#" class="fa fa-youtube-play " title="youtubsssssse"></a>
							</span>
                    </div-->
                    <div class="form-check">
                            <a href="{{ URL::to("/forgotpassword") }}">Forgot password</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-maincolor log-btn">Log In</button>
                </form>
                <div class="modal-footer">
                    Dont have an Tutor account?<button type="button" class="btn-sign sign-mod">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade sigin-form text-center" id="form2" tabindex="-1" role="dialog" aria-labelledby="formsign" aria-hidden="true">
    <div class="modal-dialog ls">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-header">
                <button type="button" class="btn btn-maincolor btn-login sign-mod">Sign Up</button>
                <h6 class="modal-title login-mod" id="formsign">Log In</h6>
            </div>
            <div class="modal-body">
                <div class="form-title">
                    <h2>Sign up</h2>
                    <p>Sign up to save your progress and obtain a certificate in Alison’s free Diploma in Web</p>
                </div>
                <form method="POST" action="/homesignup" enctype="multipart/form-data" onSubmit="return validate('');">
                    {{ csrf_field() }}
                    <div class="form-group has-placeholder">
                        <input type="hidden" name="status" id="status" value="active">
                        <label for="first_name">First Name:</label>
                        <input id="first_name" type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" autofocus>
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="last_name">Last Name:</label>
                        <input id="last_name" type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="email">Email:</label>
                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="phone">Phone Number:</label>
                        <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-placeholder">
                        <select class="form-control" name="user_type" id="user_type">
                            <option value="instructor">Instructor</option>
                            <option value="learner">Learner</option>
                        </select>
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="password">Password:</label>
                        <input id="password" type="password" class="form-control" placeholder="Password" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="sigpassword">Confirm Password:</label>
                        <input id="sigpassword" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                        <div id="password-match"></div>
                    </div>
                    <!--div class="social-account">
                        <h6>
                            or
                        </h6>
                        <h6>
                            Sign up with your Social Account
                        </h6>
                        <span class="social-icons">
								<a href="#" class="fa fa-facebook " title="facebook"></a>
								<a href="#" class="fa fa-twitter " title="twitter"></a>
								<a href="#" class="fa fa-paper-plane " title="telegram"></a>
								<a href="#" class="fa fa-linkedin " title="linkedin"></a>
								<a href="#" class="fa fa-instagram " title="instagram"></a>
								<a href="#" class="fa fa-youtube-play " title="youtube"></a>
							</span>
                    </div-->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="agree" id="agree">
                        <label class="form-check-label agree" for="agree" id="l-agree">
                            I agree to the Terms and Conditions
                        </label>
                        <input class="form-check-input" type="checkbox" name="updates" id="updates">
                        <label class="form-check-label" for="updates" id="l-updates">
                            Yes, I want to get the most out of Tutor by receiving tips, updates and exclusive offers.
                        </label>
                    </div>
                    <button type="submit" class="btn btn-maincolor btn-sign">Sign Up</button>
                </form>
                <div class="modal-footer">
                    Already have an Alison account?<button type="button" class="btn-login login-mod">Log In</button>
                </div>
            </div>
        </div>
    </div>
</div>

