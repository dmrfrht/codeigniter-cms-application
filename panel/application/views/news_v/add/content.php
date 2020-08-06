<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Haber Ekle
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("news/save") ?>" method="post">
          <div class="form-group">
            <label>Haber Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>Haber Açıklaması</label>
            <textarea
              class="m-0"
              data-plugin="summernote"
              data-options="{height: 250}"
              name="description"></textarea>
          </div>
          <div class="form-group">
            <label>Haber Türü</label>
            <select class="form-control news_type_select" name="news_type">
              <option value="image">Resim</option>
              <option value="video">Video</option>
            </select>
          </div>
          <div class="form-group image_upload_container">
            <label>Görsel Seçiniz</label>
            <input type="file" class="form-control" name="img_url">
          </div>
          <div class="form-group video_url_container">
            <label>Video Url</label>
            <input type="text" name="video_url" class="form-control" placeholder="Video URL">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>
          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("news") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>