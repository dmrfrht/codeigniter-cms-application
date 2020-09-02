<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Kullanıcı Listesi
      <a href="<?= base_url("users/new_form") ?>" class="btn pull-right btn-outline btn-success btn-xs"><i
          class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
              href="<?= base_url("users/new_form") ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th class="w25">#id</th>
          <th>Kullanıcı Adı</th>
          <th>Ad - Soyad</th>
          <th>E-posta</th>
          <th class="w50">Durumu</th>
          <th class="w250">İşlem</th>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td class="text-center">#<?= $item->id ?></td>
              <td><?= $item->user_name ?></td>
              <td><?= $item->full_name ?></td>
              <td><?= $item->email ?></td>
              <td>
                <input
                  class="isActive"
                  data-url="<?= base_url("users/isActiveSetter/$item->id") ?>"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= ($item->isActive) ? " checked" : null ?>
                />
              </td>
              <td>
                <button
                  data-url="<?= base_url("users/delete/$item->id") ?>"
                  class="btn btn-danger btn-xs btn-outline remove-btn">
                  <i class="fa fa-trash"></i>
                  Sil
                </button>
                <a href="<?= base_url("users/update_form/$item->id") ?>" class="btn btn-info btn-xs btn-outline"><i
                    class="fa fa-pencil-square-o"></i> Düzenle</a>
                <a href="<?= base_url("users/update_password_form/$item->id") ?>" class="btn btn-purple btn-xs btn-outline"><i
                    class="fa fa-key"></i> Şifre Değiştir</a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>