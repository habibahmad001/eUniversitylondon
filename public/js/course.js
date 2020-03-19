
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
  var cou_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getcourse/' + cou_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Courses != 'undefined'){
      Courses = data.Courses;

      var img_path = $("#img_path").val() + "/";

      $("#edit-cou_title").val(Courses.course_title);
      $("#edit-cou_desc").val(Courses.course_desc);
      $("#cou_id").val(cou_id);
      $("#edit-cou_company").val(Courses.created_company);
      $("#edit-cou_what_you_learn").val(Courses.what_you_learn);
      $("#edit-cou_includes").val(Courses.course_includes);
      $("#edit-cou_requirements").val(Courses.course_requirements);
      $("#edit-cou_course_for").val(Courses.course_for);
      $("#edit-cou_price").val(Courses.course_price);
      $("#edit-cou_discounted_price").val(Courses.course_discounted_price);
      $("#avatar_div img").attr("src", img_path + Courses.course_avatar);
      $("#edit-cou_category option").each(function() {
        if($(this).val() == Courses.category_id) {
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
  $("#cou_title").val('');
  $("#cou_desc").val('');
  $("#cou_company").val('');
  $("#cou_what_you_learn").val('');
  $("#cou_includes").val('');
  $("#cou_requirements").val('');
  $("#cou_course_for").val('');
  $("#cou_price").val('');
  $("#cou_discounted_price").val('');
  $("#avatar_div img").attr("src", "http://via.placeholder.com/150x150");
  $("#cou_category").val('');
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

  var cou_title = $("#"+ type +"cou_title").val();
  var cou_desc = $("#"+ type +"cou_desc").val();
  var cou_company = $("#"+ type +"cou_company").val();
  var cou_what_you_learn = $("#"+ type +"cou_what_you_learn").val();
  var cou_includes = $("#"+ type +"cou_includes").val();
  var cou_requirements = $("#"+ type +"cou_requirements").val();
  var cou_course_for = $("#"+ type +"cou_course_for").val();
  var cou_price = $("#"+ type +"cou_price").val();
  var cou_discounted_price = $("#"+ type +"cou_discounted_price").val();
  var cou_category = $("#"+ type +"cou_category").val();

  if(cou_title == '') {
    errors.push("#"+ type +"cou_title");
  }

  if(cou_desc == '') {
    errors.push("#"+ type +"cou_desc");
  }

  if(cou_company == '') {
    errors.push("#"+ type +"cou_company");
  }

  if(cou_what_you_learn == '') {
    errors.push("#"+ type +"cou_what_you_learn");
  }

  if(cou_includes == '') {
    errors.push("#"+ type +"cou_includes");
  }

  if(cou_requirements == '') {
    errors.push("#"+ type +"cou_requirements");
  }

  if(cou_course_for == '') {
    errors.push("#"+ type +"cou_course_for");
  }

  if(cou_price == '') {
    errors.push("#"+ type +"cou_price");
  }

  if(cou_discounted_price == '') {
    errors.push("#"+ type +"cou_discounted_price");
  }

  if(cou_category == '') {
    errors.push("#"+ type +"cou_category");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}