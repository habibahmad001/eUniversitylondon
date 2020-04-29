<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<title>{{ $page_title or 'eUniversityLondon' }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{{ asset('images/favicons.ico') }}}">

  	<!-- CSRF Token -->
  	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="{{ asset('css/bootstrapLive.min.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('css/jquery-ui.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet">

	<!-- custom scrollbar stylesheet -->
	<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css" >
	<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">

 	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <div class="wrapper">
		<header>
			@if(session()->has('message'))
				<div class="success-message-box">
		      	{{ session()->get('message') }}
						<div class="cancel"></div>
				</div>
			@endif
			@if(session()->has('error_message'))
				<div class="success-message-box" style="color: #843534; background: #f2dede;border-color: #ebccd1;">
		      	{{ session()->get('error_message') }}
						<div class="cancel"></div>
				</div>
			@endif
			<div class="logo-txt">
				<a href="{{ URL::to('/admin/home') }}">Administrator</a>

			</div>
			@if(!Auth::guest())
				<ul class="nav navbar-nav right-button navbar-right">
					<li class="dropdown user">
						<a href="#" data-toggle="dropdown" role="button" aria-expanded="true" class="dropdown-toggle">
							{{ strtoupper(Auth::user()->first_name[0]) }}
						</a>
						<ul role="menu" class="dropdown-menu">
							<div class="menu-box">
								<div class="top-container">
									<div class="image"><img src="{{URL::asset('/uploads/avatars/')}}/{{Auth::user()->avatar }}"></div>
									<div class="info">
										<div class="name">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</div>
										<div class="email">{{ Auth::user()->email }}</div>
									</div>
								</div>
								<div class="bottom-container">
									<a href="{{ URL::to('/admin/my-account')}}">My Account</a>
									<a href="{{ route('logout') }}"
		                  onclick="event.preventDefault(); event.stopImmediatePropagation();
		                           document.getElementById('logout-form').submit();">Sign Out</a>
									 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	 	                  {{ csrf_field() }}
	 	              </form>
								</div>
							</div>
						</ul>
					</li>
				</ul>
			@endif
			{{-- <div class="search-container">
				<form>
					<input type="search" name="" placeholder="Search here" class="header-search">
					<input type="submit" name="">
				</form>
			</div> --}}
		</header>
		<section class="content">
			<div class="overlay-for-form"></div>
      @yield('content')
    </section>

   </div>


    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      	<script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
      	<!-- Include all compiled plugins (below), or include individual files as needed -->
      	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
      	<!-- custom scrollbar plugin -->
  		<script src="{{ asset('js/jquery-ui.js') }}"></script>
  	 	<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  		<script src="{{ asset('js/main-admin.js') }}"></script>
  	 	<script src="{{ asset('js/custom.js') }}"></script>
  		<link href="{{ asset('css/summernote.css') }}" rel="stylesheet" type="text/css" />
  		<script type="text/javascript" src="{{ asset('js/summernote.js') }}"></script>
		 @yield('js_libraries')
</body>
</html>


<script type="text/javascript">
	$(document).ready(function(){
		if(jQuery("input").length > 0)
		{
			jQuery("input").attr("autocomplete", "off");
		}
		$('textarea').each(function(){
			var p = $(this).attr("placeholder");

			$(this).summernote({
				height: 200,
				tabsize: 2,
				placeholder: p + ' . .'
			});
			// console.log($(this).val());
		});
	});
</script>