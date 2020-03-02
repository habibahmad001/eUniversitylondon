// show add form
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

  $.get('/getlevel/' + cat_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.levels != 'undefined'){
      level_record = data.levels;
      $("#level_id").val(cat_id);
      $("#edit-level").val(level_record.level);
      $("#edit-level_name").val(level_record.name);
      $(".save-changes").removeClass('disable').removeAttr('disabled');
  }
});
});


 

function validateLevelExist(type) {

  var level = $("#"+type+"level").val();

    var level_id = $("#level_id").val();
    $.get('/level-exist?id=' + level_id +'&level=' + level, function(data){
      
      if(data.exist) {
        $("#"+type+"level_already_exist").val('1');
        $("#"+type+"level-exist").css('color','#ff0000');
        $("#"+type+"level-exist").html('E-mail already exists.');
      } else {
        $("#"+type+"level-exist").html('');
        $("#"+type+"level_already_exist").val('');
      }
    });

  
}


function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#category").val('');
  
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];
  var level_exist = $("#"+type+"level_already_exist").val();
  var level_name = $("#"+ type +"level").val();

  var level = $("#"+ type +"level").val();
  if(level == '') {
    errors.push("#"+ type +"level");
  }

  if(level_name == '') {
    errors.push("#"+ type +"level");
  }
 
  if(level_exist) {
    errors.push("#"+ type +"level");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }
  return true;
}