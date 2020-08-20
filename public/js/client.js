
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
  var c_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getclient/' + c_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var public_folder = $("#public").val();

    var store;

    if(typeof data.Clients != 'undefined'){
      Clients = data.Clients;

      var img_path = $("#img_path").val() + "/";

      $("#edit-c_name").val(Clients.client_name);
      $("#c_id").val(c_id);

      if(Clients.client_logo !== null) {
        $("#avatar_div img").attr("src", img_path + Clients.client_logo);
      }

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {

  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#c_name").val('');
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

  var c_name = $("#"+ type +"c_name").val();


  if(c_name == '') {
    errors.push("#"+ type +"c_name");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}