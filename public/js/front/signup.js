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
    $("input[name='payment']").click(function () {
        if($(this).val() == 1) {
            $('#card-form').slideDown( "slow", function() {
                // Animation complete.
            });
        } else {
            $('#card-form').slideUp( "slow", function() {
                // Animation complete.
            });
        }

    });

    $('div#ratings-id ul li').mouseover(function(e) {
        if($("#star_val").val() == 0) {
            $(this).find("i").attr("class", "fa fa-star");
        }
    });

    $('div#ratings-id ul li').mouseout(function(e) {
        if($("#star_val").val() == 0) {
            $(this).find("i").attr("class", "fa fa-star-o");
        }
    });

    $('div#ratings-id ul li').click(function(e) {
        if($("#star_val").val() == 0) {
            $("#star_val").attr("value", $(this).attr("data-starval"));
            $(this).find("i").attr("class", "fa fa-star");
        }
    });

    $("a[name='exlink']").click(function(){
        var linkName    =   $(this).attr("data-exType");
        sessionStorage.setItem("examtype", linkName);
    });

    jQuery("#next_quiz").click(function(){
        jQuery(this).attr("href", "/" + sessionStorage.getItem('examtype') + $(this).attr("href"));
    });
})(jQuery);

function validateEmailExist(type) {
  var email = $("#"+type+"email").val();
  var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(email_rgx.test(email)) {
    // var user_id = $("#user_id").val();
    var user_id = 0;
    $.get('/email-exist?id=' + user_id +'&email=' + email, function(data){
      if(data.exist) {
        $("#"+type+"email_exist").val('1');
        $("#"+type+"email-exist").css({"box-shadow": "0 0 0 2px #5caf01", "color": "#5caf01"});
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
  validateEmailExist("");

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
      $(errors[i]).addClass('error');
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
            $(errors[i]).addClass('error');
        }
        return false;
    }

    return true;
}

function card_validate(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];
    var cnumber = $("#"+ type +"cnumber").val();
    var card_expiry_month = $("#"+ type +"card_expiry_month").val();
    var card_expiry_year = $("#"+ type +"card_expiry_year").val();
    var ccode = $("#"+ type +"ccode").val();

    if(cnumber == '') {
        errors.push("#"+ type +"cnumber");
    }

    if(card_expiry_month == '') {
        errors.push("#"+ type +"card_expiry_month");
    }

    if(card_expiry_year == '') {
        errors.push("#"+ type +"card_expiry_year");
    }

    if(ccode == '') {
        errors.push("#"+ type +"ccode");
    }

    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            $(errors[i]).addClass('error');
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
            $(errors[i]).addClass('error');
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
            $(errors[i]).addClass('error');
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
            $(errors[i]).addClass('error');
        }
        return false;
    }

    return true;
}

$("button[name='cms']").click(function(){
    var id = $(this).attr('data-id');
    var pid = $(this).attr('data-pid');

    $("#cmsID").val(id);
    $("#cmsPID").val(pid);

    // console.log(id + "=" + pid);

    // $.get('/getcms/' + id, function(data){
    //     if(typeof data.CMS != 'undefined') {
    //         cms = data.CMS;
    //         $("#cms_title").val(cms.cms_title);
    //         $("#cms_desc").summernote('code', cms.cms_desc);
    //     }
    // });
});

$("button[name='cms']").click(function(){
    var id = $(this).attr('data-id');

    $('#cmsfrmid').attr("src", "/cmsupdate/" + id);

});

// $("#cmssave").click(function(){
//     var iframe = document.getElementById('cmsfrmid');
//     var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
//     alert(innerDoc.find("#cmsfrmid").html());
//     console.log($(innerDoc).find("#cmsfrmid").html());
//     $(innerDoc.form).submit();
//     // $('#cmsModal').modal('hide');
// });
$("#cmssave").click(function(){

    /*********** Set hidden variables *************/
    var pid = $("button[data-id='"+$("#cmsID", frames['cmsfrmid'].document).val()+"']").attr('data-pid');

    $("#cmsPID", frames['cmsfrmid'].document).val(pid);

    // console.log(pid);
    /*********** Set hidden variables *************/

    $("#cmsformmodel", frames['cmsfrmid'].document).submit();
    $('#cmsModal').modal('hide');
    if($("#page_name").val() == "") {
        window.location.href = "/cmsreload/home";
    } else {
        window.location.href = "/cmsreload/" + $("#page_name").val();
    }

});

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
            $(errors[i]).addClass('error');
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
            $(errors[i]).addClass('error');
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

/************ Auto-Complete JS *************/

var AutoCompArr = [];

