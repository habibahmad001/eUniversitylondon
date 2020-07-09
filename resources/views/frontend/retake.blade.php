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
                        <h1>Exam: {{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_title }}</h1>
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


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <form method="POST" name="prod" id="prod" action="{{ URL::to("/addcart") }}">
                        <h3>Purchase Subscription</h3> <br />
                            <table width="100%" border="1px">
                                <tr>
                                    <td style="width: 30%" class="retake_img_td">
                                        <img src="{{URL::asset('/images/retake-exam.png')}}" width="200px" />
                                    </td>
                                    <td class="retake_content_td">
                                        <div id="itm-post-{{ $cid }}"></div>
                                        <b>What is Lorem Ipsum?</b>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                                        {{ csrf_field() }}
                                        <button type="button" class="btn btn-success" onclick="javascript:product_submit({{ $cid }});">Process to pay</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
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