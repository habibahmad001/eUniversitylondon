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
                    @if(file_exists("uploads/coursepdf/" . $courseData[0]->pdf))
                        <div class="pdfobject-container" id="my-pdf"></div>
                    @else
                        <div class="pdfobject-container">This section have no content yet.</div>
                    @endif
                    {{--<iframe width="800" height="1000" src="https://www.1training.org/them+65encode-pdf-viewer-sc/?file={{ asset('/uploads/coursepdf/' . $courseData[0]->pdf ) }}&amp;settings=111111111&amp;lang=en-US#page=&amp;zoom=auto&amp;pagemode="></iframe>--}}
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