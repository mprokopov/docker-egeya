<form
  action="<?= @$content['form-timezone']['form-action'] ?>"
  method="post"
>            

<div class="form">

<div class="form-control">
  <div class="form-element">
    <div class="form-control-sublabel">
      <p><?= _S ('gs--e2-stores-each-posts-timezone') ?></p>
      <p><?= _S ('gs--e2-autodetects-timezone') ?></p>
    </div>
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label"><label><?= _S ('ff--gmt-offset') ?></label></div>
  <div class="form-element">
    <div>
      <?= $content['form-timezone']['timezone-selector'] ?>
    </div>
    
    <div>
      <label class="checkbox">
      <input type="checkbox"
        name="is_dst" 
        <?= @$content['form-timezone']['dst?']? ' checked="checked"' : '' ?>
      />&nbsp;<?= _S ('ff--with-dst') ?></label><br />
    </div>
    
  </div>
</div>


<div class="form-control">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-timezone']['submit-text'] ?>
    </button>
  </div>
</div>

</div>

</form>