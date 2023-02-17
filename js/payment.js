"use strict";

$(document).ready(function () {
  let curr_step = 1;
  let total_steps = $("fieldset").length;
  let curr_fs, next_fs, prev_fs;

  $("fieldset").slice(1).hide();

  function setProgressBar(curr_step) {
    let percent = (100 / total_steps) * curr_step;

    $(".progress-bar").css("width", `${percent}%`);
  }

  setProgressBar(curr_step);

  $(".next").on("click", function (e) {
    curr_step++;
    setProgressBar(curr_step);

    curr_fs = $(this).parent();
    next_fs = $(this).parent().next();

    curr_fs.fadeOut(100);
    next_fs.fadeIn(500);

    let next_fsIndex = $("fieldset").index(next_fs);
    $("#progressbar > li").eq(next_fsIndex).addClass("active");
  });

  $(".previous").on("click", function (e) {
    curr_step--;
    setProgressBar(curr_step);

    curr_fs = $(this).parent();
    prev_fs = $(this).parent().prev();

    curr_fs.fadeOut(100);
    prev_fs.fadeIn(500);

    let curr_fsIndex = $("fieldset").index(curr_fs);
    $("#progressbar > li").eq(curr_fsIndex).removeClass("active");
  });
});
