<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Galeri Listesi
      <a href="<?= base_url("galleries/new_form") ?>" class="btn pull-right btn-outline btn-success btn-xs"><i
          class="fa fa-plus"></i> Yeni Ekle</a>
    </h4>
  </div>

  <div class="col-md-12">
    <div class="widget p-lg">
      <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri kaydı bulunmamaktadır. Eklemek için lütfen <a
              href="<?= base_url("galleries/new_form") ?>" class="">tıklayınız</a>.
          </p>
        </div>
      <?php else: ?>
        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th><i class="fa fa-reorder"></i></th>
          <th>#id</th>
          <th>Başlık</th>
          <th class="w100">Galeri Türü</th>
          <th>Klasör Adı</th>
          <th>url</th>
          <th class="w50">Durumu</th>
          <th class="w250">İşlem</th>
          </thead>
          <tbody class="sortable" data-url="<?= base_url("galleries/rankSetter") ?>">
          <?php foreach ($items as $item): ?>
            <tr id="ord-<?= $item->id ?>">
              <td><i class="fa fa-reorder"></i></td>
              <td>#<?= $item->id ?></td>
              <td><?= $item->title ?></td>
              <td><?= $item->gallery_type ?></td>
              <td><?= $item->folder_name ?></td>
              <td><?= $item->url ?></td>
              <td>
                <input
                  class="isActive"
                  data-url="<?= base_url("galleries/isActiveSetter/$item->id") ?>"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?= ($item->isActive) ? " checked" : null ?>
                />
              </td>
              <td>
                <button
                  data-url="<?= base_url("galleries/delete/$item->id") ?>"
                  class="btn btn-danger btn-xs btn-outline remove-btn">
                  <i class="fa fa-trash"></i>
                  Sil
                </button>
                <a href="<?= base_url("galleries/update_form/$item->id") ?>" class="btn btn-info btn-xs btn-outline"><i
                    class="fa fa-pencil-square-o"></i> Düzenle</a>
                <?php
                if ($item->gallery_type == "image") {
                  $button_image = "fa-picture-o";
                  $button_content = "Resimler";
                  $button_url = "galleries/uploadForm/$item->id";
                } else if ($item->gallery_type == "video") {
                  $button_image = "fa-play";
                  $button_content = "Videolar";
                  $button_url = "galleries/galleryVideoList/$item->id";
                } else if ($item->gallery_type == "file") {
                  $button_image = "fa-folder";
                  $button_content = "Dosyalar";
                  $button_url = "galleries/uploadForm/$item->id";
                }
                ?>
                <a href="<?= base_url($button_url) ?>" class="btn btn-purple btn-xs btn-outline"><i
                    class="fa <?= $button_image ?>"></i> <?= $button_content ?></a>

              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>