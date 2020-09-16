<?php if (empty($item_images)): ?>
  <div class="alert alert-info text-center">
    <p>Bu portfolyoya ait resim bulunmamaktadır.</p>
  </div>
<?php else: ?>
  <table class="table table-bordered table-striped table-hover picture_list">
    <thead>
    <th class="w25"><i class="fa fa-reorder"></i></th>
    <th class="w25 text-center">#id</th>
    <th class="w50 text-center">Görsel</th>
    <th>Resim Adı</th>
    <th class="w50 text-center">Kapak</th>
    <th class="w50 text-center">Durum</th>
    <th class="w50 text-center">İşlem</th>
    </thead>
    <tbody class="sortable" data-url="<?= base_url("portfolios/imageRankSetter")  ?>">
    <?php foreach ($item_images as $item_image): ?>
      <tr id="ord-<?= $item_image->id ?>">
        <td><i class="fa fa-reorder"></i></td>
        <td class="text-center">#<?= $item_image->id ?></td>
        <td>
          <img width="30"
               src="<?= base_url("uploads/{$viewFolder}/$item_image->img_url") ?>"
               alt="<?= $item_image->img_url ?>" class="img-responsive">
        </td>
        <td><?= $item_image->img_url ?></td>
        <td class="text-center">
          <input
            class="isCover"
            data-url="<?= base_url("portfolios/isCoverSetter/$item_image->id/$item_image->portfolio_id") ?>"
            type="checkbox"
            data-switchery
            data-color="#ff5b5b"
            <?= ($item_image->isCover) ? " checked" : null ?>
          />
        </td>
        <td class="text-center">
          <input
            class="isActive"
            data-url="<?= base_url("portfolios/imageIsActiveSetter/$item_image->id") ?>"
            type="checkbox"
            data-switchery
            data-color="#10c469"
            <?= ($item_image->isActive) ? " checked" : null ?>
          />
        </td>
        <td class="text-center">
          <button
            data-url="<?= base_url("portfolios/imageDelete/$item_image->id/$item_image->portfolio_id") ?>"
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