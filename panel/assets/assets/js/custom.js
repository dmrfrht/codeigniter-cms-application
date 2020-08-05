$(document).ready(function () {

  $(".sortable").sortable();

  $(".content-container, .image_list_container").on("click", ".remove-btn", function (e) {
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

  $(".content-container, .image_list_container").on("change", ".isActive", function () {
    var $data_url = $(this).data("url");
    var $data = $(this).prop("checked");

    if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
      $.post($data_url, {data: $data}, function (res) {
      });
    }

  });

  $(".image_list_container").on("change", ".isCover", function () {
    var $data_url = $(this).data("url");
    var $data = $(this).prop("checked");

    if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
      $.post($data_url, {data: $data}, function (res) {
        $(".image_list_container").html(res);

        $('[data-switchery]').each(function () {
          var $this = $(this),
            color = $this.attr('data-color') || '#188ae2',
            jackColor = $this.attr('data-jackColor') || '#ffffff',
            size = $this.attr('data-size') || 'default'

          new Switchery(this, {
            color: color,
            size: size,
            jackColor: jackColor
          });
        });

        $(".sortable").sortable();
      });
    }

  });

  $(".content-container, .image_list_container").on("sortupdate", ".sortable", function (event, ui) {
    var $data = $(this).sortable("serialize");
    var $data_url = $(this).data("url");

    $.post($data_url, {data: $data}, function (res) {
    });
  });

  var uploadSection = Dropzone.forElement("#dropzone");
  uploadSection.on("complete", function () {
    var $data_url = $("#dropzone").data("url");

    $.post($data_url, {}, function (res) {
      $(".image_list_container").html(res);

      $('[data-switchery]').each(function () {
        var $this = $(this),
          color = $this.attr('data-color') || '#188ae2',
          jackColor = $this.attr('data-jackColor') || '#ffffff',
          size = $this.attr('data-size') || 'default'

        new Switchery(this, {
          color: color,
          size: size,
          jackColor: jackColor
        });
      });

      $(".sortable").sortable();
    });

  });

});
