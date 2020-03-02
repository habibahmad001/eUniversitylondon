function validate() {
  $("#fname_error").hide();
  $("#lname_error").hide();
  $("#email_error").hide();
  $("#password_error").hide();
  var fname = $("#first_name").val();
  var lname = $("#last_name").val();
  var email = $("#email").val();
  var pass = $("#password").val();
  var con_pass = $("#password_confirmation").val();
  var email_rgx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var flag = true;
  if(fname == '') {
    $("#fname_error").show();
    flag = false;
  }
  if(lname == '') {
    $("#lname_error").show();
    flag = false;
  }
  if(!email_rgx.test(email)) {
    $("email_error").show();
    flag = false;
  }
  if(pass!='' && (pass!=con_pass)) {
    $("#password_error").show();
    flag = false;
  }


  return flag;
}
