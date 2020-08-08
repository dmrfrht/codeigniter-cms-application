<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Marka Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("brands/save") ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Marka Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group image_upload_container">
            <label>Görsel Seçiniz</label>
            <input type="file" class="form-control" name="img_url">
          </div>


          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("brands") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>