
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

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getquestionandanswer/' + cat_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.QandA != 'undefined'){
      QandA = data.QandA;

      /********** Set exam **********/
      var user_folder = $("#user_folder").val();
      $.get('/' + user_folder + '/getqaexam/' + QandA.table_name, function(data){

        if(typeof data.ResponseData != 'undefined'){
          // $(data.ResponseData).find("option[value='"+QandA.exam_qa_id+"']")
          var resdata = data.ResponseData;
          resdata = resdata.replace('value="'+QandA.exam_qa_id+'"', 'value="'+QandA.exam_qa_id+'"' + ' selected="selected"');
          $(".exm_item").html(resdata).show();
        }
      });
      /********** Set exam **********/

      $("#edit-qa_title").val(QandA.qa_title);
      $("#edit-qa_content").summernote('code', QandA.qa_desc);
      $("#cat_id").val(cat_id);
      if(QandA.qa_cid != 0) {
        $("#edit-category_div").show();
      } else {
        $("#edit-category_div").hide();
      }

      if(QandA.exam_qa_id != "") {
        $("#edit-exm_item").show();
      }

      if(QandA.qa_cid != 0) {
        $('input[name="child"]').attr("checked","checked");
      }

      $("#edit-sel_txt option").each(function() {
        if($(this).val() == QandA.qa_cid) {
          $(this).attr("selected","selected");
        }
      });

      $("#edit-anstype option").each(function() {
        if($(this).val() == QandA.AnsType) {
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
  $("#anstype").val('');
  $("#edit-sel_txt").removeAttr('selected');
  $(".exm_table").removeAttr('selected');
  $(".exm_item").html('<select name="sel_ex_id" id="sel_ex_id" class="half-width">\n' +
              '          <option value="0">Select Exam</option>\n' +
              '        </select>');
}

$("#sel_table").change(function(){

  var user_folder = $("#user_folder").val();
  var tab_name = $("#sel_table").val();
  $.get('/' + user_folder + '/getqaexam/' + tab_name, function(data){

    if(typeof data.ResponseData != 'undefined'){
      // alert(data.ResponseData);
      $(".exm_item").html(data.ResponseData).show();
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

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var qa_title = $("#"+ type +"qa_title").val();
  var qa_content = $("#"+ type +"qa_content").val();


  if($("#"+ type +"qa_title").length) {
    if(qa_title == '')
      errors.push("#"+ type +"qa_title");
  }

  if($("#"+ type +"qa_content").length) {
    if(qa_content == '')
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