
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
  var cid = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "650px"
  }, {
    duration: 500,
  });

  var user_folder = $("#user_folder").val();
  $.get('/' + user_folder + '/getcoupan/' + cid, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.Coupan != 'undefined'){
      Coupan = data.Coupan;

      $("#edit-title").val(Coupan.title);
      $("#edit-value").val(Coupan.value);
      $("#edit-startsFrom").val(Coupan.startsFrom);
      $("#edit-endsTo").val(Coupan.endsTo);
      $("#edit-ccomments").summernote('code', Coupan.ccomments);
      $("#c_id").val(cid);

      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#title").val('');
  $("#value").val('');
  $("#startsFrom").val('');
  $("#endsTo").val('');
  $("#ccomments").val('');
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];

  var title = $("#"+ type +"title").val();
  var value = $("#"+ type +"value").val();
  var startsFrom = $("#"+ type +"startsFrom").val();
  var endsTo = $("#"+ type +"endsTo").val();
  var ccomments = $("#"+ type +"ccomments").val();


  if(title == '') {
    errors.push("#"+ type +"title");
  }

  if(value == '') {
    errors.push("#"+ type +"value");
  }

  if(startsFrom == '') {
    errors.push("#"+ type +"startsFrom");
  }

  if(endsTo == '') {
    errors.push("#"+ type +"endsTo");
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

$( function() {
  $( "#edit-startsFrom, #edit-endsTo, #startsFrom, #endsTo" ).datepicker({
    showOn: "button",
    buttonImage: "../images/calendar.gif",
    buttonImageOnly: true,
    buttonText: "Select date",
    dateFormat: "yy-mm-dd"
  });
});