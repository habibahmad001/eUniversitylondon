@extends('layouts.quiz')
@section('content')


<section class="banner your-score">
            <div class="custom-container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Your Score</h1>
                         <h2 class="q-out-date">Date: {{\Carbon\Carbon::now()->toDayDateTimeString()}}</h2> 
                           <a href="{{ URL::to('/dashboard') }}" class="my-rank">My Rank</a>
                         @if(count($scores)==0)
                            <h2 class="q-out-of">&nbsp;</h2>
                           <p>You did not play yet today!</p>
                         @else
                        
                        <h2 class="q-out-of">{{$is_correct}} / 3</h2>
                        @if($points>5)
                        <p class="congrats">Congratulations! You’ve earned {{$points}} Points! <img  src="{{ asset('images/congratz.gif') }}" alt=""></p>
                        @else
                        <p class="congrats">You’ve earned {{$points}} Points!</p>
                        @endif
                        <div class="results-content">
                            <?php $cot = 1;?>
                            @foreach($scores as $score)
                            
                            <div class="results-content-block">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 no-padding-right">
                                        <span class="gradient question-number">{{ $cot }}</span>
                                    </div>
                                    <div class="col-md-10 col-sm-10 no-padding-left">
                                        <p class="question-content">{{ $score->question }}</p>
                                        @if($score->answer!=$score->your_answer)
                                        <p>Your Answer: <span class="marks"><strong>{{ $score->your_answer }}</strong></span></p>
                                        <p>Correct Answer: <span class="marks"><strong>{{ $score->answer }}</strong></span></p>
                                        @else
                                        <p>Your Answer: <span class="marks"><strong>{{ $score->answer }}</strong></span></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <?php $cot++?>
                            @endforeach

                        </div>
                        <h2>Thanks for Playing! See You Tomorrow.</h2>

                        @endif

                    </div>
                </div>

            </div>
        </section>

@endsection