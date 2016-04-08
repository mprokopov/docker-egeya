<?php _LIB ('ajaxupload') ?>

<?php _JS ('form-note') ?>

<form
  id="form-note"
  action="<?=$content['form-note']['form-action']?>"
  enctype="multipart/form-data" 
  method="post"
  accept-charset="utf-8"
  autocomplete="off"
>

<input
  type="hidden"
  id="note-id"
  name="note-id"
  value="<?= @$content['form-note']['.note-id'] ?>"
/>

<input
  type="hidden"
  id="formatter-id"
  name="formatter-id"
  value="<?= @$content['form-note']['.formatter-id'] ?>"
/>

<input
  type="hidden"
  name="from"
  value="<?= @$content['form-note']['.from'] ?>"
/>

<input
  type="hidden"
  name="old-tags-hash"
  value="<?= @$content['form-note']['.old-tags-hash'] ?>"
/>

<input
  type="hidden"
  name="old-stamp"
  value="<?= @$content['form-note']['stamp-formatted'] ?>" 
/>

<input
  type="hidden"
  id="action"
  name="action"
  value="<?= @$content['form-note']['.action'] ?>"
/>

<input
  type="hidden"
  id="instant-publish"
  name="instant-publish"
  value="<?= @$content['form-note']['.instant-publish'] ?>"
/>

<input
  type="hidden"
  id="browser-offset"
  name="browser-offset"
  value="unknown"
/>

<script>
d = new Date ()
document.getElementById ('browser-offset').value = - d.getTimezoneOffset()
</script>

<a id="e2-note-livesave-action" href="<?= $content['form-note']['form-note-livesave-action'] ?>"></a>
<a id="e2-file-upload-action" href="<?= $content['form-note']['form-file-upload-action'] ?>"></a>
<a id="e2-file-remove-action" href="<?= $content['form-note']['form-file-remove-action'] ?>"></a>

<div class="form" id="e2-note-form-wrapper">

<div class="form-control">

  <div class="form-subcontrol">
    <div class="form-label input-label">
      <label><?= _S ('ff--title') ?></label>
    </div>
    <div class="form-element">
      <input type="text"
        class="text big required unedited width-4 e2-smart-title"
        autocomplete="off"
        autofocus="autofocus"
        tabindex="1"
        id="title"
        name="title"
        value="<?= @$content['form-note']['title'] ?>"
      />
    </div>
  </div>
  
  <div class="form-subcontrol">

    <div class="form-label input-label">
      <p><label><?= _S ('ff--text') ?></label></p>
      <p class="help"><a href="http://blogengine.ru/help/text/" target="_blank"><?= _S ('ff--text-formatting') ?></a>&nbsp;<span class="i-blank"></span></p>
      <p class="small">
        <span id="livesaving" style="display: none"><?= _S ('ff--saving') ?>... <span class="i-loading"></span></span>
        <span id="livesave-button" class="keyboard-shortcut e2-clickable-keyboard-shortcut" style="display: none"><?= _SHORTCUT ('livesave')? _SHORTCUT ('livesave') : _S ('ff--save') ?></span>
        <span id="livesave-error" style="color: #f00; font-weight: bold; display: none; padding: 0 .33em">!</span><br />
      </p>
    </div>
    
    <div class="form-element">
    <textarea name="text"
      class="required e2-note-text-textarea e2-external-drop-target full-width"
      id="text"
      autocomplete="off"
      tabindex="2"
      style="height: 25.2em; overflow-x: hidden; overflow-y: visible"
    ><?=$content['form-note']['text']?></textarea>

     <div id="e2-uploaded-image-prototype" class="e2-uploaded-image" style="display: none">
      <div style="position: relative">
          <a class="e2-uploaded-image-remover nu" href=""><span class="i-remove-pic"></span></a>
        <a class="e2-uploaded-image-preview" href="javascript:return(false)"><img src="" alt="" /></a>
      </div>
    </div>
    
    <div id="e2-uploaded-images">
    <?php foreach ($content['form-note']['images'] as $image) { ?>
      <div class="e2-uploaded-image"><span class="e2-uploaded-image-preview"><img src="<?= $image['thumb'] ?>" alt="<?= $image['name'] ?>" /></span></div>
    <?php } ?>
    </div>
    
    <p id="e2-upload-controls" class="e2-upload-controls admin-links" style="display: none"><a href="javascript:" id="e2-upload-button" class="nu"><span class="i-attach"></span></a><span id="e2-uploading" class="i-loading" style="display: none"></span><br /></p>

    <p class="e2-upload-error" id="e2-upload-error-images-only" style="clear: left; display: none"><?= _S ('er--images-only-supported') ?></p>
    <p class="e2-upload-error" id="e2-upload-error-cannot-create-thumbnail" style="clear: left; display: none"><?= _S ('er--cannot-create-thumbnail') ?></p>
    <p class="e2-upload-error" id="e2-upload-error-cannot-upload" style="clear: left; display: none"><?= _S ('er--cannot-upload') ?></p>

    </div>
    
  </div>
