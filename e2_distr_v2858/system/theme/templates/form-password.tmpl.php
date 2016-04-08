<?php _JS ('form-password') ?>

<form
  action="<?= @$content['form-password']['form-action'] ?>"
  method="post"
  class="e2-enterable"
>

<div class="form">

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--old-password') ?></label></div>
  <div class="form-element">
    <input type="password"
      class="text required width-2"
      autofocus="autofocus"
      id="old-password"
      name="old-password"
      value=""
    />
  </div>
</div>


<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--new-password') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text required width-2"
      id="new-password"
      name="new-password"
      value=""
    />
    <div class="form-control-sublabel">
      <?= _S ('ff--displayed-as-plain-text') ?>
    </div>
  </div>
</div>


<div class="form-control">
  <div class="form-element">
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-password']['submit-text'] ?>
  </button>
  </div>
</div>

</div>

</form>
