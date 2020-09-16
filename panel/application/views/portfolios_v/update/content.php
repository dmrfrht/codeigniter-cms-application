<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->title ?></b> kaydını düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("portfolios/update/$item->id") ?>" method="post">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Ürün Başlığı</label>
                <input
                  type="text"
                  name="title"
                  class="form-control"
                  placeholder="Başlık"
                  value="<?= isset($form_error) ? set_value("title") : $item->title ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("title") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                  <?php foreach ($categories as $category): ?>
                    <?php
                      $category_id = isset($form_error) ? set_value("category_id") : $item->category_id;
                    ?>
                    <option
                      value="<?= $category->id ?>"
                      <?= $category->id == $category_id ? " selected" : null ?>
                    >
                      <?= $category->title ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("category_id") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <label for="datetimepicker1">Bitirme Zamanı</label>
              <input id="datetimepicker1" data-plugin="datetimepicker"
                     data-options="{ inline: true, viewMode: 'days', format: 'YYYY-MM-DD HH:mm:ss' }" name="finishedAt"
                     type="hidden" value="<?= $item->finishedAt ?>">
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Müşteri</label>
                    <input
                      type="text"
                      name="client"
                      class="form-control"
                      placeholder="Müşteri"
                      value="<?= isset($form_error) ? set_value("client") : $item->client ?>"
                    >
                    <?php if (isset($form_error)): ?>
                      <small class="input-form-error pull-right"><?= form_error("client") ?></small>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Yer/Mekan</label>
                    <input
                      type="text"
                      name="place"
                      class="form-control"
                      placeholder="Yer /  Mekan"
                      value="<?= isset($form_error) ? set_value("place") : $item->place ?>"
                    >
                    <?php if (isset($form_error)): ?>
                      <small class="input-form-error pull-right"><?= form_error("place") ?></small>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Portfolyo URL</label>
                    <input
                      type="text"
                      name="portfolio_url"
                      class="form-control"
                      placeholder="Bağlantı Adresi"
                      value="<?= isset($form_error) ? set_value("portfolio_url") : $item->portfolio_url ?>"
                    >
                    <?php if (isset($form_error)): ?>
                      <small class="input-form-error pull-right"><?= form_error("portfolio_url") ?></small>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Ürün Açıklaması</label>
            <textarea
              class="m-0"
              data-plugin="summernote"
              data-options="{height: 250}"
              name="description"><?= isset($form_error) ? set_value("description") : $item->description ?></textarea>
          </div>


          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("portfolios") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>