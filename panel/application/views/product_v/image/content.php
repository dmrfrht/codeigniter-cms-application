<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="../api/dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
          <div class="dz-message">
            <h3 class="m-h-lg">Drop files here or click to upload.</h3>
            <p class="m-b-lg text-muted">(This is just a demo dropzone. Selected files are not actually uploaded.)</p>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Ürünün Fotoğrafları
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <table class="table table-bordered table-striped table-hover table-responsive">
          <thead>
          <th>#id</th>
          <th>Görsel</th>
          <th>Resim Adı</th>
          <th>Durum</th>
          <th>İşlem</th>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>
              <img width="30" src="https://st2.myideasoft.com/shop/rc/57/myassets/products/582/canon-eos-r-24-105mm-lens-1_min.jpg?revision=1536233567" alt="" class="img-responsive">
            </td>
            <td>Resim 1</td>
            <td>
              <input
                class="isActive"
                data-url="<?= base_url("product/isActiveSetter/")  ?>"
                type="checkbox"
                data-switchery
                data-color="#10c469"
                <?= (true) ? " checked" : null ?>
              />
            </td>
            <td>
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