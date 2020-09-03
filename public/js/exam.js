
$(".add-button").click(function () {
  reset_form();
  showFormOverlay();

  $(".add-new-data").animate({
    width: "650px"
  }, {
    duration: 500,

  });
});

// ---------- remove all --------
$(".custonDelete").click(function(e) {
  var c = confirm('Are you sure you want to delete selected exam?');
  if(c) {
    $(".delfrm").submit();
  }
});

$('.content .table .checkbox-container-new :checkbox').change(function(event) {
  if($('.content .table .checkbox-container-new :checkbox').is(":checked")) {
    $('.custonDelete').addClass("show-btn");
  } else {
    $('.custonDelete').removeClass("show-btn");
  }
});

$('input[name="allnew"]').change(function(){
  var status = $(this).is(':checked');
  if (status==true) {
    $('input.checkbox-selector:checkbox').prop('checked',true);
    $('.custonDelete').addClass("show-btn");
    $('.edit-icon').removeClass('show');
  } else {
    $('input.checkbox-selector:checkbox').prop('checked', false);
    $('.custonDelete').removeClass("show-btn");
    $('tbody tr').removeClass('yellow');
  }
});
// ---------- remove all --------

$(".edit-icon").click(function () {
  showFormOverlay();
  var exm_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getexam/' + exm_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Exams != 'undefined'){
      Exams = data.Exams;

      $("#edit-exe_title").val(Exams.exam_title);
      $("#edit-exe_content").summernote('code', Exams.exam_content);
      $("#exe_id").val(exm_id);
      $("#edit-cour_id option").each(function() {
        if($(this).val() == Exams.course_id) {
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
  $("#cour_id").val('');
}


function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var exe_title = $("#"+ type +"exe_title").val();
  var exe_content = $("#"+ type +"exe_content").val();
  var cour_id = $("#"+ type +"cour_id").val();


  if(exe_title == '') {
    errors.push("#"+ type +"exe_title");
  }

  if(exe_content == '') {
    errors.push("#"+ type +"exe_content");
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
