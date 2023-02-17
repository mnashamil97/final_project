"use strict";

$(document).ready(function () {
  $("#reg_email").on("keyup", function (e) {
    let email = $(this).val();

    if (email != "") {
      $.ajax({
        url: "../controller/customer_controller.php?type=checkEmail",
        method: "GET",
        data: { email: email },
        success: function (res) {
          if (res == 1) {
            $("#email_response").html("This email has been already taken");
            $("#registerBtn").prop("disabled", true);
          } else {
            $("#email_response").html("");
            $("#registerBtn").prop("disabled", false);
          }
        },
        error: function (xhr) {
          console.log(xhr);
        },
      });
    }
  });

  ///////////////////////// PW Visibility Toggle /////////////////////////
  $("#pw_append").on("click", function (e) {
    if ($("#pw").prop("type") == "password") {
      $("#pw").prop("type", "text");
    } else {
      $("#pw").prop("type", "password");
    }

    $("#pw_icon").toggleClass("fa-eye fa-eye-slash");
  });
});
