var google_formated_address;
var google_city;
var google_state;
var google_country;
var $form , origForm;
$(".edit-icon").click(function () {
  showFormOverlay();
  reset_form();
  $(".loading-container").show();
  var customer_id = $(this).attr('data-id');
  $("#edit-customer-form").attr('action', "/customers/"+ customer_id);
  $(".edit-current-data").animate({
    width: "406px"
  }, {
    duration: 500,
  });

  getCustomerDetail(customer_id);
});

function getCustomerDetail(customer_id) {
  $.get('/customer/get-customer/' + customer_id, function(data){
    hideGoogleSuggesstionBox();
    var customer = data.customer;
    $("#user_id").val(customer_id);
    $("#edit-first_name").val(customer.user.first_name);
    $("#edit-last_name").val(customer.user.last_name);
    $("#edit-phone").val(customer.user.phone);
    $("#edit-address").val(customer.address);
    $("#edit-country").val(customer.user.country_id);
    $("#edit-state").val(customer.user.state_id);
    $("#edit-city").val(customer.user.city_id);
    $("input[name=edit_address_type][value=" + customer.address_type + "]").prop('checked', true);

    var logs = customer.logs;
    var logs_html = '';
    if(logs.length > 0) {
      $("#total_history").html('('+ logs.length +')');
      logs.forEach(function(log, index){
        if(index == 0){
          var cur_add_type = (log.address_type) ? log.address_type : 'None';
          logs_html += '<div class="listing-box"> \
                          <h3>'+ log.first_name +' '+ log.last_name +' <span class="right-current">Current</span></h3> \
                          <div class="selected-location">'+ log.phone +'</div> \
                          <div class="selected-place">'+ cur_add_type +'</div> \
                          <p> \
                            '+ log.address +' \
                          </p> \
                        </div>';
        } else {
        var add_type = (log.address_type) ? log.address_type : 'None';
        logs_html += '<div class="listing-box"> \
              					<h3>'+ log.first_name +' '+ log.last_name +' <span class="right">'+ log.date +'</span></h3> \
                        <div class="selected-location">'+ log.phone +'</div> \
                        <div class="selected-place">'+ add_type +'</div> \
              					<p> \
              						'+ log.address +' \
              					</p> \
              				</div>';
        }
      });
      //$("#customer_history > .listing-box").remove();
      $("#customer_history").html(logs_html);
    }

    // $("#edit-country").val(customer.user.country_id);
    // getCustomerStates(customer.user.state_id, customer.user.city_id, null, 'edit-');
    $form = $('form');
    origForm = $form.serialize();
    $(".loading-container").fadeOut();
    $(".form-content-box").fadeIn();
    // $(".save-changes").removeClass('disable').removeAttr('disabled');

  });
}


function updateLocation() {
    var address = $("#edit-address").val();
    var breakTag = '<br />';
    var gaddress = address.replace(/(\r\n|\n|\r)/gm, ' ').replace(/  +/g, ' ');
    var format_address = (address + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    $("#given_address").html(format_address);
    var url = 'https://maps.googleapis.com/maps/api/geocode/json?address='+ gaddress +'&sensor=false&key=AIzaSyBByQkFVG37t-od2QKnvlVzB4lz3UIwycU';
    $.ajax({
      url: url,
      success: function(response) {
          if(response.results.length > 0) {
            var res = response.results[0];
            var street = '';
            var city_state_postal = '';
            var country = '';
            if(res.address_components.length > 0) {
              res.address_components.forEach(function(r){
                if(r.types[0] == 'street_number' || r.types[0] == 'route') {
                  street += r.long_name + ' ';
                }

                if(r.types[0] == 'locality') {
                  city_state_postal = r.long_name;
                  google_city = r.long_name;
                }

                if(r.types[0] == 'administrative_area_level_1') {
                  city_state_postal += ', ' + r.short_name;
                  google_state = r.short_name;
                }

                if(r.types[0] == 'postal_code') {
                  city_state_postal += ' ' + r.long_name+ ' ';
                }

                if(r.types[0] == 'country') {
                  country = r.long_name;
                  google_country = r.long_name;
                }
              });
            }
            var google_full_address = street +''+ city_state_postal + '' + country;
            if(gaddress != google_full_address){
              google_formated_address = street + '<br />' + city_state_postal + '<br />' + country;
              $("#suggested_address").html(google_formated_address);

              $("#google-suggestion").animate({
                width: "406px"
              }, {
                duration: 500,
              });

              initMap(res.geometry.location, google_formated_address);
            } else {
              updateMyLocation(true);
            }

          } else {
            $("#google-suggestion").animate({
              width: "406px"
            }, {
              duration: 500,
            });
            initMap(null, '');
          }
      }
    });
}

function initMap(location, google_formated_address) {
  if(location) {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: location
    });
    var marker = new google.maps.Marker({
      position: location,
      map: map,
      title: google_formated_address
    });
  }
}

