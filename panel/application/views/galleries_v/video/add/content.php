<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Video URL Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("galleries/galleryVideoSave/$galleryId") ?>" method="post">

          <div class="form-group">
            <label>Video Url</label>
            <input type="text" name="url" class="form-control" placeholder="Video URL">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("url") ?></small>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("galleries") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>