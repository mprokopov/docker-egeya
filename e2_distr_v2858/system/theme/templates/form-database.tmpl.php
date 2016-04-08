<form
  action="<?= @$content['form-database']['form-action'] ?>"
  method="post"
>

<div class="form">

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-host') ?></label>
  </div>
  <div class="form-element">
    <input type="text"
      autofocus="autofocus"
      name="db-server"
      id="db-server"
      class="text input-editable width-2"
      value="<?= @$content['form-database']['db-server'] ?>"
    />
  </div>
</div>

<div class="form-control">

  <div class="form-label input-label">
    <label><?= _S ('ff--db-username-and-password') ?></label>
  </div>

  <div class="form-element">
    <input type="text"
      name="db-user"
      id="db-user"
    class="text input-editable width-2"
      value="<?= @$content['form-database']['db-user'] ?>"
    />
  </div>

  <div class="form-element">
    <input type="text"
      name="db-password"
      id="db-password"
    class="text input-editable width-2"
      value="<?= @$content['form-database']['db-password'] ?>"
    />
  </div>
  
</div>

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-name') ?></label>
  </div>
  <div class="form-element">
    <input type="text"
      name="db-database"
      id="db-database"
      class="text input-editable width-2"
      value="<?= @$content['form-database']['db-database'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-label input-label">
    <label><?= _S ('ff--db-prefix') ?></label>
  </div>
  <div class="form-element">
    <input type="text"
      name="db-prefix"
      id="db-prefix"
      class="text input-editable width-1"
      value="<?= @$content['form-database']['db-prefix'] ?>"
    />
  </div>
</div>

<div class="form-control">
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-database']['submit-text'] ?>
    </button>
  </div>
</div>

</div>


</form>