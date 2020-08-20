@extends("layouts.frontapp")
@section('content')
    <style>
        .page_title h1 {
            line-height: 2;
        }
        td.retake_img_td img {
            width: 100%;
            height: 260px;
        }
        .retake_content_td b {
            display: inline-block;
        }
        .price {
            float: right;
            margin: 0;
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


    <section class="ls s-pt-55 s-pb-45 s-pt-lg-95 s-pb-lg-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <form method="POST" name="prod" id="prod" action="{{ URL::to("/retakecart") }}">
                        <h3>Purchase Subscription</h3> <br />
                            <table width="100%" border="1px">
                                <tr>
                                    <td style="width: 30%" class="retake_img_td">
                                        <img src="{{ asset('/uploads/pavatar/' . App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_avatar ) }}" width="200px" />
                                    </td>
                                    <td class="retake_content_td">
                                        <div id="itm-post-{{ $cid }}"></div>
                                        <b>Retake - {{ App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_title }}</b>
                                        <b class="price">Price £ 10</b>
                                        <p>{!! App\Http\Controllers\Front\UserFrontController::GetCourseOnID($cid)->course_desc !!}</p>
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