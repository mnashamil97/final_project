"use strict";

$(document).ready(function () {
  $("#orderRecordsTable, #feedbackTable").DataTable();

  $('[data-toggle="tooltip"]').tooltip();

  $(".orderHistory").on("click", function (e) {
    let invoiceId = $(this).attr("data-invoiceId");

    $.ajax({
      url: "../controller/order_controller.php?type=viewOrderDetails",
      method: "GET",
      data: { invoiceId: invoiceId },
      success: function (res) {
        $("#viewOrderDetails").html(res);
      },
      error: function (xhr) {},
    });
  });

  $(".feedbackBtn").on("click", function (e) {
    let invoiceId = $(this).attr("data-invoiceId");

    $("#feedBackModal").modal("show");
    $("#invoiceId").val(invoiceId);
  });

  $("#feedbackSubmit").on("click", function (e) {
    e.preventDefault();

    $.ajax({
      url: "../controller/feedback_controller.php?type=addFeedback",
      method: "POST",
      data: $("#feedbackForm").serialize(),
      success: function (res) {
        if (res == 1) {
          Swal.fire({
            title: "Thank You !!!",
            text: "Your Feedback",
            icon: "success",
            showConfirmButton: false,
            timer: 2500,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire("Oops", "Something Went Wrong. Please Try Again", "error");
        }
      },
      error: function (xhr) {},
    });
  });
});
