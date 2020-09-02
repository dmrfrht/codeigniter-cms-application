
<div class="simple-page-wrap">
  <div class="simple-page-logo animated swing">
    <a href="index.html">
      <span><i class="fa fa-gg"></i></span>
      <span>CMS</span>
    </a>
  </div><!-- logo -->
  <div class="simple-page-form animated flipInY" id="login-form">
    <h5 class="form-title m-b-xl text-center">Kayıtlı e-posta adresiniz ile giriş yapabilirsiniz</h5>
    <form action="<?=base_url("userop/do_login")?>" method="post">
      <div class="form-group">
        <input
          id="sign-in-email"
          type="email"
          class="form-control"
          placeholder="E-posta adresiniz"
          name="user_email">
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("user_email") ?></small>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <input
          id="sign-in-password"
          type="password"
          class="form-control"
          placeholder="Şifreniz"
          name="user_password">
        <?php if (isset($form_error)): ?>
          <small class="input-form-error pull-right"><?= form_error("user_password") ?></small>
        <?php endif; ?>
      </div>

      <button class="btn btn-primary" type="submit">Giriş Yap</button>
    </form>
  </div><!-- #login-form -->

  <div class="simple-page-footer">
    <p><a href="password-forget.html">Şifremi Sıfırla</a></p>
  </div><!-- .simple-page-footer -->


</div><!-- .simple-page-wrap -->