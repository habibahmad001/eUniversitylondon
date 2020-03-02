
$(".add-button").click(function () {
  reset_form();
  showFormOverlay();

  $(".add-new-data").animate({
    width: "406px"
  }, {
    duration: 500,

  });
});



$(".edit-icon").click(function () {
  showFormOverlay();
  var question_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  $.get('/getQuestion/' + question_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.questions != 'undefined'){
      question = data.questions;
      $("#question_id").val(question_id);
      $("#edit-question").val(question.question);
      $("#edit-answer").val(question.answer);
      $("#edit-level").val(question.level_id);
      $("#edit-category").val(question.category_id);
      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#question").val('');
  $("#level").val('');
  $("#category").val('');
}


function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];
  var question = $("#"+ type +"question").val();
  var answer = $("#"+ type +"answer").val();
  var level = $("#"+ type +"level").val();
  var category = $("#"+ type +"category").val();
  
  if(question == '') {
    errors.push("#"+ type +"question");
  }
  if(answer == '') {
    errors.push("#"+ type +"answer");
  }

  if(level == '') {
    errors.push("#"+ type +"level");
  }

 if(category == '') {
    errors.push("#"+ type +"category");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');;
    }
    return false;
  }

  return true;
}