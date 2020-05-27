
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
  var cp_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getcourseprogram/' + cp_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.CourseProgram != 'undefined'){
      CourseProgram = data.CourseProgram;

      $("#edit-title").val(CourseProgram.cp_title);
      $("#edit-desc").summernote('code', CourseProgram.cp_desc);
      $("#edit-author").val(CourseProgram.cp_author);
      $("#edit-placement").val(CourseProgram.cp_placement);
      $("#cp_id").val(cp_id);
      $("#edit-cour_id option").each(function() {
        if($(this).val() == CourseProgram.course_id) {
          $(this).attr("selected","selected");
        }
      });
      if(CourseProgram.pdf !== null) {
        $("#edit-pdf_div").html('<a href="/uploads/courseprogrampdf/' + CourseProgram.pdf + '" target="_blank"><img src="/images/pdficon.png" width="150" height="150"></a>');
      }

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#title").val('');
  $("#desc").val('');
  $("#author").val('');
  $("#placement").val('');
  $("#cour_id").val('');
  $("#pdf_div").html('<img src="/images/pdficon.png" width="150" height="150">');
}

function validateEmailExist(type) {
  var email = $("#"+type+"email").val();
  var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(email_rgx.test(email)) {
    var user_id = $("#user_id").val();
    $.get('/email-exist?id=' + user_id +'&email=' + email, function(data){
      if(data.exist) {
        $("#"+type+"email_exist").val('1');
        $("#"+type+"email-exist").css('color','#ff0000');
        $("#"+type+"email-exist").html('E-mail already exists.');
      } else {
        $("#"+type+"email-exist").html('');
        $("#"+type+"email_exist").val('');
      }
    })

  }
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var title = $("#"+ type +"title").val();
  var desc = $("#"+ type +"desc").val();
  var author = $("#"+ type +"author").val();
  var placement = $("#"+ type +"placement").val();
  var cour_id = $("#"+ type +"cour_id").val();


  if(title == '') {
    errors.push("#"+ type +"title");
  }

  if(desc == '') {
    errors.push("#"+ type +"desc");
  }

  if(author == '') {
    errors.push("#"+ type +"author");
  }

  if(placement == '') {
    errors.push("#"+ type +"placement");
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