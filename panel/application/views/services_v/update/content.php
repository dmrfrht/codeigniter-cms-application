<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->title ?></b> kaydını düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("services/update/$item->id") ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Hizmet Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?= $item->title ?>">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>Hizmet Açıklaması</label>
            <textarea
              class="m-0"
              data-plugin="summernote"
              data-options="{height: 250}"
              name="description"><?= $item->description ?></textarea>
          </div>

          <div class="row">
            <div class="form-group col-md-2">
              <img src="<?= base_url("uploads/{$viewFolder}/$item->img_url") ?>" alt=""
                   class="img-responsive img-rounded"
                   width="100">
            </div>
            <div class="col-md-10 form-group">
              <label>Görsel Seçiniz</label>
              <input type="file" class="form-control" name="img_url">
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("services") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>