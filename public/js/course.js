
$(".add-button").click(function () {
  reset_form();
  showFormOverlay();

  $(".add-new-data").animate({
    width: "406px"
  }, {
    duration: 500,

  });
});

$(".set-as").click(function () {
  showFormOverlay();
  var cou_id = $(this).attr('data-id');

  $(".set-product").animate({
    width: "406px"
  }, {
    duration: 500,

  });

  var user_folder = $("#puser_folder").val();
  $.get('/' + user_folder + '/getcourse/' + cou_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    if(typeof data.Courses != 'undefined'){
      Courses = data.Courses;

      $("#p_cou_id").val(cou_id);

      $("#set_p option").each(function() {
        if(Courses.setas.includes($(this).val())) {
          $(this).attr("selected","selected");
        }
      });

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

$(".close-icon, .cancel-button").click(function(){
  window.location.reload();
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
      $("#edit-cou_desc").summernote('code', Courses.course_desc);
      $("#cou_id").val(cou_id);
      $("#edit-cou_lectures").val(Courses.course_lectures);
      $("#edit-cou_video").val(Courses.course_video);
      $("#edit-cou_duration").val(Courses.course_duration);
      $("#edit-cou_includes").val(Courses.course_includes);
      $("#edit-youtube").val(Courses.youtube);
      $("#edit-cou_price").val(Courses.course_price);
      $("#edit-cou_discounted_price").val(Courses.course_discounted_price);
      if(Courses.course_avatar !== null) {
        $("#avatar_div img").attr("src", img_path + Courses.course_avatar);
      }
      // $("#edit-cou_language option").each(function() {
      //     $(this).removeAttr('selected');
      // });
      $("#edit-cou_language option").each(function() {
        if(Courses.course_language.includes($(this).val())) {
          $(this).attr("selected","selected");
        }
      });
      // $("#edit-cou_category option").each(function() {
      //   $(this).removeAttr('selected');
      // });
      console.log(Courses.category_id);
      $("#edit-cou_category option").each(function() {
        if(Courses.category_id.includes($(this).val())) {
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
  $("#cou_lectures").val('');
  $("#cou_video").val('');
  $("#cou_duration").val('');
  $("#cou_includes").val('');
  $("#youtube").val();
  $("#cou_price").val('');
  $("#cou_discounted_price").val('');
  $("#avatar_div img").attr("src", "http://via.placeholder.com/150/000000/FFFFFF/?text=File Placeholder");
  $("#edit-cou_language option").each(function() {
    $(this).removeAttr('selected');
  });
  $("#edit-cou_category option").each(function() {
    $(this).removeAttr('selected');
  });
}

$(".approve-course, .block-course").click(function () {
  var user_folder = $("#user_folder").val();
  $(this).children(".spinnerdiv").attr("style", 'visibility: visible;');
  $.post('/' + user_folder + '/updatestatus', {p_id: $(this).attr("data-id"), status: $(this).attr("data-status"), inputid: $(this).attr("id"), _token: $('meta[name="csrf-token"]').attr('content')}, function (data, status) {
    if(status == "success") {
      if(data.statuss == "yes"){
        $("#" + data.itemid).addClass("btn-danger").removeClass("btn-success").html('Block It <div class="spinnerdiv" style="visibility: visible;"><i class="fa fa-spinner fa-pulse"></i></div>');
        $("#" + data.itemid).children(".spinnerdiv").hide();
      } else {
        $("#" + data.itemid).addClass("btn-success").removeClass("btn-danger").html('Approve It <div class="spinnerdiv" style="visibility: visible;"><i class="fa fa-spinner fa-pulse"></i></div>');
        $("#" + data.itemid).children(".spinnerdiv").hide();
      }
    }
  });
});

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
  var cou_lectures = $("#"+ type +"cou_lectures").val();
  var cou_language = $("#"+ type +"cou_language").val();
  var cou_video = $("#"+ type +"cou_video").val();
  var cou_duration = $("#"+ type +"cou_duration").val();
  var cou_includes = $("#"+ type +"cou_includes").val();
  var youtube = $("#"+ type +"youtube").val();
  var cou_price = $("#"+ type +"cou_price").val();
  var cou_discounted_price = $("#"+ type +"cou_discounted_price").val();
  var cou_category = $("#"+ type +"cou_category").val();

  if(cou_title == '') {
    errors.push("#"+ type +"cou_title");
  }

  if(cou_desc == '') {
    errors.push("#"+ type +"cou_desc");
  }

  if(cou_lectures == '') {
    errors.push("#"+ type +"cou_lectures");
  }

  if(cou_language == '') {
    errors.push("#"+ type +"cou_language");
  }

  if(cou_video == '') {
    errors.push("#"+ type +"cou_video");
  }

  if(cou_duration == '') {
    errors.push("#"+ type +"cou_duration");
  }

  if(cou_includes == '') {
    errors.push("#"+ type +"cou_includes");
  }

  if(cou_price == '') {
    errors.push("#"+ type +"cou_price");
  }

  if(youtube == '') {
    errors.push("#"+ type +"youtube");
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