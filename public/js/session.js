 $(function () {
        $("#startDate").datepicker({ dateFormat: 'dd-M-yy' });

        $("#endDate").datepicker({ dateFormat: 'dd-M-yy' });
    });


 function validatedateExist() {
  var startdate = $("#startDate").val();
  
    $.get('/date-exist?startdate=' + startdate, function(data){
      if(data.exist) {

        $("#date_exist").val('1');
        $("#date-exist").css('color','#ff0000');
        $("#date-exist").html('This session is already taken');
        
      } else {
        $("#date-exist").html('');
        $("#date_exist").val('');
      }
    })

  
}



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

function reset_form() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  $("#startDate").val('');
  $("#endDate").val('');
  $("#date_exist").val('');
}

function checkenddate(){

var startDate  = new Date($('#startDate').val());
var endDate    = new Date($('#endDate').val());

if (startDate < endDate){
        $("#date-greater").html('');
        $("#date_greater").val('');
}else{
        $("#date_greater").val('1');
        $("#date-greater").css('color','#ff0000');
        $("#date-greater").html('End date should be greater than Start date');
}

}



function validate() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];
  var date_exist    = $("#date_exist").val();
  var date_greater  = $("#date_greater").val();
  var startDate = $("#startDate").val();
  var endDate = $("#endDate").val();

  if(startDate == '') {
    errors.push("#startDate");
  }

 if(endDate == '') {
    errors.push("#endDate");
  }
  if(date_exist) {
    errors.push("#startDate");
  }
  if(date_greater) {
    errors.push("#endDate");
  }

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');;
    }
    return false;
  }

  return true;
}