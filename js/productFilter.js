"use strict";

$(document).ready(function () {
  let collId = $("#collId").val();
  let brandId = $("input[name=brandId]:checked").val();
  let collTypeId = $("input[name=collTypeId]:checked").val();
  let catId = $("input[name=catId]:checked").val();

  $.ajax({
    url: "../controller/product_controller.php?type=filterProducts",
    method: "GET",
    data: {
      collId: collId,
      brandId: brandId,
      collTypeId: collTypeId,
      catId: catId,
    },
    success: function (res) {
      $("#content").html(res);
    },
    error: function (xhr) {
      console.log(xhr);
    },
  });

  $("input[name=brandId], input[name=collTypeId], input[name=catId]").on(
    "change",
    function (e) {
      let collId = $("#collId").val();
      let brandId = $("input[name=brandId]:checked").val();
      let collTypeId = $("input[name=collTypeId]:checked").val();
      let catId = $("input[name=catId]:checked").val();

      $.ajax({
        url: "../controller/product_controller.php?type=filterProducts",
        method: "GET",
        data: {
          collId: collId,
          brandId: brandId,
          collTypeId: collTypeId,
          catId: catId,
        },
        success: function (res) {
          $("#content").html(res);
        },
        error: function (xhr) {
          console.log(xhr);
        },
      });
    }
  );
});
