// Custom scroll
(function($){
    $(window).on("load",function(){
        $(".left-menu").mCustomScrollbar({
        	alwaysShowScrollbar: 1,
        	autoHideScrollbar:false,
        	theme:"minimal",
          scrollInertia: 200,
          mouseWheelPixels: 90
        });
    		$(".form-height-control").mCustomScrollbar({
        			autoHideScrollbar:false,
        			alwaysShowScrollbar: 1,
            	theme:"minimal",
              scrollInertia: 200,
              mouseWheelPixels: 90
        });
        $(".center-content-area").mCustomScrollbar({
      			autoHideScrollbar:false,
      			alwaysShowScrollbar: 1,
            theme:"minimal",
            scrollInertia: 200,
            mouseWheelPixels: 90
          });
        $(".customer-listing-cont").mCustomScrollbar({
            autoHideScrollbar:false,
            alwaysShowScrollbar: 1,
            theme:"minimal",
            scrollInertia: 200,
            mouseWheelPixels: 90
          });

   	});

    $('.dropdown-menu').on("click", !"a", function(event){
      event.stopImmediatePropagation();
      event.preventDefault();

    });
    $('.dropdown-menu a').click(function(event) {
      document.location.href = $(this).attr("href");
    });

    $("header > .success-message-box > .cancel").on('click', function(){
      $(".success-message-box").fadeOut();
    });
    setTimeout(function() {
        $(".success-message-box").fadeOut(1000)
    }, 3000);
})(jQuery);



//Table header fixed
(function($) {
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="container-tab" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {

            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).resize(resizeFixed);
         $(window).load(resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };


   //Sticky table
   function stickyfooter() {

     var tabelHeight = $(".center-content-area .table-responsive").height() + $("pagination-container").height() ;
     var centerHeight =$(".center-content-area").height();
     if (tabelHeight >= centerHeight) {
       $(".pagination-container").addClass('fixed-table-footer');
       $(".table-set").css({ bottom: '50px' });
     } else {
       $(".pagination-container").removeClass('fixed-table-footer');
       $(".table-set").css({ bottom: '0px' });
     }
   }
   $(window).load(stickyfooter);
   $(window).resize(stickyfooter);


})(jQuery);

$(document).ready(function(){
  $(".cancel-button, .close-icon").click(function () {
     $(".add-new-data").animate({
       width: "0"
     }, {
       duration: 500,

     });
     hideFormOverlay();
      if(typeof reset_form != 'undefined') reset_form();
   });
   $(".cancel-button, .close-icon").click(function () {
     $(".edit-current-data").animate({
       width: "0"
     }, {
       duration: 500,

     });
     hideFormOverlay();
      if(typeof reset_form != 'undefined') reset_form();
   });

   $(".table").fixMe();
   $('.content .table .checkbox-container :checkbox').change(function(event) {
     if($('.content .table .checkbox-container :checkbox').is(":checked")) {
       $('.delete-btn').addClass("show-btn");
     } else {
       $('.delete-btn').removeClass("show-btn");
     }
   });

   $('input[name="all"]').change(function(){
     var status = $(this).is(':checked');
     if (status==true) {
       $('input.checkbox-selector:checkbox').prop('checked',true);
       $('tbody tr').addClass('yellow');
       $('.edit-icon').removeClass('show');
     } else {
       $('input.checkbox-selector:checkbox').prop('checked', false);
       $('.delete-btn').removeClass("show-btn");
       $('tbody tr').removeClass('yellow');
     }
     var checkedNumber = $("table tbody input.checkbox-selector:checkbox:checked").length;
     if ( checkedNumber == 1 ) {
      $('.edit-icon').addClass('show');
     }
     else{
      $('.edit-icon').removeClass('show');
     }


   });

   $('.checkbox-selector').on('change', function() {
     $(this).closest('tbody tr').toggleClass('yellow');
     if($(this).is(':checked')) {
       $(this).closest('tbody tr').find('.edit-icon').addClass('show');
     } else {
       $('input[name="all"]').prop('checked', false);
     }
     if ($("input.checkbox-selector:checkbox:checked").length > 1) {
       $('.edit-icon').removeClass('show');
     }
     var checkedNumber = $("table tbody input.checkbox-selector:checkbox:checked").length;
     var checkNumber = $("table tbody input.checkbox-selector:checkbox").length;
     if ( checkedNumber == checkNumber ) {
       $('input[name="all"]').prop('checked', true);
     }
     if ( checkedNumber == checkNumber - 1 ) {
       $('input[name="all"]').prop('checked', false);
     }
     if ( checkedNumber == 0 ) {
       $('.delete-btn').removeClass("show-btn");
       $('.edit-icon').removeClass('show');
     }
     if ( checkedNumber == 1 ) {
        $("table tbody input.checkbox-selector:checkbox:checked").closest('tbody tr').find('.edit-icon').addClass('show');
     }
   });
   if($('.content .center-content-area .container-tab').length>0){
   var topDistance = $('.content .center-content-area .container-tab').offset().top ;
   $('table.table.fixed').css({ top : topDistance });
   $('.content .list-nav').css({ top : $('.content .center-content-area .container-tab').offset().top });
   $('table.table').css({ 'margin-top' : $('.content .list-nav').height() });
   if($('.customer-listing-outer').length != 0){
     var topheightval = $(window).height() - $('.customer-listing-outer').offset().top - 65;
     $('.customer-listing-outer').css('height',topheightval);
   }
   }
});
 $(window).resize( function(){
   if($('.customer-listing-outer').length > 0){
     var topheightval = $(window).height() - $('.customer-listing-outer').offset().top - 65;
     $('.customer-listing-outer').css('height',topheightval);
   }
 });

//Auto compelet search
$( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( ".header-search" ).autocomplete({
      source: availableTags
    });
  } );
