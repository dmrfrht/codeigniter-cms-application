<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Hizmet Listesi
      <a href="<?= base_url("services/new_form") ?>" class="btn pull-right btn-outline btn-success btn-xs"><i
          class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
              href="<?= base_url("services/new_form") ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th class="w25"><i class="fa fa-reorder"></i></th>
          <th class="w25">#id</th>
          <th>Başlık</th>
          <th>url</th>
          <th>Görsel</th>
          <th class="w50">Durumu</th>
          <th class="w150">İşlem</th>
          </thead>
          <tbody class="sortable" data-url="<?= base_url("services/rankSetter") ?>">
          <?php foreach ($items as $item): ?>
            <tr id="ord-<?= $item->id ?>">
              <td class="text-center"><i class="fa fa-reorder"></i></td>
              <td class="text-center">#<?= $item->id ?></td>
              <td><?= $item->title ?></td>
              <td><?= $item->url ?></td>
              <td>
                <img src="<?= base_url("uploads/{$viewFolder}/$item->img_url") ?>"
                     alt="" width="40"
                     class="img-rounded">
              </td>
              <td>
                <input
                  class="isActive"
                  data-url="<?= base_url("services/isActiveSetter/$item->id") ?>"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= ($item->isActive) ? " checked" : null ?>
                />
              </td>
              <td>
                <button
                  data-url="<?= base_url("services/delete/$item->id") ?>"
                  class="btn btn-danger btn-xs btn-outline remove-btn">
                  <i class="fa fa-trash"></i>
                  Sil
                </button>
                <a href="<?= base_url("services/update_form/$item->id") ?>" class="btn btn-info btn-xs btn-outline"><i
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