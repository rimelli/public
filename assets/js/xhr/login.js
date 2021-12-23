// Class Definition
var Login = (function() {

    var handleSignInFormSubmit = function() {
      $("#login_button").click(function(e) {
        e.preventDefault();
        var btn = $(this);
        var form = $("#login-form");
        var alert = $("#responselogin");
  
        form.validate({
          rules: {
            log_email: {
              required: true,
              email:true
            },
            log_password: {
              required: true,
            }
          },
          messages: {
            log_email: {
              required: "Please enter your email address."
            },
            log_password: {
              required: "Password is required.",
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
          url: "xhr/login.php",
          type: 'post',
          success: function(response, status, xhr, $form) {
            var data=JSON.parse(response);
            if (data.status == 200) {
              alert.addClass("alert-success");
              alert.append("Login Successful... Redirecting...");
              btn
                .removeClass(
                  "btn-disabled"
                )
                .attr("disabled", false);
              $("#spin").removeClass("fa-circle-o-notch fa-spin");
              console.log(response);
              setTimeout(function(){   window.location.href = "index.php"; }, 500);
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
        handleSignInFormSubmit();
      }
    };
  })();
  
  // Class Initialization
  jQuery(document).ready(function() {
    Login.init();
  });