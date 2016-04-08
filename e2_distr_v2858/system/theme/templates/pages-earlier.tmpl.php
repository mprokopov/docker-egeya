<?php // mui ?>

<?php if ($content['pages']['earlier-href'] and $content['pages']['earlier-title']): ?>

<div class="e2-pages">
  <?php if ($content['pages']['earlier-jump?']) { ?>...<br /><?php } ?>
  <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('navigation-earlier') ?></span>
  <a href="<?= $content['pages']['earlier-href'] ?>"><?= $content['pages']['earlier-title'] ?></a><br />
</div>

<?php endif ?>
