<div role="tabpanel" class="tab-pane fade" id="tab-2">
  <div class="form-group">
                <textarea
                  class="m-0"
                  data-plugin="summernote"
                  data-options="{height: 250}"
                  name="address"><?= isset($form_error) ? set_value("fax_2") : $item->address ?></textarea>
  </div>
</div>