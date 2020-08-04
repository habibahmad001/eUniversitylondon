        <table class="table">
            <tbody class="table">
                <thead>
                    <tr>
                        <th width="3%" class="edit-icon-container">&nbsp;</th>
                        <th width="2%" class="checkbox-container">
                            <input type="checkbox" name="all">
                        </th>
                        <th>Course Title</th>
                        <th>Course Content</th>
                        <th>Status</th>
                        <th width="15%">Instructor Name</th>
                        <th>Exam's</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                @if(count($Courses)) @foreach ($Courses as $Course)
                <tr>
                    <th class="edit-icon-container">
                        @if(collect(request()->segments())->first() != 'learner')
                            <span class="edit-icon" data-id="{{ $Course->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
                        @endif
                    </th>
                    <th class="checkbox-container">
                        <input type="checkbox" name="del_course[]" value="{{ $Course->id }}" class="checkbox-selector">
                    </th>
                    <td>{{ $Course->course_title }}</td>
                    <td>{{ (strlen(strip_tags($Course->course_desc)) > 150) ? substr(strip_tags($Course->course_desc), 0, 150) . "..." : strip_tags($Course->course_desc) }}</td>
                    <td>
                        @if($Course->course_status == "no")
                            <button type="button" class="btn btn-success approve-course w-93px" id="approve-course{{ $Course->id }}" data-id="{{ $Course->id }}" data-status="yes" value="">Approve It <div class="spinnerdiv"><i class="fa fa-spinner fa-pulse"></i></div></button>
                        @else
                            <button type="button" class="btn btn-danger block-course w-93px" id="block-course{{ $Course->id }}" data-id="{{ $Course->id }}" data-status="no" value="">Block It <div class="spinnerdiv"><i class="fa fa-spinner fa-pulse"></i></div></button>
                        @endif
                    </td>
                    <td width="15%">{{ (array_key_exists($Course->id, $Array_Instructor_Name)) ? $Array_Instructor_Name[$Course->id] : "" }}</td>
                    <td width="15%"><a href="{{ URL::to("/" . collect(request()->segments())->first() . "/examlisting/" . $Course->id) }}">Total Exam's ({!! App\Http\Controllers\CoursesController::ExamCount($Course->id) !!})</a></td>
                    <td width="15%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary BTNMenu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                            <div class="dropdown-menu">
                                <a href="javascript:void(0);" class="dropdown-item set-as" data-id="{{ $Course->id }}">Set As</a>
                                <a href="javascript:void(0);" class="dropdown-item offer @if(App\Http\Controllers\CoursesController::OfferApplied($Course->id) == "Offer Is Expired") {{ "expiried" }} @elseif(App\Http\Controllers\CoursesController::OfferApplied($Course->id) == "Offer Is Active") {{ "active-offer" }} @endif" data-id="{{ $Course->id }}">{!! App\Http\Controllers\CoursesController::OfferApplied($Course->id) !!}</a>
                                <a href="{{ URL::to("/" . collect(request()->segments())->first() . "/cplisting/" . $Course->id) }}">Add Curriculum ({!! App\Http\Controllers\CoursesController::CurriculumCount($Course->id) !!})</a>
                                <a href="{{ URL::to('/' . collect(request()->segments())->first() .'/students/' . $Course->id) }}" class="dropdown-item">View Student's({{ (array_key_exists($Course->id, $Array_User_Count)) ? $Array_User_Count[$Course->id] : 0 }}) </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>
    