<div role="tabpanel" class="tab-pane fade" id="tab-6">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>E-posta Adresi</label>
        <input
          type="text"
          name="email"
          class="form-control"
          placeholder="E-posta adresiniz.."
          value="<?= isset($form_error) ? set_value("email") : "" ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("email") ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Facebook</label>
        <input
          type="text"
          name="facebook"
          class="form-control"
          placeholder="https://www.facebook.com/"
          value="<?= isset($form_error) ? set_value("facebook") : "" ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("facebook") ?></small>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Twitter</label>
        <input
          type="text"
          name="twitter"
          class="form-control"
          placeholder="https://www.twitter.com/"
          value="<?= isset($form_error) ? set_value("twitter") : "" ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("twitter") ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Instagram</label>
        <input
          type="text"
          name="instagram"
          class="form-control"
          placeholder="https://www.instagram.com/"
          value="<?= isset($form_error) ? set_value("instagram") : "" ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("instagram") ?></small>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Linkedin</label>
        <input
          type="text"
          name="linkedin"
          class="form-control"
          placeholder="https://www.linkedin.com/in/"
          value="<?= isset($form_error) ? set_value("linkedin") : "" ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("linkedin") ?></small>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>