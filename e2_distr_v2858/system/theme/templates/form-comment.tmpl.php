<?php _JS ('form-comment') ?>

<form
  action="<?=$content['form-comment']['form-action']?>"
  method="post"
  accept-charset="UTF-8"
  name="form-comment"
  id="form-comment"
>

<input
  type="hidden"
  name="note-id"
  value="<?= @$content['form-comment']['.note-id'] ?>"
/>

<input
  type="hidden"
  name="comment-id"
  value="<?= @$content['form-comment']['.comment-id'] ?>"
/>

<input
  type="hidden"
  name="from"
  value="<?= @$content['form-comment']['.from'] ?>"
/>

<input
  type="hidden"
  name="already-subscribed"
  value="<?= @$content['form-comment']['.already-subscribed?'] ?>"
/>

<div class="form">

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--full-name') ?></label></div>
  <div class="form-element">
    <input type="text"
      class="text required width-2"
      tabindex="1"
      id="name"
      name="name"
      value="<?= @$content['form-comment']['name'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--email') ?></label></div>
  <div class="form-element">
    <div style="position: relative">
      <?php /* a pot full of honey for spammers: */ ?>
      <div style="position: absolute; z-index: 0; left: 0; top: 0">
      <input type="text"
        class="text width-2"
        style="outline: none"
        tabindex="-1"
        name="email"
        autocomplete="off"
        value=""
      />
      </div>
      <div style="position: relative; z-index: 1; left: 0; top: 0">
      <?php /* real input */ ?>
      <input type="text"
        class="text required width-2"
        tabindex="2"
        id="email"
        name="<?= $content['form-comment']['email-field-name'] ?>"
        value="<?= @$content['form-comment']['email'] ?>"
      />
      </div>
    </div>
    <div class="form-control-sublabel">
      <?= $content['form-comment']['create:edit?']? (_S ('gs--email-wont-be-published') .'<br />') : ''?>
    </div>
  </div>
</div>

<div class="form-control">
  <div class="form-label">
    <p><label><?= _S ('ff--text') ?></label></p>
  </div>
  <div class="form-element">
    <textarea name="text"
      class="required full-width"
      id="text"
      tabindex="3"
      style="height: 16.7em; overflow-x: hidden; overflow-y: visible"
    ><?=$content['form-comment']['text']?></textarea>
    <div class="form-control-sublabel">
      <?= $content['form-comment']['create:edit?']? (_S ('gs--no-html') .'<br />') : ''?>
    </div>
  </div>
</div>

<?php if ($content['form-comment']['show-subscribe?']) { ?>
<div class="form-control">
  <div class="form-element">
    <label class="checkbox">
    <input
      type="checkbox"
      name="subscribe"
      class="checkbox"
      tabindex="4"
      <?= @$content['form-comment']['subscribe?']? ' checked="checked"' : ''?>
    />&nbsp;<?= _S ('ff--subscribe-to-others-comments') ?>
    </label><br />
  </div>
</div>
<?php } ?> 

<?php if (array_key_exists ('subscription-status', $content['form-comment'])) { ?>
<div class="form-control">
  <div class="form-element">
    <p><?= $content['form-comment']['subscription-status'] ?></p>
  </div>
</div>
<?php } ?>


<div class="form-control submit-box">
  <div class="form-element">
  <button type="submit" id="submit-button" class="button submit-button" tabindex="5">
    <?= @$content['form-comment']['submit-text'] ?>
  </button><span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>

</div>

</form>