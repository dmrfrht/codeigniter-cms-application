<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("product/imageUpload/$item->id") ?>" class="dropzone" data-plugin="dropzone"
              data-options="{ url: '<?= base_url("product/imageUpload/$item->id") ?>'}">
          <div class="dz-message">
            <h3 class="m-h-lg">Yüklemek istediğiniz resimleri buraya sürükleyiniz.</h3>
            <p class="m-b-lg text-muted">(Yüklemek için dosyalarınızı sürükleyiniz yada buraya tıklayınız)</p>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->title ?></b> ürününe ait resimler listeleniyor.
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <?php if (empty($item_images)): ?>
          <div class="alert alert-info text-center">
            <p>Bu ürüne ait resim bulunmamaktadır.</p>
          </div>
        <?php else: ?>
          <table class="table table-bordered table-striped table-hover table-responsive picture_list">
            <thead>
            <th class="w25 text-center">#id</th>
            <th class="w50 text-center">Görsel</th>
            <th>Resim Adı</th>
            <th class="w50 text-center">Durum</th>
            <th class="w50 text-center">İşlem</th>
            </thead>
            <tbody>
            <?php foreach ($item_images as $item_image): ?>
              <tr>
                <td class="text-center"><?= $item_image->id ?></td>
                <td>
                  <img width="30"
                       src="<?= base_url("uploads/{$viewFolder}/$item_image->img_url") ?>"
                       alt="<?= $item_image->img_url ?>" class="img-responsive">
                </td>
                <td><?= $item_image->img_url ?></td>
                <td class="text-center">
                  <input
                    class="isActive"
                    data-url="<?= base_url("product/isActiveSetter/") ?>"
                    type="checkbox"
                    data-switchery
                    data-color="#10c469"
                    <?= ($item_image->isCover) ? " checked" : null ?>
                  />
                </td>
                <td class="text-center">
                  <button
                    data-url="<?= base_url("product/delete/") ?>"
                    class="btn btn-danger btn-xs btn-outline remove-btn">
                    <i class="fa fa-trash"></i>
                    Sil
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>