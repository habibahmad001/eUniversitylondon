function getStates(state_id, city_id, callback_functions, type) {
  var country_id = $("#"+ type +"country").val();
  if(country_id) {
    $.get('/store/get-states?country_id='+country_id, function(data) {
      if(country_id == 1){
        html = '<option value="" selected="selected">Select State</option>';
      } else {
        html = '<option value="" selected="selected">Select Province</option>';
      }
      data.forEach(function(state) {
        html += '<option value="'+state.id+'">'+state.name+'</option>'
      });
      $("#"+ type +"state").html(html);
      $("#"+ type +"city").html('<option value="" selected="selected">Select City</option>');

      $("#"+ type +"state").val(state_id);

      if(typeof callback_functions.getCompanies != 'undefined') {
        callback_functions.getCompanies.cb(callback_functions.getCompanies.params, type);
      }

      if(typeof callback_functions.getStores != 'undefined') {
        callback_functions.getStores.cb(callback_functions.getStores.params, type);
      }

      if(typeof callback_functions.getCities != 'undefined') {
        callback_functions.getCities(city_id, type)
      }

    });
  }
}

function getCities(city_id, type) {
  var country_id = $("#"+ type +"country").val();
  var state_id = $("#"+ type +"state").val();
  if(country_id && state_id) {
    $.get('/store/get-cities?country_id='+country_id+'&state_id='+state_id, function(data) {
      var html = '<option value="" selected="selected">Select City</option>';
      data.forEach(function(city) {
        html += '<option value="'+city.id+'">'+city.name+'</option>'
      });
      $("#"+ type +"city").html(html);
      if(city_id)
        $("#"+ type +"city").val(city_id);
    });
  }
}

function showFormOverlay() {
    $(".overlay-for-form").fadeIn();
}

function hideFormOverlay() {
    $(".overlay-for-form").fadeOut();
}

$(".delete-btn").click(function(){
  var model = $("#current_model").val();
  console.log(model);
  var c = confirm('Are you sure you want to delete selected '+ model +'?');
  if(c) {
    var ids_to_del = [];
    $("input[name='del_"+model+"[]']:checked").each(function(){
      ids_to_del.push($(this).val());
    });
    if(ids_to_del.length > 0) {
      $("#ids_to_del").val(ids_to_del.join(','));
      $("#delete-form").attr('action', model +'/'+ ids_to_del.join(','))
      $("#delete-form").submit();
    }
  }
});
