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
  reset_form();
  $(".loading-container").show();
  var company_id = $(this).attr('data-id');
  $("#edit-company_id").val(company_id);
  $("#edit-compayn-form").attr('action', "/companies/"+ company_id);
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  $.get('/company/get-company/' + company_id, function(data){
    var company = data.company;
    $("#edit-name").val(company.name);
    $("#edit-email").val(company.email)
    $("#edit-phone").val(company.phone);
    var stores = [];
    if(company.stores.length > 0) {
      company.stores.forEach(function(store){
        stores.push(store.id);
      })
    }

    if(company.services) {
      company.services.forEach(function(service){
        $("#ser-" + service.id).prop('checked', true);
      });
    }

    if(company.capabilities) {
      company.capabilities.forEach(function(capability){
        $("#cap-" + capability.id).prop('checked', true);
      });
    }

    $("#edit-country").val(company.country_id);
    getStatesAndStores(company.state_id, company.city_id, stores, 'edit-');

    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();
    $(".save-changes").removeClass('disable').removeAttr('disabled');

  });
});
function validateEmailExist(type) {
  var email = $("#"+type+"email").val();
  var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(email_rgx.test(email)) {
    var company_id = $("#"+type+"company_id").val();
    $.get('/company/email-exist?id=' + company_id +'&email=' + email, function(data){
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
function getStores(stores, type) {
  var state_id = $("#"+ type +"state").val();
  $("#"+ type +"stores").html('');
  $.get('/store/getStoresByState/'+ state_id, function(data){
    var html = '';
    if(data.length > 0) {
      data.forEach(function(store){
        html += '<option value="'+ store.id +'">'+ store.location +'</option>';
      })
    }
    $("#"+ type +"stores").html(html);
    $("#"+ type +"stores").val(stores);
  });
}
function getStatesAndStores(state_id, city_id, stores, type) {
  var callback_functions = {};
  callback_functions['getStores'] = {};
  callback_functions.getStores = {
    cb: getStores,
    params: stores
  };
  if(!state_id){
    state_id = $("#"+ type +"state").val();
  }
  callback_functions['getCities'] = getCities;
  getStates(state_id, city_id, callback_functions, type);
}
function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#edit-email_exist").val('');
  $("#email_exist").val('');
  $("#email-exist").html('');
  $("#edit-email-exist").html('');
  $("#name").val('');
  $("#edit-name").val('');
  $("#email").val('');
  $("#edit-email").val('');
  $("#phone").val('');
  $("#edit-phone").val('');
  $("#edit-company_id").val('');
  $("#company_id").val('');

  $("input[name='services[]']").prop('checked', false);
  $("input[name='edit_services[]']").prop('checked', false);
  $("input[name='capabilities[]']").prop('checked', false);
  $("select[name='stores[]']").html('');
  $("select[name='country']").val('');
  $("select[name='state']").html('<option value="">Select Province</option>');
  $("select[name='state']").val('');
  $("select[name='city']").html('<option value="">Select City</option>');
  $("select[name='city']").val('');
  $("select[name='stores[]']").val('');
  $("input[name='edit_capabilities[]']").prop('checked', false);
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var email_exist = $("#"+type+"email_exist").val();
  var name = $("#"+ type +"name").val();
  var phone = $("#"+ type +"phone").val();
  var email = $("#"+ type +"email").val();
  var stores = $("#"+ type +"stores").val();
  if(type == ''){
    var services = $('input[name="services[]"]:checked');
    var capabilities = $('input[name="capabilities[]"]:checked');
  } else {
    var services = $('input[name="edit_services[]"]:checked');
    var capabilities = $('input[name="edit_capabilities[]"]:checked');
  }
  var phone_regex = /^\d{3}(-)\d{3}(-)\d{4}$/;
  var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var errors = [];
  if(name == '') {
    errors.push("#"+ type +"name");
  }

  if(!phone_regex.test(phone)) {
    errors.push("#"+ type +"phone");
  }

  if(services.length == 0) {
    // errors.push('Please select at least one service.');
  }

  if(capabilities.length == 0) {
    // errors.push('Please select at least one capability.');
  }

  if(email_exist) {
    errors.push("#"+ type +"email");
  }

  if(!email_rgx.test(email)) {
    errors.push("#"+ type +"email");
  }

  if(!stores) {
    errors.push("#"+ type +"stores");
  }

  if(errors.length>0){
    var error_text = '';
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');
    }
    return false;
  }
  return true;
}
