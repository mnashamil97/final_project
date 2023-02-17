"use strict";

$(document).ready(function () {
  $("#editCustomer").on("submit", function (e) {
    let contact = $("#contact").val();

    const contact_patt = /(^[0-9]{9}$)/;

    if (contact.match(contact_patt) == null) {
      Swal.fire("Invalid Contact Number", "", "error");
      return false;
    } else if ($("input[name=gender]:checked").length < 1) {
      Swal.fire("Please Select Your Gender", "", "question");
      return false;
    }
  });

  ///////////////// Preview Image /////////////////
  $("#uimg").on("change", function (e) {
    let file = $(this).get(0).files[0];

    if (file) {
      let src = URL.createObjectURL(file);
      $("#prev_img").attr("src", src);
    }
  });
});
