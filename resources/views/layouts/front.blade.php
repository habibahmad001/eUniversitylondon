<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Super Quiz</title>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

	  	<!-- CSRF Token -->
	  	<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link href="{{ asset('css/style-front.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Font  -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="login-page">
                <!-- Header Starts Here  -->
                <header>
                    <div class="container-fluid">
                        <div class="logo-txt">
                            <a href="/">eUniversityLondon</a>
                        </div>

                    </div>
                </header>
                <!-- Header Ends Here  -->
                <!-- Banner Starts Here  -->

                @yield('content')

                <!-- Banner Ends Here  -->
                <!-- Content Starts Here  -->
                <div class="content">
                    <div class="container">
                        <div class="rules">
                            <h2 class="title">The Rules</h2>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <p><span>1 )&nbsp;&nbsp;&nbsp;</span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex.</p>
                                </div>
                                <div class="col-md-4 ">
                                    <p><span>2 )&nbsp;&nbsp;&nbsp;</span>Commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla <strong>pariatur</strong>. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.</p>
                                </div>
                                <div class="col-md-4 ">
                                    <p><span>3 )&nbsp;&nbsp;&nbsp;</span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt <strong>explicabo</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Ends Here  -->
                <!-- Footer Starts Here  -->
                <footer>
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
                                    <p>Copyright © 2020 eUniversityLondon. All Rights Reserved.</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="brought-by">
                                        <p>Brought to you by the creator of the original</p>
                                        <img src="{{ asset('images/super-quiz-logo-ftr.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="design-by">A Niagara Website Design by Future Access Inc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- Footer Ends Here  -->
            </div>
        </div>
    </body>
</html>


<script type="text/javascript">
        $(document).ready(function(){
            if(jQuery("input").length > 0)
          {
            jQuery("input").attr("autocomplete", "off");  
          }

        });  
    </script>

