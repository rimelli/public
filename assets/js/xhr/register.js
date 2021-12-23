// Class Definition
var Register = (function() {

    var handleRegisterFormSubmit = function() {
      $("#register_button").click(function(e) {
        e.preventDefault();
        var btn = $(this);
        var form = $("#register-account-form");
        var alert = $("#responseregister");
  
        form.validate({
          rules: {
            reg_fname:{
              minlength: 2,
              required:true
            },
            reg_lname:{
              minlength: 2,
              required:true
            },
            reg_email: {
              required: true,
              email:true
            },
            reg_password: {
              minlength: 5,
              required: true,
            },
            reg_password2:{
              minlength: 5,
              required: true,
              equalTo:'#password-register'
            }
          },
          messages: {
            reg_fname:{
              required:"Please enter your first name.",
              minlength: "First Name must be 2 characters long.",
            },
            reg_lname:{
              required:"Please enter your last name.",
              minlength: "Last Name must be 2 characters long.",
            },
            reg_email: {
              required: "Please enter your email address."
            },
            reg_password: {
              required: "Password is required.",
              minlength: "Password must be 5 characters long.",

            },
            reg_password2: {
              required: "Password is required.",
              minlength: "Password must be 5 characters long.",
              equalTo:"Please enter same password again."

            }
          }
        });
  
        if (!form.valid()) {
          return;
        }
        btn
          .addClass(
            "btn-disabled"
          )
          .attr("disabled", true);
        $("#spin").addClass("fa-circle-o-notch fa-spin");
        form.ajaxSubmit({
          url: "xhr/register.php",
          type: 'post',
          success: function(response, status, xhr, $form) {
            // console.log(response);
            var data=JSON.parse(response);
            if (data.status == 200) {
              alert.addClass("alert-success");
              alert.append("Registering...");
              setTimeout(function(){
                alert.append(data.message);
              }, 500);
              btn
                .removeClass(
                  "btn-disabled"
                )
                .attr("disabled", false);
              $("#spin").removeClass("fa-circle-o-notch fa-spin");
              console.log(response);
              //setTimeout(function(){   window.location.href = "/index.php"; }, 3000);
            } else {
  
              // simulate 2s delay
              setTimeout(function() {
                alert.addClass("alert-error");
                alert.append(data.message);
                btn
                  .removeClass(
                    "btn-disabled"
                  )
                  .attr("disabled", false);
                $("#spin").removeClass("fa-circle-o-notch fa-spin");
                console.log(response);
              }, 1000);
            }
          },
          error: function(response) {
            console.log(response);
          }
        });
      });
    };
  
    // Public Functions
    return {
      // public functions
      init: function() {
        handleRegisterFormSubmit();
      }
    };
  })();
  
  // Class Initialization
  jQuery(document).ready(function() {
    Register.init();
  });