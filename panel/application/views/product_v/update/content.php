<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->title  ?></b> kaydını düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("product/save") ?>" method="post">
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
          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?= base_url("product") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div>
</div>