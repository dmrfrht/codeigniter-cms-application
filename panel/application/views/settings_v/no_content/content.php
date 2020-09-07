<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Site Ayarları
      <a href="<?= base_url("settings/new_form") ?>" class="btn pull-right btn-outline btn-success btn-xs"><i
          class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
              href="<?= base_url("settings/new_form") ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>