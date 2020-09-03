<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $item->user_name ?></b> başlıklı e-posta ayarlarını düzenliyorsunuz.
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("emailsettings/update/$item->id") ?>" method="post">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>E-posta Başlık</label>
                <input
                  type="text"
                  name="user_name"
                  class="form-control"
                  placeholder="E-posta başlık.."
                  value="<?= isset($form_error) ? set_value("user_name") : $item->user_name ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("user_name") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Protokol</label>
                <input
                  type="text"
                  name="protocol"
                  class="form-control"
                  placeholder="Protokol.."
                  value="<?= isset($form_error) ? set_value("protocol") : $item->protocol ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("protocol") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>E-posta Sunucu Bilgisi</label>
                <input
                  type="text"
                  name="host"
                  class="form-control"
                  placeholder="Host.."
                  value="<?= isset($form_error) ? set_value("host") : $item->host ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("host") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Port Numarası</label>
                <input
                  type="text"
                  name="port"
                  class="form-control"
                  placeholder="Port.."
                  value="<?= isset($form_error) ? set_value("port") : $item->port ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("port") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>E-posta Adresi</label>
                <input
                  type="email"
                  name="user"
                  class="form-control"
                  placeholder="User.."
                  value="<?= isset($form_error) ? set_value("user") : $item->user ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("user") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>E-posta Şifre</label>
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="E-posta adresine ait şifre.."
                  value="<?= isset($form_error) ? set_value("password") : $item->password ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("password") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nerden</label>
                <input
                  type="email"
                  name="from"
                  class="form-control"
                  placeholder="Nerden gidecek.."
                  value="<?= isset($form_error) ? set_value("from") : $item->from ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("from") ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nereye</label>
                <input
                  type="email"
                  name="to"
                  class="form-control"
                  placeholder="Nereye gidecek.."
                  value="<?= isset($form_error) ? set_value("to") : $item->to ?>"
                >
                <?php if (isset($form_error)): ?>
                  <small class="input-form-error pull-right"><?= form_error("to") ?></small>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
          <a href="<?= base_url("emailsettings") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
        </form>
      </div>
    </div>
  </div>
</div>