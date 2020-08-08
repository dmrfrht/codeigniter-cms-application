<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Galeri Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("galleries/save") ?>" method="post">
          <div class="form-group">
            <label>Galeri Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Galeri Türü</label>
            <select class="form-control" name="gallery_type">
              <option <?= isset($gallery_type) && ($gallery_type == 'image') ? ' selected' : null ?> value="image">
                Resim
              </option>
              <option <?= isset($gallery_type) && ($gallery_type == 'video') ? ' selected' : null ?> value="video">
                Video
              </option>
              <option <?= isset($gallery_type) && ($gallery_type == 'file') ? ' selected' : null ?> value="file">
                Dosya
              </option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("galleries") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div>
</div>