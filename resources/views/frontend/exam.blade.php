@extends("layouts.frontapp")
@section('content')
    <style>
        .page_title h1 {
            line-height: 2;
        }
    </style>
    <div class="header_absolute ds s-parallax s-overlay title-bg2">


        <section class="page_title ds s-pt-80 s-pb-80 s-pt-lg-130 s-pb-lg-90">
            <div class="divider-50"></div>
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h1>Course: {{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_title }}</h1>
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
                    <div>
                        <h3>Instructions for Taking the Exam</h3><br />

                        ► Exam time duration : 40 mins<br />

                        ► Total questions : 30<br />

                        ► Total marks : 300 (Each question 10 marks)<br />

                        ► Pass marks : 195
                        <h5>Taking the Exam</h5>
                        <ol>
                            <li>Select an answer for every question. Unanswered questions will be scored as incorrect.</li>
                            <li>
                                There are three possible question types:
                                <ul>
                                    <li><b>Multiple Choice:</b> click the radio button to indicate your choice. Currently, only one answer can be selected for a multiple choice question. One Answer can be saved only once</li>
                                    <li>If you use a wheel button mouse, take care not to accidentally change your answers. Sometimes scrolling the wheel will rotate through the answers in a selection list, when you might have meant simply to scroll farther down in the exam window.</li>
                                </ul>
                            </li>
                            <li>Click on the Submit button at the bottom of the page to have your answers graded.</li>
                        </ol>
                        <br />
                        <b>Please Note:</b> If you fail your exam at first attempt, you can try another attempt and it is charged £19 additionally.  If you couldn’t pass your exam in 3 attempts, you are required to retake your full course.
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('frontend.blocks.prevnext')
                </div>
            </div>
        </div>
    </section>

@endsection