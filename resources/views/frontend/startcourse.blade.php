@extends("layouts.frontapp")
@section('content')
    <style>
        .pdfobject-container {
            max-width: 100%;
            width: 800px;
            height: 1000px;
            display: inline-block;
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
                <div class="col-lg-8">
                    <div class="pdfobject-container" id="my-pdf"></div>

                    {{--<iframe width="800" height="1000" src="https://www.1training.org/them+65encode-pdf-viewer-sc/?file={{ asset('/uploads/coursepdf/' . $courseData[0]->pdf ) }}&amp;settings=111111111&amp;lang=en-US#page=&amp;zoom=auto&amp;pagemode="></iframe>--}}
                </div>
                <div class="col-lg-4">
                    <ul>
                        <li>TIME REMAINING : {{ (isset($DaysLeft)) ? $DaysLeft : "Expired" }} DAYS</li>
                    </ul>
                    @if(count($courseprogramData) > 0)
                        <ul>
                        @foreach($courseprogramData as $data)
                                <li><a href="javascript:void(0);" onclick="javascript:Get_CP_PDF({{ $data->id }});" @if(isset($UserProgramData[0]->CourseProgramID) && $data->id == $UserProgramData[0]->CourseProgramID) class="active" @endif>{{ $data->cp_title }}</a></li>
                        @endforeach
                            <li><a href="{{ URL::to("/user/mock_exam/" . $cid) }}">Mock Exam</a></li>
                            <li><a href="{{ URL::to("/user/exam/" . $cid) }}">Exam</a></li>
                        </ul>
                    @endif
                    <br />
                    <ul>
                        <li><a href="{{ URL::to("/course_detail/" . $cid) }}">Back to Course</a></li>
                        <li><a href="javascript:void(0);">Review Course</a></li>
                        <li><a href="{{ URL::to("/finish_course/" . $cid) }}">Finish Course</a></li>
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
    </script>

@endsection