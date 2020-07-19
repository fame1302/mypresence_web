function seeDetail(e) {
  $("#jadwal-detail").hide();
  $(".item-tgl").css("border", "solid 1px #ddd");
  $(e).css("border", "solid 2px");

  var date = $(e).find("[name=date]");
  var jam_masuk = $(e).find("[name=jam_masuk]");
  var jam_pulang = $(e).find("[name=jam_pulang]");
  var lokasi = $(e).find("[name=lokasi]");
  var tgl = $(e).find("[name=tgl]");
  var able = $(e).find("[name=able]");

  $("#btn-jadwal").children().attr("data-tgl", tgl.val());
  $("#ajax-container").hide();
  if (jam_masuk.val() == "" || jam_pulang.val() == "" || lokasi.val() == "") {
    $("#jam-container").hide();
    $("#lokasi-container").hide();
    $("#jadwal-alert").show();
    $("#btn-jadwal").children().hide();
    $("#add-jadwal").show();
  } else {
    $("#jadwal-alert").hide();
    $("#jam-container").show();
    $("#lokasi-container").show();
    $("#btn-jadwal").children().hide();
    $("#edit-jadwal").show();
    $("#delete-jadwal").show();
  }
  if (able.val() == "false") {
    $("#btn-jadwal").children().hide();
  }

  $("#date-detail").html(date.val());
  $("#jam-masuk").html(jam_masuk.val());
  $("#jam-pulang").html(jam_pulang.val());
  $("#lokasi").html(lokasi.val());
  $("#jadwal-detail").slideDown();
}

function addJadwal(e) {
  $("#jadwal-container").children().hide();
  $("#date-detail").show();
  $("#ajax-container").slideDown();
  var c_tgl = $("#add-jadwal").attr("data-tgl");
  var c_url = $("#add-jadwal").attr("data-url");
  $.ajax({
    url: "/admin/add_jadwal",
    type: "post",
    data: {
      url: c_url,
      tgl: c_tgl,
    },
    success: function (result) {
      $("#ajax-container").html(result);
    },
  });
}

function deleteJadwal(e) {
  if (confirm("apa anda yakin?")) {
    $.ajax({
      url: "/admin/delete_jadwal",
      type: "post",
      data: {
        url: $(e).attr("data-url"),
        tgl: $(e).attr("data-tgl"),
      },
      success: function (result) {
        window.location.replace($(e).attr("data-url"));
      },
    });
  }
}
