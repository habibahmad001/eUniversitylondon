
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
  var cat_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getquestionandanswer/' + cat_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.QandA != 'undefined'){
      QandA = data.QandA;

      $("#edit-qa_title").val(QandA.qa_title);
      $("#edit-qa_content").summernote('insertText', QandA.qa_desc);
      $("#cat_id").val(cat_id);
      if(QandA.qa_cid != 0) {
        $("#edit-category_div").show();
      } else {
        $("#edit-category_div").hide();
      }

      if(QandA.exam_qa_id != "") {
        $("#edit-exm_item").show();
      }

      $("#edit-sel_txt option").each(function() {
        if($(this).val() == QandA.qa_cid) {
          $(this).attr("selected","selected");
        }
      });

      $("#sel_ex_id option").each(function() {
        if($(this).val() == QandA.exam_qa_id) {
          $(this).attr("selected","selected");
        }
      });

      $("#edit-sel_table option").each(function() {
        if($(this).val() == QandA.table_name) {
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
  $("#qa_title").val('');
  $("#child").val('');
  $("#edit-sel_txt option").each(function() {
    $(this).removeAttr("selected");
  });
}

$("#sel_table").change(function(){

  var user_folder = $("#user_folder").val();
  var tab_name = $("#sel_table").val();
  $.get('/' + user_folder + '/getqaexam/' + tab_name, function(data){

    if(typeof data.ResponseData != 'undefined'){
      // alert(data.ResponseData);
      $("#exm_item").html(data.ResponseData).show();
    }
  });
});

$("#edit-sel_table").change(function(){

  var user_folder = $("#user_folder").val();
  var tab_name = $("#edit-sel_table").val();
  $.get('/' + user_folder + '/getqaexam/' + tab_name, function(data){

    if(typeof data.ResponseData != 'undefined'){
      // alert(data.ResponseData);
      $("#edit-exm_item").html(data.ResponseData).show();
    }
  });
});


$("#child").click(function () {
  if($(this).is(":checked")){
    $("#category_div").show();
    $(".exm_table").hide();
  } else {
    $("#category_div").hide();
    $(".exm_table").show();
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

  var qa_title = $("#"+ type +"qa_title").val();
  var qa_content = $("#"+ type +"qa_content").val();


  if(qa_title == '') {
    errors.push("#"+ type +"qa_title");
  }

  if(qa_content == '') {
    errors.push("#"+ type +"qa_content");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}