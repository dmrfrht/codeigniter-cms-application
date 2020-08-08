<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->title ?></b> kaydını düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("galleries/update/$item->id/$item->gallery_type/$item->folder_name") ?>" method="post">
          <div class="form-group">
            <label>Galeri Başlığı</label>
            <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?= $item->title ?>">
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("galleries") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div>
</div>