<?php _JS ('form-tag') ?>

<form
  action="<?= @$content['form-tag']['form-action'] ?>"
  method="post"
>                                   

<input
  type="hidden"
  name="tag-id"
  value="<?= @$content['form-tag']['.tag-id'] ?>" 
/>

<div class="form">

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--tag-name') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text big required width-2"
      autofocus="autofocus"
      id="tag"
      name="tag"
      value="<?= @$content['form-tag']['tag'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--tag-urlname') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text required width-2"
      id="urlname"
      name="urlname"
      value="<?= @$content['form-tag']['urlname'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--tag-description') ?></label></div>
  <div class="form-element">
  <textarea name="description"
    class="width-4"
    id="text"
    style="height: 10em; overflow-x: hidden; overflow-y: visible"
  ><?=$content['form-tag']['description']?></textarea>
  </div>
</div>

<div class="form-control submit-box">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-tag']['submit-text'] ?>
    </button>
    <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>

<?php if (array_key_exists ('delete-href', $content['form-tag'])) { ?>

<div class="form-control">
  <div class="form-element e2-toolbar">
    <?php if (array_key_exists ('delete-href', $content['form-tag'])) { ?>
      <a href="<?= @$content['form-tag']['delete-href'] ?>" class="nu"><button type="button" class="button">
        <span class="i-remove"></span> <?= _S ('ff--delete') ?>...
      </button></a>
    <?php } ?>
  </div>
</div>

<?php } ?>

</div>

</form>

