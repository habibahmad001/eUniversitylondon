(function($){
    $("div[id^='form']").each(function(){

        var currentModal = $(this);

        // click next
        currentModal.find('.sign-mod').click(function(){
          currentModal.modal('hide');
          currentModal.closest("div[id^='form']").nextAll("div[id^='form']").first().modal('show');
        });

        // click prev
        currentModal.find('.login-mod').click(function(){
          currentModal.modal('hide');
          currentModal.closest("div[id^='form']").prevAll("div[id^='form']").first().modal('show');
        });

    });

    $(".alert-danger").fadeOut(12000);

})(jQuery);

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
  var conpassword = $("#"+ type +"sigpassword").val();
  var status = $("#"+ type +"status").val();
  var user_type = $("#"+ type +"user_type").val();
  var updates = $("#"+ type +"updates").val();
  var agree = $("#"+ type +"agree").val();

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

 if(!$("#agree").is(":checked")){
    errors.push("#"+ type +"l-agree");
 }

 if(!$("#updates").is(":checked")){
    errors.push("#"+ type +"l-updates");
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

  if(user_type == '') {
    errors.push("#"+ type +"user_type");
  }

  if(type == ''){
  if(password == '') {
    errors.push("#"+ type +"password");
  }
  if(password!=conpassword){
        $("#"+type+"password-match").html('');
        $("#"+type+"password-match").css('color','#ff0000');
        $("#"+type+"password-match").html('Password Not match');
        errors.push("#"+ type +"password");
        errors.push("#"+ type +"sigpassword");
  }
}

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');;
    }
    return false;
  }

  return true;
}

function login_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];
    var email = $("#"+ type +"email-login").val();
    var password = $("#"+ type +"password-login").val();


    if(email == '') {
        errors.push("#"+ type +"email-login");
    }

    if(password == '') {
        errors.push("#"+ type +"password-login");
    }

    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            $(errors[i]).addClass('error');;
        }
        return false;
    }

    return true;
}