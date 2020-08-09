<?php if (empty($items)): ?>
  <div class="alert alert-info text-center">
    <p>Bu ürüne ait resim bulunmamaktadır.</p>
  </div>
<?php else: ?>
  <table class="table table-bordered table-striped table-hover picture_list">
    <thead>
    <th class="w25"><i class="fa fa-reorder"></i></th>
    <th class="w25 text-center">#id</th>
    <th class="w50 text-center">Görsel</th>
    <th>Dosya Yolu ve Adı</th>
    <th class="w50 text-center">Durum</th>
    <th class="w50 text-center">İşlem</th>
    </thead>
    <tbody class="sortable" data-url="<?= base_url("galleries/imageRankSetter") ?>">
    <?php foreach ($items as $item): ?>
      <tr id="ord-<?= $item->id ?>">
        <td><i class="fa fa-reorder"></i></td>
        <td class="text-center">#<?= $item->id ?></td>
        <td>
          <?php if ($gallery_type == "image"): ?>
            <img width="30"
                 src="<?= base_url("$item->url") ?>"
                 alt="<?= $item->url ?>" class="img-responsive">
          <?php elseif ($gallery_type == "file"): ?>
            <i class="fa fa-folder fa-2x" style="color: #fbbd08"></i>
          <?php endif; ?>
        </td>
        <td><?= $item->url ?></td>
        <td class="text-center">
          <input
            class="isActive"
            data-url="<?= base_url("galleries/imageIsActiveSetter/$item->id") ?>"
            type="checkbox"
            data-switchery
            data-color="#10c469"
            <?= ($item->isActive) ? " checked" : null ?>
          />
        </td>
        <td class="text-center">
          <button
            data-url="<?= base_url("galleries/imageDelete/$item->id/$item->gallery_id") ?>"
            class="btn btn-danger btn-xs btn-outline remove-btn">
            <i class="fa fa-trash"></i>
            Sil
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>