"use strict";

$(document).ready(function () {
  $(".remove").on("click", function (e) {
    let itemid = $(this).attr("data-itemId");

    $.ajax({
      url: "../common/cart_session.php?type=removeItem",
      method: "POST",
      data: { itemId: itemid },
      success: function (res) {
        $.ajax({
          url: "../controller/cart_controller.php?type=removeItem",
          method: "POST",
          data: { itemId: itemid },
          success: function (res) {
            location.reload();
          },
          error: function (xhr) {
            console.log(xhr);
          },
        });
      },
      error: function (xhr) {
        console.log(xhr);
      },
    });
  });

  $(".increaseProd").on("click", function (e) {
    let itemid = $(this).attr("data-itemId");

    $.ajax({
      url: "../controller/stock_controller.php?type=getStock_ByStockId",
      method: "GET",
      data: { itemId: itemid },
      dataType: "JSON",
      success: function (res) {
        if (res.stock_count > 0) {
          $.ajax({
            url: "../common/cart_session.php?type=increaseQty",
            method: "POST",
            data: { itemId: itemid },
            success: function (res) {
              $.ajax({
                url: "../controller/cart_controller.php?type=addNewItem",
                method: "POST",
                data: { itemId: itemid },
                success: function (res) {
                  location.reload();
                },
                error: function (xhr) {
                  console.log(xhr);
                },
              });
            },
            error: function (xhr) {
              console.log(xhr);
            },
          });
        } else {
          Swal.fire(
            "Sorry You Cannot Increase Quantity",
            "Not Enough Stock",
            "error"
          );
        }
      },
      error: function (xhr) {
        console.log(xhr);
      },
    });
  });

  $(".decreaseProd").on("click", function (e) {
    let itemid = $(this).attr("data-itemId");
    let prodQty = $(this).attr("data-prodQty");

    if (prodQty > 1) {
      $.ajax({
        url: "../common/cart_session.php?type=decreaseQty",
        method: "POST",
        data: { itemId: itemid },
        success: function (res) {
          $.ajax({
            url: "../controller/cart_controller.php?type=decreaseQty",
            method: "POST",
            data: { itemId: itemid },
            success: function (res) {
              location.reload();
            },
            error: function (xhr) {
              console.log(xhr);
            },
          });
        },
        error: function (xhr) {
          console.log(xhr);
        },
      });
    }
  });
});
