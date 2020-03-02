$(".edit-icon").click(function () {
  showFormOverlay();
  var store_id = $(this).attr('data-id');
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  $.get('/store/' + store_id, function(data){
    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();

    var store;

    if(typeof data.store != 'undefined'){
      store = data.store;
      $("#store_id").val(store_id);
      $("#store_name").val(store.name);
      $("#store_number").val(store.store_number_id);
      $("#market").val(store.market_id);
      // $("#state").val(store.state_id);
      $("#edit-country").val(store.country_id);
      $("#phone").val(store.phone);
      $("#postal_code").val(store.postal_code);

      var material_service_store = [];

      if(store.material_service_store) {
        store.material_service_store.forEach(function(cont){
          $("#edit-" + cont.service_id + "-" + cont.material_id).prop('checked', true);
          // contractor_service_store.push({store_id: cont.store_id, service_id: cont.service_id});
        })
      }

      var callback_functions = {};
      callback_functions['getCities'] = getCities;

      getStates(store.state_id, store.city_id, callback_functions, 'edit-');
      $(".save-changes").removeClass('disable').removeAttr('disabled');
    }
  });
});

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#store_name").val('');
  $("#store_number").val('0');
  $("#market").val('0');
  $("#edit-state").html('<option value="">Select Province</option>');
  $("#edit-city").html('<option value="">Select City</option>');
  $("#edit-city").val('');
  $("#edit-state").val('');
  $("#edit-country").val('');
  $("#phone").val('');
  $("#postal_code").val('');
  $(".box > input[type='checkbox']").prop('checked', false);
}

function validate() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var name = $("#store_name").val();
  var number = $("#store_number").val();
  var market = $("#market").val();
  var city = $("#edit-city").val();
  var state = $("#edit-state").val();
  var country = $("#edit-country").val();
  var phone = $("#phone").val();
  var postal_code = $("#postal_code").val();
  var phone_regex = /^\d{3}(-)\d{3}(-)\d{4}$/
  var errors = [];
  if(name == '') {
    errors.push('#store_name');
  }
  if(number == '0') {
    errors.push('#store_number');
  }
  if(market == '0') {
    errors.push('#market');
  }
  if(city == '') {
    errors.push('#edit-city');
  }
  if(state == '') {
    errors.push('#edit-state');
  }
  if(country == '') {
    errors.push('#edit-country');
  }
  if(!phone_regex.test(phone)) {
    errors.push('#phone');
  }
  if(postal_code == '') {
    errors.push('#postal_code');
  }

  if(errors.length>0){
    var error_text = '';
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    // $("#form-errors").html(error_text);
    return false;
  }

  return true;
}

$(".select-all-materials").on('click', function(){
  var txt = $(this).text();
  if(txt == 'Select All') {
    $(this).text('Unselect All');
    $(".material-checkbox").prop('checked', true);
  } else {
    $(this).text('Select All');
    $(".material-checkbox").prop('checked', false);
  }
});

$('.material-checkbox').on('click', function(){
  var tot_checked = $(".material-checkbox:checked").length;
  var total_boxes = $(".material-checkbox").length;
  if (tot_checked == total_boxes) {
    $(".select-all-materials").text('Unselect All');
  } else {
    $(".select-all-materials").text('Select All');
  }
})
/*$(".add-button").click(function () {
  $(".add-new-data").animate({
    width: "406px"
  }, {
    duration: 500,

  });
});*/
