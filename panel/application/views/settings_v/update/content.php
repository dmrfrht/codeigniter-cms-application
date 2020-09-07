<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Site Ayarlarını Düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <form action="<?= base_url("settings/update/$item->id") ?>" method="post" autocomplete="off"
          enctype="multipart/form-data">
      <div class="widget">
        <div class="m-b-lg nav-tabs-horizontal">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                Site Bilgileri
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
                Adres Bilgisi
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">
                Hakkımızda
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">
                Misyon
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-5" aria-controls="tab-5" role="tab" data-toggle="tab">
                Vizyon
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab">
                Sosyal Medya
              </a>
            </li>
            <li role="presentation">
              <a href="#tab-7" aria-controls="tab-7" role="tab" data-toggle="tab">
                Logo Bilgisi
              </a>
            </li>
          </ul>

          <div class="tab-content p-md">
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/address-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/about-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/mission-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/vision-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/social-info") ?>

            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/logo-info") ?>

          </div>
        </div>
      </div>
      <div class="widget">
        <div class="widget-body">
          <button type="submit" class="btn btn-primary btn-md">Güncelle</button>
          <a href="<?= base_url("settings") ?>" class="btn btn-md btn-danger">İptal</a>
        </div>
      </div>
    </form>
  </div>
</div>