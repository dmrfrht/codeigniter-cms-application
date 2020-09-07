<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
  <div class="form-group">
    <label>Şirket Adı</label>
    <input
      type="text"
      name="company_name"
      class="form-control"
      placeholder="Şirket veya site adı.."
      value="<?= isset($form_error) ? set_value("company_name") : $item->company_name ?>"
    >
    <?php if (isset($form_error)): ?>
      <small class="input-form-error pull-right"><?= form_error("company_name") ?></small>
    <?php endif; ?>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>1. Telefon</label>
        <input
          type="text"
          name="phone_1"
          class="form-control"
          placeholder="1.Telefon Numarası.."
          value="<?= isset($form_error) ? set_value("phone_1") : $item->phone_1 ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("phone_1") ?></small>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>2. Telefon</label>
        <input
          type="text"
          name="phone_2"
          class="form-control"
          placeholder="2.Telefon Numarası.."
          value="<?= isset($form_error) ? set_value("phone_2") : $item->phone_2 ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("phone_2") ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>1. Fax</label>
        <input
          type="text"
          name="fax_1"
          class="form-control"
          placeholder="1.Fax Numarası.."
          value="<?= isset($form_error) ? set_value("fax_1") : $item->fax_1 ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("fax_1") ?></small>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>2. Fax</label>
        <input
          type="text"
          name="fax_2"
          class="form-control"
          placeholder="2.Fax Numarası.."
          value="<?= isset($form_error) ? set_value("fax_2") : $item->fax_2 ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("fax_2") ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>