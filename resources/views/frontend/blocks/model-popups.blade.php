<!-- search modal -->
<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <a href="index.html" class="logo">
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
                <h6 class="modal-title" id="formlogin">Log In</h6>
                <button type="button" class="btn btn-maincolor btn-sign">Sign Up</button>

            </div>
            <div class="modal-body">
                <div class="form-title">
                    <h2>Log In</h2>
                    <p>Log in to save your progress and obtain a certificate in Alison’s free Diploma in Web</p>
                </div>
                <form action="http://webdesign-finder.com/">
                    <div class="form-group has-placeholder">
                        <label for="email-logn">Email:</label>
                        <input type="email" class="form-control" id="email-logn" placeholder="Your email adress" name="email-logn">
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="password-login">Password:</label>
                        <input type="password" class="form-control" id="password-login" placeholder="Password" name="password">
                    </div>
                    <div class="social-account">
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
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">
                            Keep me logged in
                        </label>
                    </div>
                    <button type="submit" class="btn btn-maincolor log-btn">Log in</button>
                </form>
                <div class="modal-footer">
                    Dont have an Tutor account?<button type="button" class="btn-sign">Sign Up</button>
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
                <button type="button" class="btn btn-maincolor btn-login">Log in</button>
                <h6 class="modal-title" id="formsign">Sign Up</h6>
            </div>
            <div class="modal-body">
                <div class="form-title">
                    <h2>Sign up</h2>
                    <p>Sign up to save your progress and obtain a certificate in Alison’s free Diploma in Web</p>
                </div>
                <form action="http://webdesign-finder.com/">
                    <div class="form-group has-placeholder">
                        <label for="name-sigin">Your Name:</label>
                        <input type="text" class="form-control" id="name-sigin" placeholder="Enter your name" name="First name">
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="sigemail">Email:</label>
                        <input type="email" class="form-control" id="sigemail" placeholder="Your email adress" name="sigemail">
                    </div>
                    <div class="form-group has-placeholder">
                        <label for="sigpassword">Password:</label>
                        <input type="password" class="form-control" id="sigpassword" placeholder="password" name="sigpassword">
                    </div>
                    <div class="social-account">
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
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agree">
                        <label class="form-check-label agree" for="agree">
                            I agree to the Terms and Conditions
                        </label>
                        <input class="form-check-input" type="checkbox" id="updates">
                        <label class="form-check-label" for="updates">
                            Yes, I want to get the most out of Tutor by receiving tips, updates and exclusive offers.
                        </label>
                    </div>
                    <button type="submit" class="btn btn-maincolor btn-sign">Sign In</button>
                </form>
                <div class="modal-footer">
                    Already have an Alison account?<button type="button" class="btn-login">Log In</button>
                </div>
            </div>
        </div>
    </div>
</div>

