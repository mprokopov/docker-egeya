<?php // mui ?>

<a id="e2-check-password-action" href="<?= $content['form-login']['form-check-password-action'] ?>"></a>
  
<div
  class="
    e2-login-sheet
    <?php if (!$content['sign-in']['necessary?']) { ?>e2-hideable<?php } ?>
    <?= $content['sign-in']['necessary?']? 'e2-show' : '' ?>
  "
  id="e2-login-sheet"
  <?php //= $content['sign-in']['necessary?']? '' : 'style="visibility: hidden"' ?>
>

<div class="e2-glass"></div>

<div class="e2-login-sheet-guts">

<form
  action="<?= $content['form-login']['form-action'] ?>"
  method="post"
  class="form-login e2-enterable"
  id="form-login"
>

<input type="text" name="login" value="<?= $content['form-login']['login-name'] ?>" style="display: none" />

<table width="100%" cellpadding="0" cellspacing="0" border="0">

<tr height="4">
	<td width="40" rowspan="7">&nbsp;</td><td></td>
	<td width="10" rowspan="7">&nbsp;</td><td></td>
	<td width="80" rowspan="7">&nbsp;</td>
</tr>

<tr height="10">
	<td></td>
	<td>
    <?php _T ('message') ?>
    <?php if (array_key_exists ('sign-in-prompt', $content)) { ?>
      <h1><?= $content['sign-in-prompt'] ?></h1>
    <?php } ?>
    <?php if ($content['sign-in']['necessary?']): ?>
        <!--
        <p><?= _A ('<a href="'. $content['blog']['href']. '">'. _S ('gs--frontpage') .'</a>') ?></p>
        -->
    <?php endif ?>
  </td>
</tr>

</div>

<tr valign="middle">
	<td style="padding: 4px 10px"><span class="i-lock"></span></td>
	<td class="form-control">
    <div>
      <input type="password" name="password" id="e2-password" class="text big input-disableable" autofocus="autofocus" style="width: 100%" />
    </div>
    <div>
      <label><input type="checkbox"
        class="checkbox input-disableable"
        name="is_public_pc"
        id="is_public_pc"
        <?= $content['form-login']['public-pc?']? ' checked="checked"' : '' ?>
      />&nbsp;<?= _S ('ff--public-computer') ?></label>
    </div>
  </td>
</tr>

<tr height="8"></tr>

<tr>
	<td>&nbsp;</td>
	<td>
	  <button type="submit" id="login-button" class="button submit-button input-disableable">
      <?= _S ('fb--sign-in') ?>
    </button>
    &nbsp;&nbsp;&nbsp;
    <span id="password-checking" class="i-loading" style="display: none"></span><span id="password-correct" class="i-tick" style="display: none"></span>
	</td>
</tr>

</table>
</form>

</div>

</div>