</div>


<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--tags') ?></label>
  </div>

  <div class="form-element">
    <select id="tags" name="tags[]" tabindex="3" class="width-4 chzn-select" multiple="multiple" data-placeholder=" " size="2">
      <?php foreach ($content['form-note']['tags-info'] as $tag) { ?>
        <option <?= $tag['selected?']? 'selected' : '' ?>><?= $tag['name'] ?></option>
      <?php } ?>
    </select><br />
    <?php _LIB ('chosen') ?>
    <?php _CSS ('chosen') ?>
  </div>
</div>


<?php if (@$content['form-note']['time'] or @$content['form-note']['alias']) { ?>

<div class="form-control">
  
  <div class="form-element">

    <div class="e2-note-time-and-url">
      <a href="javascript: return false" onclick="$ ('.e2-note-time-and-url').slideToggle(333); return false" class="e2-pseudolink e2-admin-link"><?php if (@$content['form-note']['note']['published?']) { ?><?= _S ('ff--is-at-address') ?><?php } else { ?><?= _S ('ff--will-get-address') ?><?php } ?> <?php if (@$content['form-note']['alias']) { ?>
      .../<?= @$content['form-note']['alias'] ?>/
      <?php } ?>
      <?php if (@$content['form-note']['time']) { ?>
      <span title="<?=_DT ('j {month-g} Y, H:i, {zone}', @$content['form-note']['time'])?>"><?= _AGO ($content['form-note']['time']) ?></span>
      <?php } ?>
      </a> 
    </div>
    
    <div class="e2-note-time-and-url" style="display: none">
  
      <div class="form-subcontrol">
        <input type="text"
          class="text required unedited width-2"
          autocomplete="off"
          tabindex="5"
          id="alias"
          name="alias"
          placeholder="<?= @$content['form-note']['alias-autogenerated'] ?>"
          value="<?= @$content['form-note']['alias'] ?>"
        />
      </div>
  
      <?php if (@$content['form-note']['time']) { ?>
  
      <div class="form-subcontrol">
        <input type="text"
          tabindex="6"
          class="text width-1"
          name="stamp"
          id="stamp"
          placeholder="<?= @$content['form-note']['stamp-formatted'] ?>"
          value="<?= @$content['form-note']['stamp-formatted'] ?>"
          oninput="$ (this).toggleClass ('input-error', ($ (this).val ().match (/^ *(\d{1,2})\.(\d{1,2})\.(\d{2}|\d{4}) +(\d{1,2})\:(\d{1,2})\:(\d{1,2}) *$/)) === null)"
        />
      </div>
      
      <?php } ?>
  
    </div>
  </div>
</div>

<?php } ?>

<div class="form-control submit-box">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button"  tabindex="10">
      <?= @$content['form-note']['submit-text'] ?>
    </button>
    <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('submit') ?></span>
  </div>
</div>



<div class="form-control">
  <div class="form-element e2-toolbar">
    <?php if (array_key_exists ('delete-href', $content['form-note'])) { ?>
      <a href="<?= @$content['form-note']['delete-href'] ?>" class="nu"><button type="button" class="button">
        <span class="i-remove"></span>
        <?= _S ('ff--delete') ?>...
      </button></a>
    <?php } ?>
  </div>
</div>

</div>


</form>


