<div class="unit_prevnext">
    <div class="col-md-4 text-center"><a href="{{ URL::to('/startcourse/' . $cid) }}" id="prev_unit" data-unit="159231" class="unit unit_button"><span><< Back to Course</span></a></div>
    <div class="col-md-3 text-center"><a href="{{ URL::to('/examresult/' . $cid) }}" class="quiz_results_popup"><span>Exam's Results</span></a></div>
    <div class="col-md-4 text-center"><a href="/{{ $cid }}{!! (isset($_REQUEST["qid"])) ? "/?qid=" . $_REQUEST["qid"] : "" !!}" id="next_quiz" class="unit unit_button"><span>Proceed to Exam >></span></a></div>
</div>