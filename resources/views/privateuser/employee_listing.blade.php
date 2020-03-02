@extends('layouts.reset')

@section('content')
<div class="container">
    <div class="row">
        <div class="home-search">
            <form id="search" method="POST" action="{{ route('search') }}">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                <input type="text" name="what" class="search-what" id="what" placeholder="What">
                <select name="where-select" class="search-where" id="where-select">
                    <option value="where">Where</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->location_title }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-md-12" style="padding: 4% 0;">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Jobs List</div>

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
