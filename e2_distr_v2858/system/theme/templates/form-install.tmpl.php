<?php _JS ('form-install') ?>
<?php _CSS ('install') ?>

<?php if ($content['form-install']['installation-possible?']) { ?>

<div class="e2-glass" style="display: none">
<div class="e2-glass-text">
  <h1><?= _S ('pt--installer-loading') ?></h1>
</div>
</div>

<script>if ($) $ ('.e2-glass').show () </script>

<?php } ?>

<div class="installer">

<div class="form-control">
  <div class="form-element">
    <h1>
      <?php if (array_key_exists ('heading', $content)): ?>
      <?= $content['heading'] ?>
      <?php endif ?>
    </h1>
  </div>
</div>

<div class="form-control">
  <div class="form-element">
     <?php _T ('message') ?>
  </div>
</div>

<?php if ($content['form-install']['installation-possible?']) { ?>

<form
  id="form-install"
  action="<?= @$content['form-install']['form-action'] ?>"
  method="post"
>

<div class="form">

<input
  type="hidden"
  id="gmt-offset"
  name="gmt-offset"
  value="unknown"
/>

<script>
d = new Date ()
document.getElementById ('gmt-offset').value = - d.getTimezoneOffset()
</script>

<a id="e2-check-db-config-action" href="<?= $content['form-install']['form-check-db-config-action'] ?>"></a>
<a id="e2-list-databases-action" href="<?= $content['form-install']['form-list-databases-action'] ?>"></a>

<div class="form-part">

<div class="form-control">
  <div class="form-element">
    <h3><?= _S ('gs--database') ?></h3>
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-host')?></label>
  </div>
  <div class="form-element">
    <div class="icon">
      <span class="i-loading ajaxload" id="db-server-checking" style="display: none"></span>
    </div>
    <input type="text"
      autofocus="autofocus"
      name="db-server"
      id="db-server"
      class="text input-editable livecheckable db-server-ok db-user-password-ok db-database-ok db-everything-ok width-3"
      value="<?= @$content['form-install']['db-server'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-username-and-password')?></label>
  </div>
  <div class="form-element">
    <div class="icon">
      <span class="i-loading ajaxload" id="db-user-checking" style="display: none"></span>
    </div>
    <input type="text"
      name="db-user"
      id="db-user"
      class="text input-editable livecheckable db-user-password-ok db-database-ok db-everything-ok width-2"
      value="<?= @$content['form-install']['db-user'] ?>"
    />
    <div class="icon">
      <span class="i-loading ajaxload" id="db-password-checking" style="display: none"></span>
    </div>
    <input type="text"
      name="db-password"
      id="db-password"
      class="text input-editable livecheckable db-user-password-ok db-database-ok db-everything-ok width-2"
      value="<?= @$content['form-install']['db-password'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-name')?></label>
  </div>
  <div class="form-element">
    <div class="icon">
      <span class="i-loading ajaxload" id="db-database-checking" style="display: none"></span><span class="i-loading ajaxload" id="db-database-list-checking" style="display: none"></span>
    </div>
    <input type="text"
      name="db-database"
      id="db-database"
      class="text input-editable livecheckable db-database-ok db-everything-ok width-2"
      value="<?= @$content['form-install']['db-database'] ?>"
    />
    <select id="db-database-list" name="db-database-selected"
      class="livecheckable verified db-database-ok db-everything-ok width-2"
      style="display: none" size="1">
    </select>
  </div>
  <div class="form-element">
    <label class="checkbox">
    <input
      type="checkbox"
      id="db-exists"
      name="db-exists"
      class="checkbox"
      <?= @$content['form-install']['db-exists?']? ' checked="checked"' : ''?>
    />&nbsp;<?= _S ('ff--just-connect')?>
    </label><br />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-prefix')?></label>
  </div>
  <div class="form-element">
    <div class="icon">
      <span class="i-loading ajaxload" id="db-prefix-checking" style="display: none"></span>
    </div>
    <input type="text"
      name="db-prefix"
      id="db-prefix"
      class="text input-editable livecheckable db-everything-ok width-1"
      value="<?= @$content['form-install']['db-prefix'] ?>"
    />
    <span class="input-remark e2-wrong" id="db-prefix-occupied" style="display: none"><?= _S ('ff--prefix-occupied')?></span>
    <span class="input-remark e2-wrong" id="db-prefix-not-found" style="display: none"><?= _S ('ff--tables-not-found')?></span>
  </div>
</div>

</div>

<div class="form-part">

<div class="form-control">
  <div class="form-element">
    <h3><?= _S ('gs--password-for-blog') ?></h3>
  </div>
</div>

<div class="form-control">
  <div class="form-element">
    <div class="icon"><span class="i-lock-mini"></span></div>
    <input type="text" class="text input-editable width-2" name="password" id="password"
    />
  </div>
</div>

<div class="form-control submit-box">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-install']['submit-text'] ?>
    </button>
    <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>

</div>

</div>


</div>

</form>

<?php } else { ?>

<form>

<div class="form">
  
<div class="form-control">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-install']['retry-text'] ?>
    </button>
  </div>
</div>

</div>

</form>

<?php } ?>

</div>