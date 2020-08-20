
$(".add-button").click(function () {
  reset_form();
  showFormOverlay();

  $(".add-new-data").animate({
    width: "650px"
  }, {
    duration: 500,

  });
});



$(".edit-icon").click(function () {
  showFormOverlay();
  var cat_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  $.get('/admin/getcategories/' + cat_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.categories != 'undefined'){
      categories = data.categories;

      $("#edit-cat_title").val(categories.category_title);
      $("#edit-c_content").summernote('code', categories.category_desc);
      $("#edit-iconval").val(categories.selectedicon);
      $("#edit-p_slug").val(categories.page_slug);
      $("#cat_id").val(cat_id);
      if(categories.category_cid != 0) {
        $("#edit-category_div").show();
        $('input[name="child"]').attr("checked","checked");
      } else {
        $("#edit-category_div").hide();
      }
      $("#edit-sel_txt option").each(function() {
        if($(this).val() == categories.category_cid) {
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
  $("#cat_title").val('');
  $("#child").val('');
  $("#iconval").val('');
  $("#p_slug").val('');
  $("#edit-sel_txt option").each(function() {
    $(this).removeAttr("selected");
  });
}

$("#child").click(function () {
  if($(this).is(":checked")){
    $("#category_div").show();
  } else {
    $("#category_div").hide();
  }
});

$("#edit-child").click(function () {
  if($(this).is(":checked")){
    $("#edit-category_div").show();
  } else {
    $("#edit-category_div").hide();
  }
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

  var cat_title = $("#"+ type +"cat_title").val();
  var c_content = $("#"+ type +"c_content").val();
  var iconval = $("#"+ type +"iconval").val();
  var p_slug = $("#"+ type +"p_slug").val();


  if(cat_title == '') {
    errors.push("#"+ type +"cat_title");
  }

  if(c_content == '') {
    errors.push("#"+ type +"c_content");
  }

  if(iconval == '') {
    errors.push("#"+ type +"iconval");
  }

  if(p_slug == '') {
    errors.push("#"+ type +"p_slug");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}