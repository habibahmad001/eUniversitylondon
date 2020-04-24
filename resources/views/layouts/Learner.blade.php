<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>eUniversityLondon</title>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

	  	<!-- CSRF Token -->
	  	<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrapLive.min.css') }}">
        <link href="{{ asset('css/style-learner.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Font  -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="login-page">
                <!-- Header Starts Here  -->
                <header>
                    <!--div class="menu right">
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><img src="{{ asset('images/menu-icon.png') }}" alt=""></a>
                            <ul class="dropdown-menu popover">
                            @if (Auth::check())
                                <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
                            @else
                                <li><a href="{{ URL::to('/login') }}">Login</a></li>
                                <li><a href="{{ URL::to('/register') }}">Registered</a></li>
                            @endif
                            </ul>
                        </div>
                    </div-->
                        <div class="col-md-12 center header-title">
                            Learner Login Area
                        </div>
                    <div class="clear"></div>
                </header>
                <!-- Header Ends Here  -->
                <!-- Banner Starts Here  -->

                @yield('content')

                <!-- Banner Ends Here  -->
                <!-- Content Starts Here  -->
                <div class="content-1">
                </div>
                <!-- Content Ends Here  -->
                <!-- Footer Starts Here  -->
                <!--footer>
                    <div class="container">
                        <div class="social">
                            <ul>
                                <li>
                                    <a href="">
                                    <span>
                                    <i class="fa fa-instagram fa-lg " aria-hidden="true"></i>
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    <span>
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                    <span>
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="copyrights-and-sponsor">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Copyright © 2020. All Rights Reserved.</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="brought-by">
                                        <p>Brought to you by the creator of the original</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="design-by">&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer-->
                <!-- Footer Ends Here  -->
            </div>
        </div>
    </body>
</html>


<script type="text/javascript">
    function check(input) {
        if (input.value != document.getElementById('email').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
    $(document).ready(function(){
        if(jQuery("input").length > 0)
      {
        jQuery("input").attr("autocomplete", "off");
      }

    });
</script>


