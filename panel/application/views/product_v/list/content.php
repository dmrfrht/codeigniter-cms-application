<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Ürün Listesi
      <a href="<?= base_url("product/new_form")  ?>" class="btn pull-right btn-outline btn-success btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a href="<?= base_url("product/new_form")  ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered">
          <thead>
          <th>#id</th>
          <th>url</th>
          <th>Başlık</th>
          <th>Açıklama</th>
          <th>Durumu</th>
          <th>İşlem</th>
          </thead>
          <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td>#<?= $item->id ?></td>
              <td><?= $item->url ?></td>
              <td><?= $item->title ?></td>
              <td><?= $item->description ?></td>
              <td>
                <input
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= ($item->isActive) ? " checked" : null ?>
                />
              </td>
              <td>
                <a href="<?= base_url("product/delete/$item->id")  ?>" class="btn btn-danger btn-xs btn-outline"><i class="fa fa-trash"></i> Sil</a>
                <a href="<?= base_url("product/update_form/$item->id")  ?>" class="btn btn-info btn-xs btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>