
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
  var a_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getassignment/' + a_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var public_folder = $("#public").val();

    var store;

    if(typeof data.Assignment != 'undefined'){
      assignment = data.Assignment;

      var img_path = $("#img_path").val() + "/";

      $("#edit-ass_title").val(assignment.assignment_title);
      $("#edit-contents").summernote('code', assignment.contents);
      if(assignment.assignment_file !== null) {
        $("#avatar_div").html('<a href="' + img_path + assignment.assignment_file + '" target="_blank"><img src="' + public_folder + 'images/excel-icon.png" width="150" height="150"></a>');
      }

      $("#edit-cour_id option").each(function() {
        if($(this).val() == assignment.course_id) {
          $(this).attr("selected","selected");
        }
      });
      // $("#a_id").val(a_id);
      // $("#edit-tab_name option").each(function() {
      //   if($(this).val() == assignment.table_name) {
      //     $(this).attr("selected","selected");
      //   }
      // });
      //
      // Exm_data = data.Exm_data;
      //
      // var res_var = "<select name=\"exam_id\" id=\"exam_id\" class=\"full-width\">\n";
      // for(i=0; i<=Exm_data.length; i++){
      //   if(typeof Exm_data[i] != 'undefined'){
      //     var sel = "selected='selected'";
      //     if(Exm_data[i].id == assignment.exam_id) {
      //       res_var += "<option value='"+Exm_data[i].id+"' "+ sel +">" + Exm_data[i].exam_title + "</option>\n";
      //     } else {
      //       res_var += "<option value='"+Exm_data[i].id+"'>" + Exm_data[i].exam_title + "</option>\n";
      //     }
      //   }
      // }
      // res_var += "</select>\n";
      //
      // $(".exam_div").html(res_var).show();

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

// $("select[name='tab_name']").change(function(){
//
//   var user_folder = $("#user_folder").val();
//   var tab_name = $(this).val();
//   $.get('/' + user_folder + '/getassignmentexam/' + tab_name, function(data){
//
//     if(typeof data.ResponseData != 'undefined'){
//       // alert(data.ResponseData);
//       $(".exam_div").html(data.ResponseData).show();
//     }
//   });
// });


function reset_form() {

  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#ass_title").val('');
  // $("select[name='tab_name']").removeAttr('selected');
  // $("select[name='exam_id']").html('<select name="exam_id" id="edit-exam_id" class="full-width">\n' +
  //                         '            <option value="">Select Exam</option>\n' +
  //                         '          </select>');
  $("#cour_id").val('');
  $("#avatar_div").html("");
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var ass_title = $("#"+ type +"ass_title").val();
  var contents = $("#"+ type +"contents").val();


  if(ass_title == '') {
    errors.push("#"+ type +"ass_title");
  }

  if(contents == '') {
    errors.push("#"+ type +"contents");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}