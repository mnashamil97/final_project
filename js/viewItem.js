"use strict";

$(document).ready(function () {
  $(".change").on("click", function (e) {
    let imgName = $(this).attr("data-imgName");

    $("#mainImage > img").hide().attr("src", imgName).fadeIn();
    $("#mainImage").attr("href", imgName);

    $(".selected").removeClass();
    $(this).addClass("selected");
  });

  $("#sizeId").on("change", function (e) {
    let prodId = $("#productId").val();
    let sizeId = $(this).val();

    if (sizeId != "") {
      $.ajax({
        url: "../controller/stock_controller.php?type=getStock_bySizeAndProduct",
        method: "GET",
        data: { sizeId: sizeId, prodId: prodId },
        dataType: "JSON",
        success: function (res) {
          if (res != "error") {
            if (res.stock_count > 0) {
              $("#setPrice").html(res.stock_sell_price);
              $("#stockId").val(res.stock_id);
              $("#productPrice").val(res.stock_sell_price);
              $("#addToCart").prop("disabled", false);
            } else {
              $("#setPrice").html("Not Enough Stock");
              $("#stockId").val("");
              $("#productPrice").val("");
              $("#addToCart").prop("disabled", true);
            }
          } else {
            console.log("Response Error");
          }
        },
        error: function (xhr) {
          console.log(xhr);
        },
      });
    }
  });

  $("#addToCartForm").on("submit", function (e) {
    let itemId = $("#stockId").val();

    if (itemId != "") {
      $.ajax({
        url: "../controller/cart_controller.php?type=addNewItem",
        method: "POST",
        data: { itemId: itemId },
        success: function (res) {},
        error: function (xhr) {
          console.log(xhr);
        },
      });
    }
  });
});
