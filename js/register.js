"use strict";

$(document).ready(function () {
  $("#addCustomer").on("submit", function (e) {
    let contact = $("#contact").val();
    let pw = $("#pw").val();
    let cpw = $("#cpw").val();

    const contact_patt = /(^[0-9]{9}$)/;

    if (contact.match(contact_patt) == null) {
      Swal.fire("Invalid Contact Number", "", "error");
      return false;
    } else if ($("input[name=gender]:checked").length < 1) {
      Swal.fire("Please Select Your Gender", "", "question");
      return false;
    } else if (pw != cpw) {
      Swal.fire("Password Confirmation Doesn't Match", "", "error");
      return false;
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

  $("#pw").on("keyup", function (e) {
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

  ///////////////// Preview Image /////////////////
  $("#uimg").on("change", function (e) {
    let file = $(this).get(0).files[0];

    if (file) {
      let src = URL.createObjectURL(file);
      $("#prev_img").attr("src", src).width(120).height(110);
    }
  });

  /////////////// check User Existance /////////////////
  $("#nic").on("focusout", function (e) {
    let nic = $(this).val();

    if (nic != "") {
      $.ajax({
        url: "../controller/customer_controller.php?type=checkNIC",
        method: "GET",
        data: { nic: nic },
        success: function (res) {
          if (res == 1) {
            $("#nic_response").html("This NIC already has been taken");
            $("#submit").prop("disabled", true);
          } else {
            $("#nic_response").html("");
            $("#submit").prop("disabled", false);
          }
        },
        error: function (xhr) {
          console.log(xhr.status);
          console.log(xhr.statusText);
          console.log(xhr.responseText);
        },
      });
    }
  });
});
