@extends("layouts.frontapp")
@section('content')
    <style>
        .pdfobject-container {
            max-width: 100%;
            width: 800px;
            height: 1000px;
            display: inline-block;
        }
        #myProgress {
            width: 100%;
            background-color: grey;
        }

        #myBar {
            width: {!! (isset($UserProgramData[0]->CourseProgramID)) ? floor(($UserProgramData[0]->ProgramCount/count($courseprogramData))*100) : 0 !!}%;
            height: 30px;
            background-color: #4CAF50;
            text-align: center; /* To center it horizontally (if you want) */
            line-height: 30px; /* To center it vertically */
            color: white;
        }
    </style>
    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Start Course Here</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to("/") }}">Home</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75 shop-order-received">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="msg" class="woocommerce-message" style="display: none;"></div>
                </div>
                @if(session()->has('message'))
                    <div class="woocommerce-message">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-8 pdf-8-div">
                    @if(is_array(json_decode($courseData[0]->cp_desc, true)))
                        @if(explode("_",json_decode($courseData[0]->cp_desc, true)[0]["Type"])[0] == "Youtube")
                            <iframe width="100%" height="515" src="{!! json_decode($courseData[0]->cp_desc, true)[0]["Content"] !!}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @elseif(explode("_",json_decode($courseData[0]->cp_desc, true)[0]["Type"])[0] == "Content")
                            <div class="pdfobject-container">{!! json_decode($courseData[0]->cp_desc, true)[0]["Content"] !!}</div>
                        @elseif(explode("_",json_decode($courseData[0]->cp_desc, true)[0]["Type"])[0] == "Iframe")
                            {!! json_decode($courseData[0]->cp_desc, true)[0]["Content"] !!}
                        @elseif(explode("_",json_decode($courseData[0]->cp_desc, true)[0]["Type"])[0] == "Video")
                            <video width="100%" controls>
                                <source src="{!! "/uploads/courseprogramVIDEO/" . json_decode($courseData[0]->cp_desc, true)[0]["Content"] !!}" type="video/mp4">
                                <source src="{!! "/uploads/courseprogramVIDEO/" . json_decode($courseData[0]->cp_desc, true)[0]["Content"] !!}" type="video/ogg">
                                Your browser does not support HTML video.
                            </video>
                        @elseif(explode("_",json_decode($courseData[0]->cp_desc, true)[0]["Type"])[0] == "Image")
                            <iframe width="100%" height="515" src="{!! json_decode($courseData[0]->cp_desc, true)[0]["Content"] !!}" frameborder="0" allow="" allowfullscreen></iframe>
                        @endif
                    @else
                        {{--@if(is_array(json_decode($courseprogramData[0]->cp_desc, true)))--}}
                            {{--@if(explode("_",json_decode($courseprogramData[0]->cp_desc, true)[0]["Type"])[0] == "Youtube")--}}
                                {{--<iframe width="100%" height="515" src="{!! json_decode($courseprogramData[0]->cp_desc, true)[0]["Content"] !!}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
                            {{--@elseif(explode("_",json_decode($courseprogramData[0]->cp_desc, true)[0]["Type"])[0] == "Content")--}}
                                {{--<div class="pdfobject-container">{!! json_decode($courseprogramData[0]->cp_desc, true)[0]["Content"] !!}</div>--}}
                            {{--@elseif(explode("_",json_decode($courseprogramData[0]->cp_desc, true)[0]["Type"])[0] == "Iframe")--}}
                                {{--{!! json_decode($courseprogramData[0]->cp_desc, true)[0]["Content"] !!}--}}
                            {{--@elseif(explode("_",json_decode($courseprogramData[0]->cp_desc, true)[0]["Type"])[0] == "Video")--}}
                                {{--<video width="100%" controls>--}}
                                    {{--<source src="{!! "/uploads/courseprogramVIDEO/" . json_decode($courseprogramData[0]->cp_desc, true)[0]["Content"] !!}" type="video/mp4">--}}
                                    {{--<source src="{!! "/uploads/courseprogramVIDEO/" . json_decode($courseprogramData[0]->cp_desc, true)[0]["Content"] !!}" type="video/ogg">--}}
                                    {{--Your browser does not support HTML video.--}}
                                {{--</video>--}}
                            {{--@elseif(explode("_",json_decode($courseprogramData[0]->cp_desc, true)[0]["Type"])[0] == "Image")--}}
                                {{--<iframe width="100%" height="515" src="{!! json_decode($courseprogramData[0]->cp_desc, true)[0]["Content"] !!}" frameborder="0" allow="" allowfullscreen></iframe>--}}
                            {{--@endif--}}
                        {{--@else--}}
                            {{--<div class="pdfobject-container">This section have no content yet.</div>--}}
                        {{--@endif--}}
                        <div class="pdfobject-container">This section have no content yet.</div>
                    @endif

                </div>
                <div class="col-lg-4">
                    <ul class="progressbarandtime">
                        <li>TIME REMAINING : {{ (isset($DaysLeft)) ? $DaysLeft : "Expired" }} DAYS</li>
                        <li>
                            <div id="myProgress">
                                <div id="myBar">{!! (isset($UserProgramData[0]->CourseProgramID)) ? floor(($UserProgramData[0]->ProgramCount/count($courseprogramData))*100) . "%" : "" !!}</div>
                            </div>
                        </li>
                    </ul>
                    @if(count($courseprogramData) > 0)
                        <ul class="course_timeline">
                        @foreach($courseprogramData as $data)
                                <li @if(isset($UserProgramData[0]->CourseProgramID) && $data->id == $UserProgramData[0]->CourseProgramID) class="activeli" @endif id="li-{{ $data->id }}">
                                    {!! (isset($UserProgramData[0]->CourseProgramID) && $data->id == $UserProgramData[0]->CourseProgramID) ? "<span></span>" : "" !!}
                                    <a href="javascript:void(0);" onclick="javascript:Get_CP_PDF({{ $data->id }});" @if(isset($UserProgramData[0]->CourseProgramID) && $data->id == $UserProgramData[0]->CourseProgramID) class="active" @endif  id="aid-{{ $data->id }}">{{ $data->cp_title }}</a>
                                    <div class="btnsetting">
                                        <div class="programItems" id="itemOPT<?=$data->id?>" data-chk="1">
                                            <ul>
                                                @if(is_array(json_decode($data->cp_desc, true)))
                                                    <?php $count = 0;?>
                                                    @foreach(json_decode($data->cp_desc, true) as $v)
                                                            <li>
                                                            @if($v["Type"] == "Youtube_" . $count)
                                                               <a href="javascript:void(0);" data-toggle="modal" data-target="#YouTubeModal" class="video-link" data-src="{!! $v["Content"] !!}"> {!! $v["Title"] !!}</a>
                                                            @elseif($v["Type"] == "Content_" . $count)
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#ContentModal" data-id="<?=$data->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-content<?=$data->id.$count?>" style="display: none;">{!! $v["Content"] !!}</div>
                                                            @elseif($v["Type"] == "Iframe_" . $count)
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#ContentModal" data-id="<?=$data->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-content<?=$data->id.$count?>" style="display: none;">{!! $v["Content"] !!}</div>
                                                            @elseif($v["Type"] == "Video_" . $count)
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#VideoModal" data-id="<?=$data->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-video<?=$data->id.$count?> playedvideos" style="width: 100%; display: none;">
                                                                    <video width="100%" controls>
                                                                        <source src="{!! "/uploads/courseprogramVIDEO/" . $v["Content"] !!}" type="video/mp4">
                                                                        <source src="{!! "/uploads/courseprogramVIDEO/" . $v["Content"] !!}" type="video/ogg">
                                                                        Your browser does not support HTML video.
                                                                    </video>
                                                                </div>
                                                            @elseif($v["Type"] == "Image_" . $count)
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#IMGModal" data-id="<?=$data->id.$count?>" class="content-field"> {!! $v["Title"] !!}</a>
                                                                <div class="relative-img<?=$data->id.$count?>" style="display: none;">{!! "/uploads/courseprogramIMG/" . $v["Content"] !!}</div>
                                                            @endif
                                                            </li>
                                                    <?php $count++;?>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="programButton">
                                            <button type="button" class="btn-outline-primary btn-sm" name="moreItems" id="moreItems<?=$data->id?>" onclick="javascript:programItemOPT('itemOPT<?=$data->id?>', jQuery(this).attr('id'));"><i class="fa fa-plus" aria-hidden="true"></i> More Units</button>
                                        </div>
                                    </div>
                                </li>
                        @endforeach
                            <li><a name="exlink" href="{{ URL::to("/user/mock_exam/" . $cid) }}" data-exType="mquizstart">Mock Exam</a></li>
                            <li><a name="exlink" href="{{ URL::to("/user/exam/" . $cid) }}" data-exType="quizstart">Exam</a></li>
                        </ul>
                    @endif
                    <br />
                    <ul class="finishcourse">
                        <li onclick="javascript:window.location.href='{{ URL::to("/course_detail/" . strtolower(str_replace(' ', '-', App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_title))) }}';"><a href="javascript:void(0);">Back to Course</a></li>
                        <li onclick="javascript:window.location.href='{{ URL::to("/reviews/" . $cid) }}';"><a href="javascript:void(0);">Review Course</a></li>
                        <li onclick="javascript:window.location.href='{{ URL::to("/finish_course/" . $cid) }}';"><a href="javascript:void(0);">Finish Course</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="YouTubeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Video Modal -->



    <!-------------- Iframe Modal ------------>
    <div class="modal fade" id="IMGModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 600px; height: 650px">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9" style="height: 650px">
                        <iframe src="" class="puiframe" style="width:600px; height:650px;" frameborder="0"></iframe>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-------------- Iframe Modal ------------>

    <!-------------- Video Modal ------------>
    {{--<div class="modal fade" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}


    {{--<div class="modal-body">--}}

    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<!-- 16:9 aspect ratio -->--}}
    {{--<div class="embed-responsive embed-responsive-16by9 vm">--}}

    {{--</div>--}}


    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-------------- Video Modal ------------>

    <!-- --------------- Content Model ------------------- -->
    <div class="modal fade" id="ContentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body popup-data-div">

                </div>
                <div class="modal-footer">
                    {{--<button type="button" name="RConfirmBTN" id="RConfirmBTN" data-key="0" class="btn btn-primary">Confirm</button>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- --------------- Content Model ------------------- -->



    <script src="/js/front/pdfobject.min.js"></script>
    <script>
        var options = {
            page: '1',
            pdfOpenParams: {
                /*view: 'FitV',
                pagemode: 'thumbs',*/
                search: 'lorem ipsum'
            }
        };
        PDFObject.embed("{{ $PDFpath . $courseData[0]->pdf }}", "#my-pdf", options);
        var i = 0;
        function move() {
            if (i == 0) {
                i = 1;
                var elem = document.getElementById("myBar");
                var width = 10;
                var id = setInterval(frame, 10);
                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        i = 0;
                    } else {
                        width++;
                        elem.style.width = width + "%";
                        elem.innerHTML = width + "%";
                    }
                }
            }
        }
    </script>

@endsection