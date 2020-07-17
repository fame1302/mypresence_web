function seeDetail(e) {
  $("#jadwal-detail").hide();
  $(".item-tgl").css("border", "solid 1px #ddd");
  $(e).css("border", "solid 2px");

  var date = $(e).find("[name=date]");
  var jam_masuk = $(e).find("[name=jam_masuk]");
  var jam_pulang = $(e).find("[name=jam_pulang]");
  var lokasi = $(e).find("[name=lokasi]");

  //   alert(jam_masuk.val());

  if (jam_masuk.val() == "" || jam_pulang.val() == "" || lokasi.val() == "") {
    $("#jam-container").hide();
    $("#lokasi-container").hide();
    $("#jadwal-alert").show();
  } else {
    $("#jadwal-alert").hide();
    $("#jam-container").show();
    $("#lokasi-container").show();
  }

  $("#date-detail").html(date.val());
  $("#jam-masuk").html(jam_masuk.val());
  $("#jam-pulang").html(jam_pulang.val());
  $("#lokasi").html(lokasi.val());
  $("#jadwal-detail").slideDown();
}
