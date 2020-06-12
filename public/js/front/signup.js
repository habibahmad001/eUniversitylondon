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

function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}
autocomplete(document.getElementById("search-form-widget"), AutoCompArr);
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

function cart_item_submit(id) {
    $("#addinput").html('<input type="hidden" name="itemid" id="itemid" value="' + id + '">');
    $('#cart-update').attr("action", "/cartremoveitem").submit();
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
        } else if(data.msg == "updated") {
            msg = "Congratulation you completed this program!";
            PDFObject.embed("/uploads/courseprogrampdf/" + Courses.pdf, "#my-pdf", options);
        }
        $("#msg").text(msg).show().fadeOut(6500);

    });

}