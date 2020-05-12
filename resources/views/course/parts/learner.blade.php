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
                        <th>Action</th>
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
                    <td><button class="btn btn-success" onclick="javascript:window.location.href='{{ URL::to("/startcourse/" . $Course->id ) }}'">Start Course</button></td>
                </tr>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
            </tbody>
        </table>