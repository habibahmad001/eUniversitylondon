@extends('layouts.quiz')
@section('content')


<section class="banner profile-banner">
            <div class="custom-container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Profile</h1>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <h2>{{ $current_user->username }}</h2>
                                <div class="profile-content">
                                    <p>First Name:<span>{{$current_user->first_name}}</span></p>
                                    <p>Last Name:<span>{{$current_user->last_name}}</span></p>
                                    <p>Email:<span>{{$current_user->email}}</span></p>
                                    <button type="button" id="reset-password" class="reset" data-toggle="modal" data-target="#myModal">Reset Password</button>
                                    <!-- <a href="#reset-password" role="button" class="" data-toggle="modal">Reset Password</a> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="user-profile-progress">
                                    <span class="gradient level">@if(count($xp_res) > 0) {{ $xp_res->user_level }} @else 1 @endif</span>
                                    <div class="progress-inner">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{ $xp_bar }}%"></div>
                                        </div>
                                        <span class="experience">@if(count($xp_res) > 0) {{ $xp_res->xp_point }} / {{ $xp_res->level_up_xp }} @endif</span>
                                    </div>
                                </div>
                                <div class="user-profile-item">
                                    <p class="points">
                                        <span class="points-icon"><img src="{{ asset('images/points-star.png') }}" alt=""></span>{{$points}} Points
                                        <a data-toggle="tooltip" title="Points are earned by correct answer" class="info" data-html="true" rel="tooltip" href="#">?</a>
                                    </p>
                                </div>
                                <div class="user-profile-item">
                                    <p class="super-points">
                                        <span class="points-icon"><img src="{{ asset('images/super-points-star.png') }}" alt=""></span>{{$super_points}} Super Points
                                        <a data-toggle="tooltip" title="Super Points are earned by getting 100 points" class="info" data-html="true" href="#">?</a>
                                    </p>
                                </div>
                                <div class="user-profile-item">
                                    <p class="user-streak">
                                        <span class="points-icon"><img src="{{ asset('images/streak.png') }}" alt=""></span>{{ $xp_point }} Day Streak<a title="Keep Winning to get highest steak" data-toggle="tooltip" class="info" data-html="true" rel="tooltip" href="#">?</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="leaderboard-heading">Leaderboard</h3>
                                <div class="table-inner table-responsive default-box-shadow">
                                    <table class="" id="profile_leaderboard">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Level</th>
                                                <th>Points</th>
                                                <th>Super Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            
                                          @if(count($month_res)==0)

                                                <tr>
                                                    <td colspan="4"><center>{{ (!empty($res_msg)) ? $res_msg : "No Data Found!!!" }}</center></td>
                                                </tr>
                                            @else
                                            @foreach($month_res as $user)
                                            <tr @if($current_user->username==$user->username)class="active"@endif>

                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->user_level }}</td>
                                                <td>{{ $user->regular_point }}</td>
                                                <td>{{ $user->superpoint }}</td>
                                            </tr>
                                            @endforeach 
                                            @endif 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close-btn" data-dismiss="modal">
                        <img src="{{ asset('images/close-icon.png') }}" alt="">


                    </button>
                </div>
                <div class="modal-body">
                    <h2>Password Reset</h2>
                    <div class="row">
                      <div class="alert alert-danger print-error-msg" style="display:none">
                      <ul></ul>
                      </div>
                      <div class="alert alert-success" style="display:none">
                        <strong>Success!</strong> Successfully updated your password.
                      </div>
                        <div class="col-md-12">
                          <form method="POST" action="/reset_password">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group default-box-shadow">
                                    <input type="password" name="old_password" id="old_password" class="form-control " placeholder="Current Password" autocomplete="off">
                                </div>
                                <div class="form-group default-box-shadow">
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" autocomplete="off">
                                </div>
                                <div class="form-group default-box-shadow">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm New Password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <button type="button" id="reset_password" class="reset">Reset Password</button>
                                </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection