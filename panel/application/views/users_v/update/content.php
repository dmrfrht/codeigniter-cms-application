<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->user_name ?></b> kullanıcı adına sahip kullanıcı bilgilerini düzenliyorsunuz
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("users/update/$item->id") ?>" method="post">
          <div class="form-group">
            <label>Kullanıcı Adı</label>
            <input
              type="text"
              name="user_name"
              class="form-control"
              placeholder="Kullanıcı Adı.."
              value="<?= isset($form_error) ? set_value("user_name") : $item->user_name ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("user_name") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Ad - Soyad</label>
            <input
              type="text"
              name="full_name"
              class="form-control"
              placeholder="Ad - Soyad.."
              value="<?= isset($form_error) ? set_value("full_name") : $item->full_name ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("full_name") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>E-posta Adresi</label>
            <input
              type="email"
              name="email"
              class="form-control"
              placeholder="E-posta Adresi.."
              value="<?= isset($form_error) ? set_value("email") : $item->email ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("email") ?></small>
            <?php endif; ?>
          </div>


          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("users") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>