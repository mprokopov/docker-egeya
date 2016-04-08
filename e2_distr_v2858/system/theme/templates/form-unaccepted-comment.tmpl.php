<form
  accept-charset="UTF-8"
>

<div class="form">

<div class="form-control">
  <div class="form-element">
    <p><?= $content['form-unaccepted-comment']['reason']?></p>
  </div>
</div>


<div class="form-control">
  <div class="form-label"><label><?= _S ('ff--text-of-your-comment') ?></label></div>
  <div class="form-element">
    <textarea class="full-width"
      style="height: 16.7em; overflow-x: hidden; overflow-y: visible"
      autofocus="autofocus"
      readonly="true"
    ><?=$content['form-unaccepted-comment']['text']?></textarea>
  </div>
</div>

</div>

</form>