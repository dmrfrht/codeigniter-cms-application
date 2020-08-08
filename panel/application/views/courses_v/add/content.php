<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Eğitim Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("courses/save") ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Eğitim Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Eğitim Açıklaması</label>
            <textarea
              class="m-0"
              data-plugin="summernote"
              data-options="{height: 250}"
              name="description"></textarea>
          </div>

          <div class="row">
            <div class="col-md-4">
              <label for="datetimepicker1">Eğitim Tarihi</label>
              <input id="datetimepicker1" data-plugin="datetimepicker"
                   data-options="{ inline: true, viewMode: 'days', format: 'YYYY-MM-DD HH:mm:ss' }" name="event_date" type="hidden">
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Görsel Seçiniz</label>
                <input type="file" class="form-control" name="img_url">
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("courses") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>