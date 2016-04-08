<?php // mui ?>

<form
  action="<?= @$content['form-tag-delete']['form-action'] ?>"
  method="post"
>

<input
  type="hidden"
  name="tag-id"
  value="<?= @$content['form-tag-delete']['.tag-id'] ?>" 
/>


<div class="form">

<div class="form-control delete-box">
  <div class="form-element e2-text">
    <p><?= @$content['form-tag-delete']['caution-text'] ?></p>
  </div>

  <div class="form-element">
    <button type="submit" id="submit-button" class="button submit-button">
      <?= @$content['form-tag-delete']['submit-text'] ?>
    </button>
  </div>

</div>

</div>

</form>






