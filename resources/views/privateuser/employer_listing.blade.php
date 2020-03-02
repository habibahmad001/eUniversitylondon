@extends('layouts.reset')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 4% 0;">
            <input type="button" class="create_job" name="createjob" onclick="javascript:window.location.href='/create_job';" id="createjob" value="Create Job">
            <div class="panel panel-default">
                <div class="panel-heading">All job's created by {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>

                <div class="panel-body" id="search-result">
                    @if(isset($Jobs))
                        @foreach($Jobs as $job)
                            <p><a href='/jobdetail/{{ $job->id }}'>{{ $job->job_title }}</a></p>
                        @endforeach
                    @else
                        No result found !
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
