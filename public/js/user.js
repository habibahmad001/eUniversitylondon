
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
  var user_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  $.get('/getusers/' + user_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.user != 'undefined'){
      user = data.user;
      $("#user_id").val(user_id);
      $("#edit-first_name").val(user.first_name);
      $("#edit-last_name").val(user.last_name);
      $("#edit-email").val(user.email);
      // $("#state").val(store.state_id);
      $("#edit-phone").val(user.phone);
      $("#edit-status").val(user.status);

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#first_name").val('');
  $("#last_name").val('');
  $("#edit-email").val('');
  $("#phone").val('');
  $("#status").val('');
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
  var email_exist = $("#"+type+"email_exist").val();
  var fname = $("#"+ type +"first_name").val();
  var lname = $("#"+ type +"last_name").val();
  var phone = $("#"+ type +"phone").val();
  var email = $("#"+ type +"email").val();
  var password = $("#"+ type +"password").val();
  var conpassword = $("#"+ type +"conpassword").val();
  var status = $("#"+ type +"status").val();

  var phone_regex = /^\d{3}(-)\d{3}(-)\d{4}$/;
  var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(fname == '') {
    errors.push("#"+ type +"first_name");
  }

  if(lname == '') {
    errors.push("#"+ type +"last_name");
  }

 if(status == '') {
    errors.push("#"+ type +"status");
  }
  if(email_exist) {
    errors.push("#"+ type +"email");
  }
  if(!email_rgx.test(email)) {
    errors.push("#"+ type +"email");
  }

  if(!phone_regex.test(phone)) {
    errors.push("#"+ type +"phone");
  }
  if(type == ''){
  if(password == '') {
    errors.push("#"+ type +"password");
  }
  /*if(password!=conpassword){
        $("#"+type+"password-match").html('');
        $("#"+type+"password-match").css('color','#ff0000');
        $("#"+type+"password-match").html('Password Not match');
  }*/
}

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');;
    }
    return false;
  }

  return true;
}