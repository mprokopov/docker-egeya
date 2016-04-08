<?php _JS ('form-name-and-author') ?>

<form
  action="<?= @$content['form-name-and-author']['form-action'] ?>"
  method="post"
>

<input
  type="hidden"
  id="e2-blog-title-default"
  name="blog-title-default"
  value="<?= @$content['form-name-and-author']['blog-title-default'] ?>"
/>

<input
  type="hidden"
  id="e2-blog-author-default"
  name="blog-author-default"
  value="<?= @$content['form-name-and-author']['blog-author-default'] ?>"
/>

<div class="form">

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--blog-title') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text big width-4"
      autofocus="autofocus"
      id="blog-title"
      name="blog-title"
      value="<?= $content['form-name-and-author']['blog-title'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--blog-description') ?></label></div>
  <div class="form-element">
    <textarea
      class="width-4"
      style="height: 6.66em; overflow-x: hidden; overflow-y: visible"
      id="blog-description"
      name="blog-description"
    ><?= @$content['form-name-and-author']['blog-description'] ?></textarea>
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--blog-author') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text width-2"
      id="blog-author"
      name="blog-author"
      value="<?= $content['form-name-and-author']['blog-author'] ?>"
    />
  </div>
</div>

<div class="form-control submit-box">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-name-and-author']['submit-text'] ?>
    </button>
    <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>


</div>

</form>