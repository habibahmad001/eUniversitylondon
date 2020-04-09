
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
  var a_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getassignment/' + a_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.assignment != 'undefined'){
      assignment = data.assignment;

      var img_path = $("#img_path").val() + "/";

      $("#edit-ass_title").val(assignment.assignment_title);
      if(assignment.assignment_file !== null) {
        $("#avatar_div img").attr("src", img_path + assignment.assignment_file);
      }
      $("#a_id").val(a_id);
      $("#edit-tab_name option").each(function() {
        if($(this).val() == assignment.table_name) {
          $(this).attr("selected","selected");
        }
      });

      Exm_data = data.Exm_data;

      var res_var = "<select name=\"exam_id\" id=\"exam_id\" class=\"full-width\">\n";
      for(i=0; i<=Exm_data.length; i++){
        if(typeof Exm_data[i] != 'undefined'){
          var sel = "selected='selected'";
          if(Exm_data[i].id == assignment.exam_id) {
            res_var += "<option value='"+Exm_data[i].id+"' "+ sel +">" + Exm_data[i].exam_title + "</option>\n";
          } else {
            res_var += "<option value='"+Exm_data[i].id+"'>" + Exm_data[i].exam_title + "</option>\n";
          }
        }
      }
      res_var += "</select>\n";

      $(".exam_div").html(res_var).show();

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

$("select[name='tab_name']").change(function(){

  var user_folder = $("#user_folder").val();
  var tab_name = $("select[name='tab_name']").val();
  $.get('/' + user_folder + '/getassignmentexam/' + tab_name, function(data){

    if(typeof data.ResponseData != 'undefined'){
      // alert(data.ResponseData);
      $(".exam_div").html(data.ResponseData).show();
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#ass_title").val('');
  $("select[name='tab_name']").removeAttr('selected');
  $("select[name='exam_id']").removeAttr('selected');
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

  var ass_title = $("#"+ type +"ass_title").val();
  var tab_name = $("#"+ type +"tab_name").val();


  if(ass_title == '') {
    errors.push("#"+ type +"ass_title");
  }

  if(tab_name == '') {
    errors.push("#"+ type +"tab_name");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}