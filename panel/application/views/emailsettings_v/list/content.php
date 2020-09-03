<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      E-posta Listesi
      <a href="<?= base_url("emailsettings/new_form") ?>" class="btn pull-right btn-outline btn-success btn-xs"><i
          class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
              href="<?= base_url("emailsettings/new_form") ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th class="w25">#id</th>
          <th>E-posta Başlık</th>
          <th>Sunucu Adı</th>
          <th>Protokol</th>
          <th>Port</th>
          <th>E-posta</th>
          <th>Nerden</th>
          <th>Nereye</th>
          <th class="w50">Durumu</th>
          <th class="w250">İşlem</th>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td class="text-center">#<?= $item->id ?></td>
              <td><?= $item->user_name ?></td>
              <td><?= $item->host ?></td>
              <td><?= $item->protocol ?></td>
              <td><?= $item->port ?></td>
              <td><?= $item->user ?></td>
              <td><?= $item->from ?></td>
              <td><?= $item->to ?></td>
              <td>
                <input
                  class="isActive"
                  data-url="<?= base_url("emailsettings/isActiveSetter/$item->id") ?>"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= ($item->isActive) ? " checked" : null ?>
                />
              </td>
              <td>
                <button
                  data-url="<?= base_url("emailsettings/delete/$item->id") ?>"
                  class="btn btn-danger btn-xs btn-outline remove-btn">
                  <i class="fa fa-trash"></i>
                  Sil
                </button>
                <a href="<?= base_url("emailsettings/update_form/$item->id") ?>"
                   class="btn btn-info btn-xs btn-outline"><i
                    class="fa fa-pencil-square-o"></i> Düzenle</a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>