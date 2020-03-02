 @if($sub_heading=='profile' or $sub_heading=='LeaderBoard')
                <div class="dashboard-bar">
                    <div class="dashboard-bar-inner">
                        <div id="the-final-countdown" class=" gradient">
                            <span>Time Remaining:&nbsp;&nbsp;</span>
                            <span class="hours_remaining"></span>
                            <span class="minutes_remaining"></span>
                            <span class="seconds_remaining"></span>
                        </div>
                        <div class="buttons-info">
                            @if(empty($QuestionMsg))
                            <a href="{{ URL::to('/ready-to-play') }}">Ready to take quiz ?</a>
                            @else
                            <span class="comeback-tomorrow" href="">{{$QuestionMsg}}</span>
                            @endif
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                
                
                @endif

                @if($sub_heading!='profile' && $sub_heading!='LeaderBoard')
                <div class="user-bar">
                    <div class="user-bar-inner">
                        <div class="user-progress user-bar-item">
                            <div class="user-progress-inner">
                                <span class="question-number gradient">@if(count($xp_res) > 0) {{ $xp_res->user_level }} @else 1 @endif</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{ $xp_bar }}%"></div>
                                </div>
                                <span class="remaining-questions">@if(count($xp_res) > 0) {{ $xp_res->xp_point }} / {{ $xp_res->level_up_xp }} @endif</span>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        
                        <div class="points user-bar-item ">
                            <span><img src="{{ asset('images/points-star.png') }}" alt="">{{ $totalpoints }} Points</span>
                        </div>
                        <div class="super-points user-bar-item">
                            <span><img src="{{ asset('images/super-points-star.png') }}" alt="">{{ $superpoints }} Super Points</span>
                        </div>
                        <div class="user-streak user-bar-item">
                            <span><img src="{{ asset('images/streak.png') }}" alt="">{{ $xp_point }} Day Streak</span>
                        </div>
                        
                    </div>
                </div>
               
                @endif