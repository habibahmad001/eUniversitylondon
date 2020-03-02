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

  $.get('/getCategory/' + cat_id, function(data){

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.category != 'undefined'){
      category = data.category;
      $("#cat_id").val(cat_id);
      $("#edit-category").val(category.category);
      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});


 

function validateCategoryExist(type) {

  var category = $("#"+type+"category").val();

    var category_id = $("#category_id").val();
    $.get('/category-exist?id=' + category_id +'&category=' + category, function(data){
      
      if(data.exist) {
        $("#"+type+"category_already_exist").val('1');
        $("#"+type+"category-exist").css('color','#ff0000');
        $("#"+type+"category-exist").html('E-mail already exists.');
         $('#category_form').find(':input[type=submit]').prop('disabled', true);
      } else {
        $("#"+type+"category-exist").html('');
        $("#"+type+"category_already_exist").val('');
      }
    })

  
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
  var category_exist = $("#"+type+"category_already_exist").val();
  var category = $("#"+ type +"category").val();

  if(category == '') {
    errors.push("#"+ type +"category");
  }
 
  if(category_exist) {
    errors.push("#"+ type +"category");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');;
    }
    return false;
  }
  return true;
}