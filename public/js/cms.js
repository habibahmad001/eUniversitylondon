
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
  var cms_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  $.get('/admin/getcms/' + cms_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.cms != 'undefined'){
      cms = data.cms;

      $("#edit-cms_title").val(cms.cms_title);
      $("#edit-cms_desc").summernote('insertText', cms.cms_desc);
      $("#cms_id").val(cms_id);

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#cms_title").val('');
  $("#cms_desc").val('');
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

  var cms_title = $("#"+ type +"cms_title").val();
  var cms_desc = $("#"+ type +"cms_desc").val();


  if(cms_title == '') {
    errors.push("#"+ type +"cms_title");
  }

  if(cms_desc == '') {
    errors.push("#"+ type +"cms_desc");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}