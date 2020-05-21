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

    $(".woocommerce-message").fadeOut(9000);
    $('#paypalfrm').submit();

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

function accountdetail_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];
    var account_first_name = $("#"+ type +"account_first_name").val();
    var account_last_name = $("#"+ type +"account_last_name").val();
    var account_email = $("#"+ type +"account_email").val();
    var password_current = $("#"+ type +"password_current").val();
    var password_1 = $("#"+ type +"password_1").val();
    var password_2 = $("#"+ type +"password_2").val();
    var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


    if(account_first_name == '') {
        errors.push("#"+ type +"account_first_name");
    }

    if(account_last_name == '') {
        errors.push("#"+ type +"account_last_name");
    }

    if(account_email == '') {
        errors.push("#"+ type +"account_email");
    }

    if(!email_rgx.test(account_email)) {
        errors.push("#"+ type +"account_email");
    }

    if(password_current != "")
    {
        if((password_1 == "" || password_2 == "") || password_1!=password_2){
            $("#"+type+"password-match").html('');
            $("#"+type+"password-match").css('color','#ff0000');
            $("#"+type+"password-match").html('Password Not match');
            errors.push("#"+ type +"password_1");
            errors.push("#"+ type +"password_2");
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


function reset_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];

    var account_email = $("#"+ type +"account_email").val();
    var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(account_email == '') {
        errors.push("#"+ type +"account_email");
    }

    if(!email_rgx.test(account_email)) {
        errors.push("#"+ type +"account_email");
    }

    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            $(errors[i]).addClass('error');;
        }
        return false;
    }

    return true;
}

function update_pass_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];

    var new_password = $("#"+ type +"new_password").val();
    var confirm_password = $("#"+ type +"confirm_password").val();

    if((new_password == "" || confirm_password == "") || confirm_password!=confirm_password){
        errors.push("#"+ type +"new_password");
        errors.push("#"+ type +"confirm_password");
    }


    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            $(errors[i]).addClass('error');;
        }
        return false;
    }

    return true;
}


$("#b_edit").click(function () {
    $("p[data-msg=\"b_msg\"]").toggle(1500);
    $("#b_info").toggle(1500);
    if($("#b_info").is(":visible")) {
        $("#same").attr("checked", "checked");
    } else {
        $("#same").removeAttr("checked");
    }
});
$("#s_edit").click(function () {
    $("p[data-msg=\"s_msg\"]").toggle(1500);
    $("#s_info").toggle(1500);
});
$("#same").click(function () {
    // if($(this).is(":checked")) {
        $("p[data-msg=\"s_msg\"]").toggle(1500);
        $("#s_info").toggle(1500);
    // }

});

function cart_login_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];
    var email = $("#"+ type +"email-login-cart").val();
    var password = $("#"+ type +"password-login-cart").val();


    if(email == '') {
        errors.push("#"+ type +"email-login-cart");
    }

    if(password == '') {
        errors.push("#"+ type +"password-login-cart");
    }

    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            $(errors[i]).addClass('error');;
        }
        return false;
    }

    return true;
}

function shipping_address_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];
    var street = $("#"+ type +"street").val();
    var count = $("#"+ type +"count").val();
    var stat = $("#"+ type +"stat").val();
    var city = $("#"+ type +"city").val();
    var zip = $("#"+ type +"zip").val();


    if(street == '') {
        errors.push("#"+ type +"street");
    }

    if(stat == '') {
        errors.push("#"+ type +"stat");
    }
    if(count == '') {
        errors.push("#"+ type +"count");
    }

    if(city == '') {
        errors.push("#"+ type +"city");
    }

    if(zip == '') {
        errors.push("#"+ type +"zip");
    }
    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            $(errors[i]).addClass('error');;
        }
        return false;
    }

    return true;
}

function pickstate(id, itemId="") {
    $.get('/selectstate/' + id, function(data){
        var States = data;

        var res_var = "";
        for(var i=0; i<States.length; i++) {
            if(typeof States != 'undefined') {
                console.log(States[i].state_name);
                res_var += "<option value='" + States[i].id + "'>" + States[i].state_name + "</option>\n";
            }
        }
        if(itemId == "s_count") {
            $("#s_stat").html(res_var);
        } else {
            $("#stat").html(res_var);
        }
    });
}

function product_submit(id) {
    $("#itm-post-" + id).html('<input type="hidden" name="pid" id="pid" value="' + id + '">');
    $('#prod').submit();
}

function cart_item_submit(id) {
    $("#addinput").html('<input type="hidden" name="itemid" id="itemid" value="' + id + '">');
    $('#cart-update').attr("action", "/cartremoveitem").submit();
}