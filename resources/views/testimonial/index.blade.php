@extends("layouts.app-" . collect(request()->segments())->first())
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-' . collect(request()->segments())->first())
@include('testimonial.edit')
@include('testimonial.create')

<!-- Edit form -->
<div class="center-content-area table-set">
    <div class="table-responsive">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <table class="table">
            <tbody class="table">
                <thead>
                    </tr>
                    <tr>
                        <th width="3%" class="edit-icon-container">&nbsp;</th>
                        <th width="2%" class="checkbox-container">
                            <input type="checkbox" name="all">
                        </th>
                        <th>Testimonial Name</th>
                        <th>Testimonial Description</th>
                    </tr>
                </thead>
                @if(count($Testimonial)) @foreach ($Testimonial as $test)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $test->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_testimonial[]" value="{{ $test->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $test->testimonial_name }}</td>
                    <td>{{ (strlen(strip_tags($test->testimonial_desc)) > 350) ? substr(strip_tags($test->testimonial_desc), 0, 350) : strip_tags($test->testimonial_desc) }}</td>
                </tr>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        <div class="number-container">
            Total: <span>{{ $Testimonial->total() }}</span>
        </div>
        <nav aria-label="Page navigation">
            @include('pagination.default', ['paginator' => $Testimonial])
        </nav>
    </div>
</div>
@include('../blocks/delete-form', ['model' => 'testimonial'])

@endsection 

@section('js_libraries')
<script type="text/javascript" src="{{ asset('js/testimonial.js')}}"></script>
@endsection