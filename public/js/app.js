$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $(".toggle-btn").click(function(ev) {
        ev.preventDefault();
        $("div.right-bar").toggleClass("active");
        $(".menu-overlay").fadeIn("slow");
    });
    $("div.right-bar .toggle-btn").click(function(ev) {
        ev.preventDefault();
        $(".menu-overlay").fadeOut("slow");
    });

    $("header .right-bar .right-bar-links ul li a").click(function(ev) {
        $("div.right-bar").toggleClass("active");
        $(".menu-overlay").fadeOut("slow");
    });
    
    $(".menu-overlay").click(function(ev) {
        $("div.right-bar").toggleClass("active");
        $(".menu-overlay").fadeOut("slow");
    });

setInterval(function time(){
  var d = new Date();
  var hours = 24 - d.getHours();
  var min = 60 - d.getMinutes();
  if((min + '').length == 1){
    min = '0' + min;
  }
  var sec = 60 - d.getSeconds();
  if((sec + '').length == 1){
        sec = '0' + sec;
  }
  jQuery('.hours_remaining').html(hours);
  jQuery('.minutes_remaining').html(" h " + min);
  jQuery('.seconds_remaining').html(" m " +sec+ " s");
}, 1000);


});
