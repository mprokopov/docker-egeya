<form
  action="<?= @$content['form-note-delete']['form-action'] ?>"
  method="post"
>

<input
  type="hidden"
  name="note-id"
  value="<?= @$content['form-note-delete']['.note-id'] ?>" 
/>

<input
  type="hidden"
  name="is-draft"
  value="<?= @$content['form-note-delete']['.is-draft'] ?>" 
/>

<div class="form">

<div class="form-control delete-box">
  <div class="form-element e2-text">
    <p><?= @$content['form-note-delete']['caution-text'] ?></p>
  </div>
  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-note-delete']['submit-text'] ?>
    </button>
  </div>
</div>

</div>

</form>