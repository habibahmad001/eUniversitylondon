<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">
<title>SUPER QUIZ.</title>

<!-- Styles -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="wrapper login-background">
		<div class="login-header">
			<div class="logo"><img src="images/logo.png"></div>
		</div>

    @yield('content')

 
    @if(session()->has('error_message'))
    <?php echo 'here'; exit; ?>
        <div class="success-message-box" style="color: #843534; background: #f2dede;border-color: #ebccd1;">
            {{ session()->get('error_message') }}
            <div class="cancel"></div>
        </div>
      @endif
       @if ($errors->any())
        <?php echo 'here'; exit; ?>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
    <script src="{{ asset('js/main.js') }}"></script>
     <script src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		if(jQuery("input").length > 0)
          {
            jQuery("input").attr("autocomplete", "off");  
          }
        });  
    </script>
  </div>
</body>
</html>
