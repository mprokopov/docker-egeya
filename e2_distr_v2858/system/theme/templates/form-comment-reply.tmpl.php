<form
  action="<?=$content['form-comment-reply']['form-action']?>"
  method="post"
  accept-charset="UTF-8"
  name="freply"
  id="freply"
>

<input
  type="hidden"
  name="note-id"
  value="<?= @$content['form-comment-reply']['.note-id'] ?>"
/>

<input
  type="hidden"
  name="comment-id"
  value="<?= @$content['form-comment-reply']['.comment-id'] ?>"
/>

<input
  type="hidden"
  name="reply-action"
  id="reply-action"
  value="<?= @$content['form-comment-reply']['.reply-action'] ?>"
/>

<div class="form">

<?php $comment = $content['comments']['only'] ?>

<div class="form-control e2-comment-control-group">
  <div class="form-label">
    <label>
      <span>
        <span class="e2-markable <?php if (@$comment['reply-important?']) echo 'e2-marked' ?>"><?= _S ('ff--text') ?></span>
      </span>
  
      <span style="margin-right: 16px; white-space: nowrap">
        <?php if (array_key_exists ('reply-important-toggle-href', $comment)): ?><a href="<?= $comment['reply-important-toggle-href'] ?>" class="e2-important-toggle nu"><span class="i-important-<?= ($comment['reply-important?']? 'set' : 'unset') ?>"></span></a><?php endif ?>
      </span>
      
    </label>
  </div>
  <div class="form-element">
    <textarea name="text"
      class="required full-width"
      autofocus="autofocus"
      id="text"
      style="height: 16.7em; overflow-x: hidden; overflow-y: visible"
    ><?=$content['form-comment-reply']['reply-text']?></textarea>
  </div>
</div>

<div class="form-control">
  <div class="form-element">
    <label class="checkbox">
    <input
      type="checkbox"
      class="checkbox"
      name="mail-back"
      <?= @$content['form-comment-reply']['mail-back?']? ' checked="checked"' : '' ?>
    />&nbsp;<?= _S ('ff--notify-subscribers') ?>
    </label><br />
  </div>
</div>


<div class="form-control submit-box">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-comment-reply']['submit-text'] ?>
    </button>
    <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>

</div>

</form>
