<div class="simple-page-wrap">
  <div class="simple-page-logo animated swing">
    <a href="<?= base_url() ?>">
      <span><i class="fa fa-gg"></i></span>
      <span>CMS</span>
    </a>
  </div><!-- logo -->
  <div class="simple-page-form animated flipInY" id="reset-password-form">
    <h4 class="form-title m-b-xl text-center">Şifremi Sıfırla</h4>

    <form action="<?= base_url("sifre-sifirla") ?>" method="post">
      <div class="form-group">
        <input
          id="reset-password-email"
          type="email"
          class="form-control"
          placeholder="E-posta adresiniz.."
          name="email"
          value="<?= isset($form_error) ? set_value("email") : null ?>"
        >
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("email") ?></small>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary">Sıfırla</button>
    </form>
  </div><!-- #reset-password-form -->

</div><!-- .simple-page-wrap -->

