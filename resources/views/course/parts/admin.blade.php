        <table class="table">
            <tbody class="table">
                <thead>
                    </tr>
                    <tr>
                        <th width="3%" class="edit-icon-container">&nbsp;</th>
                        <th width="2%" class="checkbox-container">
                            <input type="checkbox" name="all">
                        </th>
                        <th>Course Title</th>
                        <th>Course Content</th>
                        <th>Status</th>
                        <th width="12%">Number of User's</th>
                        <th width="8%">Set As</th>
                        <th width="12%">Exam's</th>
                        <th width="13%">Instructor Name</th>
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
                            <button type="button" class="btn btn-success approve-course" id="approve-course{{ $Course->id }}" data-id="{{ $Course->id }}" data-status="yes" value="">Approve It <div class="spinnerdiv"><i class="fa fa-spinner fa-pulse"></i></div></button>
                        @else
                            <button type="button" class="btn btn-danger block-course" id="block-course{{ $Course->id }}" data-id="{{ $Course->id }}" data-status="no" value="">Block It <div class="spinnerdiv"><i class="fa fa-spinner fa-pulse"></i></div></button>
                        @endif
                    </td>
                    <td width="12%"><a href="{{ URL::to('/' . collect(request()->segments())->first() .'/students/' . $Course->id) }}">View User's({{ (array_key_exists($Course->id, $Array_User_Count)) ? $Array_User_Count[$Course->id] : 0 }}) </a> </td>
                    <td width="8%"><a href="javascript:void(0);" class="set-as" data-id="{{ $Course->id }}">Set As</a> </td>
                    <td width="12%"><a href="javascript:void(0);">Total exam's ({!! App\Http\Controllers\CoursesController::ExamCount($Course->id) !!})</a></td>
                    <td width="13%">{{ (array_key_exists($Course->id, $Array_Instructor_Name)) ? $Array_Instructor_Name[$Course->id] : "" }}</td>
                </tr>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>
    