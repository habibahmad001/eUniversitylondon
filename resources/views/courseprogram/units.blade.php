@extends('layouts.app-admin')
@section('content')
@include('blocks.sub-header')
@include('blocks.left-menu-admin')
<div class="preloader">
    <div class="preloader_image"></div>
</div>
<div class="center-content-area table-set">
    <br />
    <section class="page-section">
        <div class="container">
            <form name="unitfrm" id="unitfrm" action="{{ URL::to('/admin/update-unit') }}" method="post" enctype="multipart/form-data" onsubmit="javascript:return validate('');">
                <div class="row">
                <div class="col-sm-12 col-md-2 col-lg-2"></div>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="unitHeader text-right">
                        {{ csrf_field() }}
                        <input type="hidden" name="cpid" id="cpid" value="{{ collect(request()->segments())->last() }}">
                    </div>
                    @if(isset($Units))
                        <?php //print_r($Units);?>
                        <?php $count = 0;?>
                        @foreach($Units as $v)
                            <div class="unit-section" id="sectionID_<?=$count?>">
                                @if($count != 0)
                                <div class="unitHeader text-right">
                                    <button type="button" class="btn btn-danger" onclick="javascript:removeitems(<?=$count?>);">X</button>
                                </div>
                                @endif
                                <div class="unitBody">
                                    <div class="unit-row">
                                        <div class="unit-Item">
                                            <div class="form-line">
                                                <label>Title:</label>
                                                <input type="text" name="title[]" id="title_<?=$count?>" value="{!! $v["Title"] !!}" placeholder="Title. . ." >
                                            </div>
                                        </div>
                                        <div class="unit-Item">
                                            <div class="form-line">
                                                <label>Content/Unit Type:</label>
                                                <select name="type[]" id="type_<?=$count?>" onchange="javascript:jQuery('#sectionID_<?=$count?> .OperationRow').hide(300);jQuery('#'+jQuery(this).val()).show(300);">
                                                    <option value="">---- Select Option ----</option>
                                                    <option value="Content_<?=$count?>" {!! ($v["Type"] == "Content_".$count) ? "selected" : "" !!}>Content</option>
                                                    <option value="Iframe_<?=$count?>" {!! ($v["Type"] == "Iframe_".$count) ? "selected" : "" !!}>Iframe</option>
                                                    <option value="Youtube_<?=$count?>" {!! ($v["Type"] == "Youtube_".$count) ? "selected" : "" !!}>Youtube</option>
                                                    <option value="Video_<?=$count?>" {!! ($v["Type"] == "Video_".$count) ? "selected" : "" !!}>Video</option>
                                                    <option value="Image_<?=$count?>" {!! ($v["Type"] == "Image_".$count) ? "selected" : "" !!}>PDF</option>
                                                    <option value="Quiz_<?=$count?>" {!! ($v["Type"] == "Quiz_".$count) ? "selected" : "" !!}>Quiz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="unit-Item OperationRow" id="Content_<?=$count?>" {!! ($v["Type"] == "Content_".$count) ? "style='display:block'" : "" !!}>
                                            <div class="form-line">
                                                <label>Content:</label>
                                                <textarea name="contentarr[]" id="contentarr_<?=$count?>" placeholder="Type some text here . . .">{!! ($v["Type"] == "Content_".$count) ? $v["Content"] : "" !!}</textarea>
                                            </div>
                                            <div class="form-line">
                                                <label>Duration:</label>
                                                <input type="text" name="contentdur[]" id="contentdur_<?=$count?>" value="{!! ($v["Type"] == "Content_".$count) ? $v["Duration"] : "" !!}" placeholder="1:30">
                                            </div>
                                        </div>
                                        <div class="unit-Item OperationRow" id="Iframe_<?=$count?>" {!! ($v["Type"] == "Iframe_".$count) ? "style='display:block'" : "" !!}>
                                            <div class="form-line">
                                                <label>Iframe:</label>
                                                <textarea name="iframearr[]" id="iframearr_<?=$count?>" value="" placeholder="Iframe here. . ." >{!! ($v["Type"] == "Iframe_".$count) ? $v["Content"] : "" !!}</textarea>
                                            </div>
                                            <div class="form-line">
                                                <label>Duration:</label>
                                                <input type="text" name="iframedur[]" id="iframedur_<?=$count?>" value="{!! ($v["Type"] == "Iframe_".$count) ? $v["Duration"] : "" !!}" placeholder="1:30">
                                            </div>
                                        </div>
                                        <div class="unit-Item OperationRow" id="Youtube_<?=$count?>" {!! ($v["Type"] == "Youtube_".$count) ? "style='display:block'" : "" !!}>
                                            <div class="form-line">
                                                <label>Youtube embed link:</label>
                                                <input type="text" name="youtubearr[]" id="youtubearr_<?=$count?>" value="{!! ($v["Type"] == "Youtube_".$count) ? $v["Content"] : "" !!}" placeholder="Youtybe embed link here. . ." >
                                            </div>
                                            <div class="form-line">
                                                <label>Duration:</label>
                                                <input type="text" name="youtubedur[]" id="youtubedur_<?=$count?>" value="{!! ($v["Type"] == "Youtube_".$count) ? $v["Duration"] : "" !!}" placeholder="1:30">
                                            </div>
                                        </div>
                                        <div class="unit-Item OperationRow" id="Video_<?=$count?>" {!! ($v["Type"] == "Video_".$count) ? "style='display:block'" : "" !!}>
                                            <div class="form-line">
                                                <label>Video:</label>
                                                <input type="file" name="videoarr[]" id="videoarr_<?=$count?>"> <br />
                                                {{--<img src="{!! ($v["Type"] == "Video_".$count) ? "/uploads/courseprogramVIDEO/" . $v["Content"] : "" !!}" width="100px" height="100px" />--}}
                                                <video width="100%" controls>
                                                    <source src="{!! ($v["Type"] == "Video_".$count) ? "/uploads/courseprogramVIDEO/" . $v["Content"] : "" !!}" type="video/mp4">
                                                    <source src="{!! ($v["Type"] == "Video_".$count) ? "/uploads/courseprogramVIDEO/" . $v["Content"] : "" !!}" type="video/ogg">
                                                    Your browser does not support HTML video.
                                                </video>
                                                <p style="font-size: 11px !important; color: red">Only .mp4 format supported and file must less then 100MB</p>
                                                <input type="hidden" name="oldvid[]" id="oldvid_<?=$count?>" value="{!! ($v["Type"] == "Video_".$count) ? $v["Content"] : "" !!}">
                                            </div>
                                            <div class="form-line">
                                                <label>Duration:</label>
                                                <input type="text" name="videodur[]" id="videodur_<?=$count?>" value="{!! ($v["Type"] == "Video_".$count) ? $v["Duration"] : "" !!}" placeholder="1:30">
                                            </div>
                                        </div>
                                        <div class="unit-Item OperationRow" id="Image_<?=$count?>" {!! ($v["Type"] == "Image_".$count) ? "style='display:block'" : "" !!}>
                                            <div class="form-line">
                                                <label>PDF:</label>
                                                <input type="file" name="imgarr[]" id="imgarr_<?=$count?>"><br />
                                                {{--<img src="{!! ($v["Type"] == "Image_".$count) ? "/uploads/courseprogramIMG/" . $v["Content"] : "" !!}" width="100px" height="100px" />--}}
                                                <iframe src="{!! ($v["Type"] == "Image_".$count) ? "/uploads/courseprogramIMG/" . $v["Content"] : "" !!}" style="width:600px; height:500px;" frameborder="0"></iframe>
                                                <input type="hidden" name="oldimg[]" id="oldimg_<?=$count?>" value="{!! ($v["Type"] == "Image_".$count) ? $v["Content"] : "" !!}">
                                            </div>
                                            <div class="form-line">
                                                <label>Duration:</label>
                                                <input type="text" name="imgdur[]" id="imgdur_<?=$count?>" value="{!! ($v["Type"] == "Image_".$count) ? $v["Duration"] : "" !!}" placeholder="1:30">
                                            </div>
                                        </div>
                                        <div class="unit-Item OperationRow" id="Quiz_<?=$count?>" {!! ($v["Type"] == "Quiz_".$count) ? "style='display:block'" : "" !!}>
                                            <div class="form-line">
                                                <label>Select Quiz:</label>
                                                <select name="quizarr[]" id="quizarr_<?=$count?>">
                                                    <option value="">--- Select One ---</option>
                                                    @if(count(App\Http\Controllers\QuizController::GetQuizOnCourse(App\Http\Controllers\CourseProgramController::GetCPONID(collect(request()->segments())->last())->course_id)) > 0)
                                                        @foreach(App\Http\Controllers\QuizController::GetQuizOnCourse(App\Http\Controllers\CourseProgramController::GetCPONID(collect(request()->segments())->last())->course_id) as $ev)
                                                            <option value="{!! $ev->id !!}" @if($v["Type"] == "Quiz_".$count) {!! ($v["Content"] == $ev->id) ? "selected='selected'" : "" !!} @endif>{!! $ev->quiz_title !!}</option>
                                                        @endforeach
                                                    @endif
                                                </select><br />
                                            </div>
                                            <div class="form-line">
                                                <label>Duration:</label>
                                                <input type="text" name="quizdur[]" id="quizdur_<?=$count?>" value="{!! ($v["Type"] == "Quiz_".$count) ? $v["Duration"] : "" !!}" placeholder="1:30">
                                            </div>
                                        </div>
                                        <div class="form-line activediv">
                                            <input type="checkbox" name="isactive[]" id="isactive_<?=$count?>" {!! (isset($v["isActive"]) && !empty($v["isActive"])) ? "checked" : "" !!} value="<?=$count?>">
                                            <label>Only for registered users</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $count++;?>
                        @endforeach
                    @else
                        <div class="unit-section" id="sectionID_0">
                            <div class="unitBody">
                                <div class="unit-row">
                                    <div class="unit-Item">
                                        <div class="form-line">
                                            <label>Title:</label>
                                            <input type="text" name="title[]" id="title_0" placeholder="Title. . ." >
                                        </div>
                                    </div>
                                    <div class="unit-Item">
                                        <div class="form-line">
                                            <label>Content/Unit Type:</label>
                                            <select name="type[]" id="type_0" onchange="javascript:jQuery('#sectionID_0 .OperationRow').hide(300);jQuery('#'+jQuery(this).val()).show(300);">
                                                <option value="">---- Select Option ----</option>
                                                <option value="Content_0">Content</option>
                                                <option value="Iframe_0">Iframe</option>
                                                <option value="Youtube_0">Youtube</option>
                                                <option value="Video_0">Video</option>
                                                <option value="Image_0">PDF</option>
                                                <option value="Quiz_0">Quiz</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="unit-Item OperationRow" id="Content_0">
                                        <div class="form-line">
                                            <label>Content:</label>
                                            <textarea name="contentarr[]" id="contentarr_0" placeholder="Type some text here . . ."></textarea>
                                        </div>
                                        <div class="form-line">
                                            <label>Duration:</label>
                                            <input type="text" name="contentdur[]" id="contentdur_0" placeholder="1:30">
                                        </div>
                                    </div>
                                    <div class="unit-Item OperationRow" id="Iframe_0">
                                        <div class="form-line">
                                            <label>Iframe:</label>
                                            <textarea name="iframearr[]" id="iframearr_0" placeholder="Iframe here. . ." ></textarea>
                                        </div>
                                        <div class="form-line">
                                            <label>Duration:</label>
                                            <input type="text" name="iframedur[]" id="iframedur_0" placeholder="1:30">
                                        </div>
                                    </div>
                                    <div class="unit-Item OperationRow" id="Youtube_0">
                                        <div class="form-line">
                                            <label>Youtube embed link:</label>
                                            <input type="text" name="youtubearr[]" id="youtubearr_0" placeholder="Youtybe embed link here. . ." >
                                        </div>
                                        <div class="form-line">
                                            <label>Duration:</label>
                                            <input type="text" name="youtubedur[]" id="youtubedur_0" placeholder="1:30">
                                        </div>
                                    </div>
                                    <div class="unit-Item OperationRow" id="Video_0">
                                        <div class="form-line">
                                            <label>Video:</label>
                                            <input type="file" name="videoarr[]" id="videoarr_0">
                                            <p style="font-size: 11px !important; color: red">Only .mp4 format supported and file must less then 100MB</p>
                                        </div>
                                        <div class="form-line">
                                            <label>Duration:</label>
                                            <input type="text" name="videodur[]" id="videodur_0" placeholder="1:30">
                                        </div>
                                    </div>
                                    <div class="unit-Item OperationRow" id="Image_0">
                                        <div class="form-line">
                                            <label>PDF:</label>
                                            <input type="file" name="imgarr[]" id="imgarr_0">
                                        </div>
                                        <div class="form-line">
                                            <label>Duration:</label>
                                            <input type="text" name="imgdur[]" id="imgdur_0" placeholder="1:30">
                                        </div>
                                    </div>
                                    <div class="unit-Item OperationRow" id="Quiz_0">
                                        <div class="form-line">
                                            <label>Select Quiz:</label>
                                            <select name="quizarr[]" id="quizarr_0">
                                                <option value="">--- Select One ---</option>
                                                @if(count(App\Http\Controllers\QuizController::GetQuizOnCourse(App\Http\Controllers\CourseProgramController::GetCPONID(collect(request()->segments())->last())->course_id)) > 0)
                                                    @foreach(App\Http\Controllers\QuizController::GetQuizOnCourse(App\Http\Controllers\CourseProgramController::GetCPONID(collect(request()->segments())->last())->course_id) as $v)
                                                        <option value="{!! $v->id !!}">{!! $v->quiz_title !!}</option>
                                                    @endforeach
                                                @endif
                                            </select><br />
                                        </div>
                                        <div class="form-line">
                                            <label>Duration:</label>
                                            <input type="text" name="quizdur[]" id="quizdur_0" placeholder="1:30">
                                        </div>
                                    </div>
                                    <div class="form-line activediv">
                                        <input type="checkbox" name="isactive[]" id="isactive_0" value="0">
                                        <label>Only for registered users</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="InsertItems">
                        <input type="hidden" name="RepeateItem" id="RepeateItem" value="{!! (isset($Units)) ? count($Units)-1 : 0 !!}">
                    </div>
                    <div class="unitHeader saveUnit text-right">
                        <input type="hidden" name="cidd" id="cidd" value="{!! App\Http\Controllers\CourseProgramController::GetCPONID(collect(request()->segments())->last())->course_id !!}">
                        <input type="hidden" name="user_folder" id="user_folder" value="{!! collect(request()->segments())->first() !!}">
                        <button type="button" class="btn btn-info" onclick="javascript:window.location.href = '{{ URL::to("/admin/cplisting/" . App\Http\Controllers\CourseProgramController::GetCPONID(collect(request()->segments())->last())->course_id) }}';">Listing</button>
                        <button type="button" class="btn btn-primary" onclick="javascript:repetar();">Add Unit</button>
                        <button type="submit" class="btn btn-success">Save Units</button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-lg-2"></div>
            </div>
            </form>
        </div>
    </section>
</div>

@endsection

@section('js_libraries')
    <script type="text/javascript" src="{{ asset('js/units.js')}}"></script>
@endsection
