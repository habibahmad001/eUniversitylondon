 $(function () {
        $("#start_Date").datepicker({ dateFormat: 'dd-M-yy' });

        $("#end_Date").datepicker({ dateFormat: 'dd-M-yy' });
    });



function validate() {
  $(".error").each(function(){
    $(this).removeClass('error');
  });
  var errors = [];
  //var start_date    = $("#start_Date").val();
 // var end_Date      = $("#end_Date").val();
  //var sessiondate   = $("#sessiondate").val();

 //  if(start_date == '') {
 //    errors.push("#start_Date");
 //  }
 // console.log(sessiondate);
 //  if(end_Date == '') {
 //    errors.push("#end_Date");
 //  }

  if(sessiondate == '') {
    errors.push("#sessiondate");
  }

  

  if(errors.length>0){
    for(i=0; i < errors.length; i++){
      $(errors[i]).addClass('error');;
    }
    return false;
  }
  return true;
}