<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?= $galleryDetail->title ?></b> galerisine ait videolar
      <a href="<?= base_url("galleries/newGalleryVideoForm/$galleryDetail->id") ?>" class="btn pull-right btn-outline btn-success btn-xs"><i
          class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
              href="<?= base_url("galleries/newGalleryVideoForm/$galleryDetail->id") ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th class="w25"><i class="fa fa-reorder"></i></th>
          <th class="w25">#id</th>
          <th class="">Görsel</th>
          <th class="w50">Durumu</th>
          <th class="w150">İşlem</th>
          </thead>
          <tbody class="sortable" data-url="<?= base_url("galleries/rankGalleryVideoSetter") ?>">
          <?php foreach ($items as $item): ?>
            <tr id="ord-<?= $item->id ?>">
              <td class="text-center"><i class="fa fa-reorder"></i></td>
              <td class="text-center">#<?= $item->id ?></td>
              <td>
                <iframe class="img-rounded" width="200" height="180"
                        src="https://www.youtube.com/embed/<?= $item->url ?>" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
              </td>
              <td>
                <input
                  class="isActive"
                  data-url="<?= base_url("galleries/galleryVideoIsActiveSetter/$item->id") ?>"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= ($item->isActive) ? " checked" : null ?>
                />
              </td>
              <td>
                <button
                  data-url="<?= base_url("galleries/galleryVideoDelete/$item->id/$item->gallery_id") ?>"
                  class="btn btn-danger btn-xs btn-outline remove-btn">
                  <i class="fa fa-trash"></i>
                  Sil
                </button>
                <a href="<?= base_url("galleries/updateGalleryVideoForm/$item->id") ?>" class="btn btn-info btn-xs btn-outline"><i
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