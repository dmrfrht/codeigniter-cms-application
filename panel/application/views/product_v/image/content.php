<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form data-url="<?= base_url("product/refreshImageList/$item->id") ?>"
              action="<?= base_url("product/imageUpload/$item->id") ?>" id="dropzone" class="dropzone"
              data-plugin="dropzone"
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
      <div class="widget-body image_list_container">

        <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v") ?>

      </div>
    </div>
  </div>
</div>