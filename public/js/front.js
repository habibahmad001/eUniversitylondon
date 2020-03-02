$().ready(function() {
    $("#login").click(function(){
        $("#login").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: "Please enter a valid email address",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                }
            },
            submitHandler: function(form){
                $('#submit_login').attr('disabled', 'disabled');
                form.submit();
            }
        });
    });

    jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
    }, "Spaces are not allow");

  $("#signup").click(function(){
        $("#signup").validate({
          rules: {
            first_name: "required",
            last_name: "required",
            email: {
              required: true,
              email: true,
              remote: "checkUserEmail"
            },
            con_email: {
              required: true,
              email:true,
              equalTo: "#email_signup"
            },
            username: {
              required: true,
              minlength: 2,
              noSpace: true,
              remote: "checkUsername"
            },

            password: {
              required: true,
              minlength: 6
            }
          },
          messages: {
            first_name: "Please enter your firstname",
            last_name: "Please enter your lastname",
            email: {
              required: "Please enter a valid email address",
              remote: "This email is already taken!"
            },
            con_email: {
              required: "Please enter a valid email address",
              equalTo: "Please enter the same email as above"
            },
            username: {
              required: "Please enter a username",
              minlength: "Your username must consist of at least 2 characters",
              remote: "This username is already in use!"
            },
            password: {
              required: "Please provide a password",
              minlength: "Your password must be at least 6 characters long"
            }
          },
        submitHandler: function(form){
            $('#submit_signup').attr('disabled', 'disabled');
            form.submit();
        }
        });
  });

    $("#reset_password").validate({
      rules: {
        email: {
          required: true,
          email: true
        }
      },
      messages: {
        
        email: "Please enter a valid email address"
      }
    });

    $('#frm').validate({
    rules: {
        ans: "required"
    },
    messages: {
      ans: "Give your answer first",

    },
    submitHandler: function(form){
        form.save.disabled = true;
        form.submit();
    }
    });



    $("#reset_blade").validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        },
        password_confirmation: {
          required: true,
          minlength: 6,
          equalTo: "#password"
        }

      },
      messages: {
        
        email: "Please enter a valid email address",
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long"
        },
        password_confirmation: {
          required: "Please provide a password",
          minlength: "Your password must be at least 6 characters long",
          equalTo: "Please enter the same password as above"
        }

      }
    });

  if(jQuery("input").length > 0)
  {
    jQuery("input").attr("autocomplete", "off");  
  }
  $('#signup').submit(function(){
    $("input[type='submit']", this)
      .val("Please Wait...")
      .attr('disabled', 'disabled');
    return true;
  });

$("#reset_password").click(function(e){
       

        var _token = $("input[name='_token']").val();
        var old_password = $("input[name='old_password']").val();
        var new_password = $("input[name='new_password']").val();
        var confirm_password = $("input[name='confirm_password']").val();

          $.ajax({
              url: "/reset_password",
              type:'POST',
              data: {_token:_token, old_password:old_password, new_password:new_password, confirm_password:confirm_password},
              success: function(data) {
                  var count = Object.keys(data.error).length;
                  if(data.error=='null'){
                    $(".alert-success").css('display','block');
                  }else{
                    if(count==1){
                      $(".alert-success").css('display','none');
                    printErrorMsg(data.error);
                  }else{
                     $(".alert-success").css('display','none');
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("ul").append('<li>'+data.error+'</li>');
                  }
                  }
              }
          });

      });

    $("#where-select").change(function(e){


        var _token = $("input[name='_token']").val();
        var what = $("input[name='what']").val();
        var where = $(this).val();

        $.ajax({
            url: "/search",
            type:'POST',
            data: {_token:_token, what:what, where:where},
            success: function(data) {
                $("#search-result").html(data);
            }
        });

    });

      function printErrorMsg (msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( msg, function( key, value ) {
       
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });
    }

   $('#profile_leaderboard').dataTable({
    searching: false, 
    bLengthChange: false, 
    bPaginate:false,
    bInfo:false,
    order: []
  });

   $('#current_session').dataTable({
    searching: false, 
    bLengthChange: false, 
    bPaginate:false,
    bInfo:false,
    order: []
  });
   $('#overall_session').dataTable({
    searching: false, 
    bLengthChange: false, 
    bPaginate:false,
    bInfo:false,
    order: []
  });


   
  });