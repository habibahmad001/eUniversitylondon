
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
  var cid = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getcomment/' + cid, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Comment != 'undefined'){
      Comment = data.Comment;

      $("#edit-cuser").val(Comment.name);
      $("#edit-cemail").val(Comment.email);
      $("#edit-ccomments").summernote('code', Comment.message);
      $("#edit-cour_id option").each(function() {
        if($(this).val() == Comment.course_id) {
          $(this).attr("selected","selected");
        }
      });
      $("#cid").val(cid);

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#cuser").val('');
  $("#cemail").val('');
  $("#ccomments").val('');
  $("#cour_id").val('');
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var cuser = $("#"+ type +"cuser").val();
  var cemail = $("#"+ type +"cemail").val();
  var ccomments = $("#"+ type +"ccomments").val();
  var cour_id = $("#"+ type +"cour_id").val();


  if(cuser == '') {
    errors.push("#"+ type +"cuser");
  }

  if(cemail == '') {
    errors.push("#"+ type +"cemail");
  }

  if(cour_id == '') {
    errors.push("#"+ type +"cour_id");
  }

  if(ccomments == '') {
    errors.push("#"+ type +"ccomments");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }

  return true;
}

// $( function() {
//   $( "#edit-startsFrom, #edit-endsTo, #startsFrom, #endsTo" ).datepicker({
//     showOn: "button",
//     buttonImage: "../images/calendar.gif",
//     buttonImageOnly: true,
//     buttonText: "Select date",
//     dateFormat: "yy-mm-dd"
//   });
// });