function updateMyLocation(ignore) {
  var selected = $("input[name='validate_address']:checked").val();
  if(!selected && !ignore) {

  }else{
    $("#google-suggestions-form").hide();
    $(".loading-container").show();
    var address_type = $("input[name='edit_address_type']:checked").val();
    selected = selected ? selected : 'address'; // if type and google address same
    var address_to_save;
    var city, state, country;
    if (selected != 'address') {
      var regex = /<br\s*[\/]?>/gi;
      address_to_save = google_formated_address.replace(regex, "\n");
      city = google_city;
      country = google_country;
      state = google_state;
    }else{
      address_to_save = $("#edit-address").val()
      city = $("#edit-city").val();
      country = $("#edit-country").val();
      state = $("#edit-state").val();
    }
    var phone = $("#edit-phone").val();
    var fname = $("#edit-first_name").val();
    var lname = $("#edit-last_name").val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var customer_id = $("#user_id").val();
    $.ajax({
      url: '/customers/' + customer_id,
      type: 'POST',
      data: {
        address: address_to_save,
        address_type: address_type,
        phone: phone,
        first_name: fname,
        last_name: lname,
        city: city,
        state: state,
        country: country,
        type: selected,
        _token: CSRF_TOKEN,
        _method: 'PUT'

      },
      success: function(res) {
        if(res.success) {
          $(".loading-container").hide();
          getCustomerDetail(customer_id);
        }
      }
    })
  }
}

function getCustomerStates(state_id, city_id, stores, type) {
  var callback_functions = {};

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
  $("#edit-first_name").val('');
  $("#edit-last_name").val('');
  $("#edit-phone").val('');

  $("select[name='country']").val('');
  $("select[name='state']").html('<option value="">Select Province</option>');
  $("select[name='state']").val('');
  $("select[name='city']").html('<option value="">Select City</option>');
  $("select[name='city']").val('');
  $("#customer_history > .listing-box").remove();
}

function validate(type) {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var first_name = $("#"+ type +"first_name").val();
  var last_name = $("#"+ type +"last_name").val();
  var phone = $("#"+ type +"phone").val();

  var phone_regex = /^\d{3}(-)\d{3}(-)\d{4}$/;
  var errors = [];
  if(first_name == '') {
    errors.push("#"+ type +"first_name");
  }

  if(last_name == '') {
    errors.push("#"+ type +"last_name");
  }

  if(!phone_regex.test(phone)) {
    errors.push("#"+ type +"phone");
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

function hideGoogleSuggesstionBox() {
  $("input[name='validate_address']").prop('checked', false);
  $(".loading-container").hide();
  $("#google-suggestions-form").show();
  $("#updateMyLocation").addClass('disable').attr('disabled', true);
  $("#google-suggestion").animate({
    width: "0"
  }, {
    duration: 500,

  });
}

$(".cancel-button-google, .close-icon-google").click(function () {

   hideGoogleSuggesstionBox();

 });


 $('form :input').on('change input', function(e) {
  //  $('.change-message').toggle($form.serialize() !== origForm);
  if($(this).attr('name') == 'edit_address_type') return;
  if($form.serialize() !== origForm) {
    $("#updateMyLocation").removeClass('disable').removeAttr('disabled');

  }else{
    $("#updateMyLocation").addClass('disable').attr('disabled', true);
  }
 });
