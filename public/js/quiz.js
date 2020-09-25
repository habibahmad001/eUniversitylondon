
$(".add-button").click(function () {
  reset_form();
  showFormOverlay();

  $(".add-new-data").animate({
    width: "650px"
  }, {
    duration: 500,

  });
});



$(".edit-icon").click(function () {
  showFormOverlay();
  var quiz_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getquiz/' + quiz_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Quizs != 'undefined'){
      Quizs = data.Quizs;

      $("#edit-exe_title").val(Quizs.quiz_title);
      $("#edit-exe_content").summernote('code', Quizs.quiz_content);
      $("#edit-duration").val(Quizs.ExamDuration);
      $("#edit-total_marks").val(Quizs.TotalMarks);
      $("#edit-passing_marks").val(Quizs.PassingMarks);
      $("#exe_id").val(quiz_id);
      $("#edit-cour_id option").each(function() {
        if($(this).val() == Quizs.course_id) {
          $(this).attr("selected","selected");
        }
      });

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#exe_title").val('');
  $("#exe_content").val('');
  $("#duration").val('');
  $("#total_marks").val('');
  $("#passing_marks").val('');
  $("#cour_id").val('');
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var exe_title     = $("#"+ type +"exe_title").val();
  var exe_content   = $("#"+ type +"exe_content").val();
  var duration      = $("#"+ type +"duration").val();
  var total_marks   = $("#"+ type +"total_marks").val();
  var passing_marks = $("#"+ type +"passing_marks").val();
  var cour_id = $("#"+ type +"cour_id").val();


  if(exe_title == '') {
    errors.push("#"+ type +"exe_title");
  }

  if(exe_content == '') {
    errors.push("#"+ type +"exe_content");
  }

  if(duration == '') {
    errors.push("#"+ type +"duration");
  }

  if(total_marks == '') {
    errors.push("#"+ type +"total_marks");
  }

  if(passing_marks == '') {
    errors.push("#"+ type +"passing_marks");
  }

  if(cour_id == '') {
    errors.push("#"+ type +"cour_id");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}