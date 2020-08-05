$(document).ready(function () {

  $(".sortable").sortable();

  $(".remove-btn").on("click", function (e) {
    var $data_url = $(this).data("url");

    swal({
      title: "Emin misiniz?",
      text: "Bu işlemi geri alamayacaksınız",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Evet, sil',
      cancelButtonText: "Hayır"
    }).then((result) => {
      if (result.value) {
        window.location.href = $data_url;
      }
    })

    e.preventDefault();
  });

  $(".isActive").on("change", function () {
    var $data_url = $(this).data("url");
    var $data = $(this).prop("checked");

    if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
      $.post($data_url, {data: $data}, function (res) {
      });
    }

  });

  $(".sortable").on("sortupdate", function (event, ui) {
    var $data = $(this).sortable("serialize");
    var $data_url = $(this).data("url");

    $.post($data_url, {data: $data}, function (res) {
    });
  });


});
