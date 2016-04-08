<?php // mui ?>

<?php if ($content['pages']['later-href'] and $content['pages']['later-title']): ?>

<div class="e2-pages">
  <span class="e2-keyboard-shortcut"><?= _SHORTCUT ('navigation-later') ?></span>
  <a href="<?= $content['pages']['later-href'] ?>"><?= $content['pages']['later-title'] ?></a><br />
  <?php if ($content['pages']['later-jump?']) { ?>...<br /><?php } ?>
</div>

<?php endif ?>