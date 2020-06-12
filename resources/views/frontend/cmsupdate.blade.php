<link href="{{ asset("css/bootstrapLive.min.css") }}" type="text/css" rel="stylesheet">
<script src="{{ asset("js/jquery-2.2.4.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.min.js") }}"></script>

<form name="cmsformmodel" id="cmsformmodel" action="{{ URL::to("/admin/savecms") }}" method="post" enctype="multipart/form-data">
    <div>{{ csrf_field() }}
        <input type="hidden" name="id" id="cmsID" value="{{ (isset($cms->id)) ? $cms->id : "" }}">
        <input type="hidden" name="pid" id="cmsPID" value="{{ isset($cms->cms_pid) ? $cms->cms_pid : "" }}">
        <div class="form-line">
            <input type="text" name="cms_title" class="form-control" id="cms_title" placeholder="Title" value="{{ isset($cms->cms_title) ? $cms->cms_title : "" }}">
        </div>
        <br />
        <div class="form-line">
            <textarea name="cms_desc" id="cms_desc" placeholder="Type some description.">{{ isset($cms->cms_desc) ? $cms->cms_desc : "" }}</textarea>
        </div>
    </div>
</form>

{{--******* Summer Note Classes *********--}}
<link href="{{ asset('css/summernote.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ asset('js/summernote.js') }}"></script>
{{--******* Summer Note Classes *********--}}
<script type="text/javascript">
    $(document).ready(function(){
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