$.get('/searchcourse', function(data){
    var Courses = data;
    for(var i=0; i<Courses.length; i++) {
        AutoCompArr.push(Courses[i].course_title);
    }
});
// autocomplete(document.getElementById("search-form-widget"), AutoCompArr);
// $( function() {
//
//     var availableTags = AutoCompArr;
//     $( "#search-form-widget" ).autocomplete({
//         source: availableTags
//     });
//     $( "#search-form-top" ).autocomplete({
//         source: availableTags
//     });
// } );
(function( $ ) {
    function autocompl(inputID = "search-form-top") {
        $("#" + inputID).keyup(function(){
            $("ul#autoul").remove();
            var lichk = 0;
            var appendele = "<ul id='autoul'>";
            for(var i=0; AutoCompArr.length >= i; i++) {
                if(typeof AutoCompArr[i] != "undefined") {
                    var temmatch    =   "";
                    temmatch    =   AutoCompArr[i].toLowerCase();
                    if (temmatch.indexOf($(this).val()) >= 0) {
                        // console.log(AutoCompArr[i]);
                        replacetxt = temmatch.replace($(this).val(), "<b>" + $(this).val() + "</b>");
                        appendele += "<li id='"+i+"'>" + replacetxt + "</li>";
                        if($(this).val() != "") {
                            lichk = 1;
                        }
                    }
                }
            }
            appendele += "</ul>";
            // console.log(appendele);
            if(lichk == 1) {
                $(appendele).insertAfter("#" + inputID);
            }
        });
        $(document).on('click', "#autoul li", function(e) {
            $("#" + inputID).val($(this).text());
            $("ul#autoul").remove();
        });
    }
    autocompl();
    autocompl("search-form-widget");
})( jQuery );

/************ Auto-Complete JS *************/


/************ Search JS *************/
$("#cat_search, .home-search-btn").click(function(){
    $(this).closest("form").attr("action", "/search").submit();
});
$("#top-bar-search").click(function(){
    var searchterm = $('#search-form-top').val();
    $(this).closest("form").attr("action", "/searchtype/" + searchterm).submit();
});
/************ Search JS *************/

function product_submit(id) {
    $("#itm-post-" + id).html('<input type="hidden" name="pid" id="pid" value="' + id + '">');
    $('#prod').submit();
}

function cart_item_submit(id, addinput = 'addinput', formid = 'cart-update') {
    $("#" + addinput).html('<input type="hidden" name="itemid" id="itemid" value="' + id + '">');
    $('#' + formid).attr("action", "/cartremoveitem").submit();
}

function Get_CP_PDF(ID) {
    $.get('/getcppdf/' + ID, function(data){
        /*$("#my-pdf").html('<div class="preloader">\n' +
                            '    <div class="preloader_image"></div>\n' +
                            '</div>');*/
        var Courses = data;
        var msg = "";
        if(data.msg == "newitem") {
            msg = "Course has been started!";
            PDFObject.embed("/uploads/courseprogrampdf/" + Courses.pdf, "#my-pdf", options);
        } else if(data.msg == "less") {
            msg = "You already cleared this program!";
        } else if(data.msg == "notexist") {
            msg = "Congratulation you completed this course!";
        } else if(data.msg == "wrongstep") {
            msg = "You are not eligible for this program Yet!";
        } else if(data.msg == "nocp") {
            msg = "No course program added for this course Yet!";
        } else if(data.msg == "updated") {
            msg = "Congratulation you completed this program!";
            PDFObject.embed("/uploads/courseprogrampdf/" + Courses.pdf, "#my-pdf", options);
        }
        $("#msg").text(msg).show().fadeOut(6500);

    });

}


function validation_ask(type) {
    $(".error").each(function(){
        $(this).removeClass('error');
    });
    var errors = [];
    var first_name = $("#"+ type +"first-name").val();
    var last_name = $("#"+ type +"last-name").val();
    var cemail = $("#"+ type +"cemail").val();
    var cphone = $("#"+ type +"cphone").val();
    var cmessage = $("#"+ type +"cmessage").val();

    var phone_regex = /^\d{3}(-)\d{3}(-)\d{4}$/;
    var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


    if(first_name == '') {
        errors.push("#"+ type +"first-name");
    }

    if(last_name == '') {
        errors.push("#"+ type +"last-name");
    }

    if(!email_rgx.test(cemail)) {
        errors.push("#"+ type +"cemail");
    }

    if(!phone_regex.test(cphone)) {
        errors.push("#"+ type +"cphone");
    }

    if(cmessage == '') {
        errors.push("#"+ type +"cmessage");
    }

    if(errors.length>0){
        for(i=0; i < errors.length; i++){
            if(errors[i].length) {
                $(errors[i]).addClass('error');
            } else {
                alert("ID " + errors[i] + " is missing.");
            }


        }
        return false;
    }

    return true;
}