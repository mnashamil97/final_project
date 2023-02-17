"use strict";

$(document).ready(function () {
  $("#changePw").on("submit", function (e) {
    let pw = $("#npw").val();
    let cpw = $("#cpw").val();

    if (pw != cpw) {
      Swal.fire("Password Confirmation Doesn't Match", "", "error");
      return false;
    }
  });

  ///////////////////////// PW Visibility Toggle /////////////////////////
  $("#pw_append").on("click", function (e) {
    if ($("#npw").prop("type") == "password") {
      $("#npw").prop("type", "text");
    } else {
      $("#npw").prop("type", "password");
    }

    $("#pw_icon").toggleClass("fa-eye fa-eye-slash");
  });

  $("#cpw_append").on("click", function (e) {
    if ($("#cpw").prop("type") == "password") {
      $("#cpw").prop("type", "text");
    } else {
      $("#cpw").prop("type", "password");
    }

    $("#cpw_icon").toggleClass("fa-eye fa-eye-slash");
  });

  ///////////////////// PW Strength Meter ////////////////////////
  const weak = /(^[a-zA-Z]{6,}$)|(^[0-9]{6,}$)/;
  const medium = /(?=.*[a-zA-Z])(?=.*[0-9])(?=.{6,})(^((?![\W\_]).)*$)/;
  const strong = /(?=.*[\W\_])(?=.{6,})/;

  $("#npw").on("keyup", function (e) {
    let pw = $(this).val();
    let corr_pass = pw.replace(/\s/g, "");
    $(this).val(corr_pass);

    if (corr_pass.match(weak) != null) {
      $(".progress-bar")
        .html("Weak")
        .css({ width: "33.33%", backgroundColor: "red" });
    } else if (corr_pass.match(medium) != null) {
      $(".progress-bar")
        .html("Medium")
        .css({ width: "66.66%", backgroundColor: "orange" });
    } else if (corr_pass.match(strong) != null) {
      $(".progress-bar")
        .html("Strong")
        .css({ width: "100%", backgroundColor: "green" });
    } else {
      $(".progress-bar").css({ width: "0%" });
    }
  });
});
