<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->user_name ?></b> kullanıcı adına sahip kullanıcının şifresini güncelliyorsunuz.
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("users/update_password/$item->id") ?>" method="post">
          <div class="form-group">
            <label>Şifre</label>
            <input
              type="password"
              name="password"
              class="form-control"
              placeholder="Yeni Şifre.."
              value="<?= isset($form_error) ? set_value("password") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("password") ?></small>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Şifre Tekrar</label>
            <input
              type="password"
              name="re_password"
              class="form-control"
              placeholder="Yeni Şifre Tekrar.."
              value="<?= isset($form_error) ? set_value("re_password") : null ?>"
            >
            <?php if (isset($form_error)): ?>
              <small class="input-form-error pull-right"><?= form_error("re_password") ?></small>
            <?php endif; ?>
          </div>


          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("users") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>