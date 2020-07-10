$(document).ready(function () {
  function seePassword() {
    if ($("input[name=password]").attr("type") == "password") {
      $("input[name=password]").attr("type", "text");
      $("input[name=konfirmasi]").attr("type", "text");
      $("#pass-eye").removeClass("fa-eye");
      $("#pass-eye").addClass("fa-eye-slash");
    } else {
      $("#pass-eye").removeClass("fa-eye-slash");
      $("#pass-eye").addClass("fa-eye");
      $("input[name=konfirmasi]").attr("type", "password");
      $("input[name=password]").attr("type", "password");
    }
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#user-foto-preview").attr("src", e.target.result);
      };

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("input[name=pass-check]").on("click", seePassword);

  $("#inputFotoUser").on("change", function () {
    //get the file name
    // alert("oke");
    var fileName = $(this).val();
    //replace the "Choose a file" label
    // alert(fileName);
    readURL(this);
    $("#user-foto-preview").show();
    $(this).next(".input-foto-user-label").html(fileName);
  });
});

function imgPreview() {
  const foto = document.querySelector("#input-foto");
  const label = document.querySelector("#label-foto");
  const preview = document.querySelector("#preview-foto");

  label.textContent = foto.files[0].name;
  const fileFoto = new FileReader();
  fileFoto.readAsDataURL(foto.files[0]);

  fileFoto.onload = function (e) {
    preview.src = e.target.result;
  };
  preview.style.display = "block";
}
