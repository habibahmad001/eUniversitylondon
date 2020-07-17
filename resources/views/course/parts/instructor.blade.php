
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
                        <th width="12%">Exam's</th>
                        <th width="12%">Number of User's</th>
                    </tr>
                </thead>
                @if(count($Courses)) @foreach ($Courses as $Course)
                <tr>
                    <th class="edit-icon-container"><span class="edit-icon" data-id="{{ $Course->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span></th>
                    <th class="checkbox-container"><input type="checkbox" name="del_course[]" value="{{ $Course->id }}" class="checkbox-selector"></th>
                    <td>{{ $Course->course_title }}</td>
                    <td>{{ (strlen(strip_tags($Course->course_desc)) > 150) ? substr(strip_tags($Course->course_desc), 0, 150) . "..." : strip_tags($Course->course_desc) }}</td>
                    <td>
                        @if($Course->course_status == "no")
                            <button class="btn btn-warning">Pending</button>
                        @else
                            <button class="btn btn-success">Approved</button>
                        @endif
                    </td>
                    <td width="12%"><a href="{{ URL::to("/" . collect(request()->segments())->first() . "/examlisting/" . $Course->id) }}">Total exam's ({!! App\Http\Controllers\CoursesController::ExamCount($Course->id) !!})</a></td>
                    <td width="12%"><a href="{{ URL::to('/' . collect(request()->segments())->first() .'/students/' . $Course->id) }}">View User's({{ (array_key_exists($Course->id, $Array_User_Count)) ? $Array_User_Count[$Course->id] : 0 }}) </a> </td>

                </tr>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>