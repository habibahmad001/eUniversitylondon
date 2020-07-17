<table class="table">
    <tbody class="table">
    <thead>
    </tr>
    <tr>
        <th width="3%" class="edit-icon-container">&nbsp;</th>
        <th width="2%" class="checkbox-container">
            <input type="checkbox" name="all">
        </th>
        <th>{!! (collect(request()->segments())->pull(1) == 'childqa') ? "Answer" : "Question" !!}</th>
        <th>Exam Type</th>
        <th>{!! (collect(request()->segments())->pull(1) == 'childqa') ? "Question Name" : "Exam Name" !!}</th>
        <th>View Answers</th>
        @if(collect(request()->segments())->pull(1) == 'childqa')
            <th>Action</th>
        @endif
    </tr>
    </thead>
    @if(count($QandA)) @foreach ($QandA as $qa)
        <tr>
            <th class="edit-icon-container">
                <span class="edit-icon" data-id="{{ $qa->id }}"><img src="{{URL::asset('/images/')}}/edit-icon.png" alt="" title=""></span>
            </th>
            <th class="checkbox-container">
                <input type="checkbox" name="del_questionandanswer[]" value="{{ $qa->id }}" class="checkbox-selector">
            </th>
            <td>{{ $qa->qa_title }}</td>
            <td>{{ $qa->table_name  }}</td>
            <td>{!! (collect(request()->segments())->pull(1) == 'childqa') ? App\Http\Controllers\QandAController::QuestionData($qa->qa_cid)->qa_title : App\Http\Controllers\QandAController::ExamData($qa->exam_qa_id, $qa->table_name)->exam_title !!}</td>
            @if(collect(request()->segments())->pull(1) != 'childqa')
                <td><a href="/{{ collect(request()->segments())->first() }}/childqa/{{ $qa->id }}">View Answers {{ App\Http\Controllers\QandAController::AnswerCount($qa->id) }}</a></td>
            @else
                <td>It's Answers</td>
            @endif
            @if(collect(request()->segments())->pull(1) == 'childqa')
                <td>{!! ($qa->isCorrect == "no") ? '<button type="button" class="btn btn-danger" onclick="javascript:window.location.href=\'/'.collect(request()->segments())->first().'/updateansstatus/'.$qa->id.'\';">Mark as Correct</button>' : '<button type="button" class="btn btn-success" onclick="javascript:window.location.href=\'/'.collect(request()->segments())->first().'/updateansstatus/'.$qa->id.'\';">Mark as Wrong</button>' !!}</td>
            @endif
        </tr>
    @endforeach @else
        <tr>
            <th colspan="6" class="error">No results found</th>
        </tr>
        @endif
        </tbody>
</table>