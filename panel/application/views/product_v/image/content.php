<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("product/imageUpload") ?>" class="dropzone" data-plugin="dropzone"
              data-options="{ url: '<?= base_url("product/imageUpload") ?>'}">
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
        <table class="table table-bordered table-striped table-hover table-responsive picture_list">
          <thead>
          <th class="w25 text-center">#id</th>
          <th class="w50 text-center">Görsel</th>
          <th>Resim Adı</th>
          <th class="w50 text-center">Durum</th>
          <th class="w50 text-center">İşlem</th>
          </thead>
          <tbody>
          <tr>
            <td class="text-center">1</td>
            <td>
              <img width="30"
                   src="https://st2.myideasoft.com/shop/rc/57/myassets/products/582/canon-eos-r-24-105mm-lens-1_min.jpg?revision=1536233567"
                   alt="" class="img-responsive">
            </td>
            <td>Resim 1</td>
            <td class="text-center">
              <input
                class="isActive"
                data-url="<?= base_url("product/isActiveSetter/") ?>"
                type="checkbox"
                data-switchery
                data-color="#10c469"
                <?= (true) ? " checked" : null ?>
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>