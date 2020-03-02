@extends('layouts.reset')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 4% 0;">
            <div class="panel panel-default">
                <div class="panel-heading">Create New job</div>

                <div class="panel-body">

                    <div class="center-content-area">
                        <form class="frm-employer" method="post" action="{{ URL::to('/emp_c_j') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="page_id" value="{{ @$rules->id}}">

                            <div class="rules_page">

                                <div class="form-line">
                                    <div class="field-container">
                                        <select name="where" class="search-where" id="where" style="padding: 1.5%;">
                                            <option value="where">Where</option>
                                            @foreach($locres as $location)
                                                <option value="{{ $location->id }}">{{ $location->location_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-line">
                                    <div class="field-container">
                                        <select name="cat_id" class="search-where" id="cat_id" style="padding: 1.5%;">
                                            <option value="where">Select Category</option>
                                            @foreach($catres as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-line">
                                    <div class="field-container">
                                        <input type="text" value="{{ @$rules->page_title}}" name="page_title" id="page_title" placeholder="Job Title" required>
                                    </div>
                                </div>
                                <div class="form-line">
                                    <div class="field-container">
                                        <textarea name="content" class="summernote" placeholder="Job Content">{{ @$rules->content}}</textarea>
                                    </div>
                                </div>


                                <div class="form-footer">
                                    <div class="button-container">
                                        <input type="submit" value="Save Changes" name="submit" class="save-changes">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="{{ asset('css/summernote.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('js/summernote.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });
    });
</script>
@endsection
