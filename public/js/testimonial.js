
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
  var t_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/gettestimonial/' + t_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Testimonial != 'undefined'){
      Testimonial = data.Testimonial;

      var img_path = $("#img_path").val() + "/";

      $("#edit-t_name").val(Testimonial.testimonial_name);
      $("#edit-t_desc").summernote('code', Testimonial.testimonial_desc);
      $("#edit-t_role").val(Testimonial.testimonial_role);
      $("#t_id").val(t_id);

      if(Testimonial.testimonial_img !== null) {
        $("#avatar_div img").attr("src", img_path + Testimonial.testimonial_img);
      }

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});


function reset_form() {

  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#t_name").val('');
  $("#t_desc").val('');
  $("#t_role").val('');
  $("#avatar_div img").attr("src", "http://via.placeholder.com/150/000000/FFFFFF/?text=File Placeholder");
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

  var t_name = $("#"+ type +"t_name").val();
  var t_desc = $("#"+ type +"t_desc").val();
  var t_role = $("#"+ type +"t_role").val();


  if(t_name == '') {
    errors.push("#"+ type +"t_name");
  }

  if(t_desc == '') {
    errors.push("#"+ type +"t_desc");
  }

  if(t_role == '') {
    errors.push("#"+ type +"t_role");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}