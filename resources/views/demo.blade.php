@extends('layouts.demo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 4% 0;">
            <div class="panel panel-default">
                <div class="panel-heading">Get Started</div>

                <div class="panel-body">
                    <video width="100%" controls>
                        <source src="{{ asset('demo/demo.mp4') }}" type="video/mp4">
                        <source src="mov_bbb.ogg" type="video/ogg">
                        Your browser does not support HTML5 video.
                    </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
