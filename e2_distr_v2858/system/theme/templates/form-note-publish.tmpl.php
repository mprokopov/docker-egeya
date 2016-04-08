<form
  action="<?= @$content['form-note-publish']['form-action'] ?>"
  method="post"
>

<input
  type="hidden"
  name="note-id"
  value="<?= @$content['form-note-publish']['.note-id'] ?>" 
/>

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

<div class="form">

<div class="form-control submit-box">
  <button type="submit" id="submit-button" class="button submit-button">
    <?= @$content['form-note-publish']['submit-text'] ?>
  </button>
</div>

</div>


</form>