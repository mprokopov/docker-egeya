<?php if (!array_key_exists ('form', $content)) { ?>

<form
  id="e2-search"
  class="e2-enterable"
  action="<?= @$content['search']['form-action'] ?>"
  method="post"
  accept-charset="utf-8"
>

<div class="e2-search">

  <label class="e2-search-input">
    <input class="text" type="text" name="query" id="query"
      value="<?= @$content['search']['query'] ?>"
    />
  </label>
  <span class="e2-search-button">
    <button type="submit"><span class="i-enter"></span></button>
  </span>

</div>

</form>

<?php } ?>
