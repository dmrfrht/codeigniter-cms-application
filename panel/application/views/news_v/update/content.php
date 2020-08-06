<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->title ?></b> kaydını düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("news/update/$item->id") ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Ürün Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?= $item->title ?>">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>Ürün Açıklaması</label>
            <textarea
              class="m-0"
              data-plugin="summernote"
              data-options="{height: 250}"
              name="description"><?= $item->description ?></textarea>
          </div>
          <div class="form-group">
            <label>Haber Türü</label>
            <?php if (isset($form_error)): ?>
              <select class="form-control news_type_select" name="news_type">
                <option <?= ($news_type == 'image') ? ' selected' : null ?> value="image">Resim</option>
                <option <?= ($news_type == 'video') ? ' selected' : null ?> value="video">Video</option>
              </select>
            <?php else: ?>
              <select class="form-control news_type_select" name="news_type">
                <option <?= ($item->news_type == 'image') ? ' selected' : null ?> value="image">Resim</option>
                <option <?= ($item->news_type == 'video') ? ' selected' : null ?> value="video">Video</option>
              </select>
            <?php endif; ?>
          </div>

          <?php if (isset($form_error)): ?>
            <div class="form-group image_upload_container"
                 style="display: <?= ($news_type == 'image') ? 'block' : 'none' ?>">
              <label>Görsel Seçiniz</label>
              <input type="file" class="form-control" name="img_url">
            </div>

            <div class="form-group video_url_container"
                 style="display: <?= ($news_type == 'video') ? 'block' : 'none' ?>">
              <label>Video Url</label>
              <input type="text" name="video_url" class="form-control" placeholder="Video URL">
              <?php if (isset($form_error)): ?>
                <small class="input-form-error pull-right"><?= form_error("video_url") ?></small>
              <?php endif; ?>
            </div>
          <?php else: ?>
            <div class="row">
              <div class="form-group col-md-2 image_upload_container">
                <img src="<?= base_url("uploads/{$viewFolder}/$item->img_url") ?>" alt=""
                     class="img-responsive img-rounded"
                     width="100">
              </div>
              <div class="col-md-10 form-group image_upload_container"
                   style="display: <?= ($item->news_type == 'image') ? 'block' : 'none' ?>">
                <label>Görsel Seçiniz</label>
                <input type="file" class="form-control" name="img_url">
              </div>
            </div>

            <div class="form-group video_url_container"
                 style="display: <?= ($item->news_type == 'video') ? 'block' : 'none' ?>">
              <label>Video Url</label>
              <input type="text" name="video_url" class="form-control" placeholder="Video URL"
                     value="<?= $item->video_url ?>">
            </div>
          <?php endif; ?>


          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("news") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>