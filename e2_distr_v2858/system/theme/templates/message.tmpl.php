<?php if (array_key_exists ('message', $content)) { ?>

<div class="e2-messages">

<?php foreach ($content['message']['each'] as $msg) { ?>

<?php 

  if ($msg['class']) {
    $class = ' e2-message-'. $msg['class'];
  } else {
    $class = '';
  }

?>

<div class="e2-message<?= $class ?> e2-text">
  <?php if ($msg['title']) { ?>
  <h2><?= @$msg['title']; ?></h2>
  <?php } ?>
  <?= @$msg['description'] ?>
  <?= @$msg['backtrace'] ?>
  
</div>
  
<?php } ?>

<?php if (array_key_exists ('debug-link', $content['message'])) { ?>
<div class="e2-message e2-text">
  <p><a href="<?= $content['message']['debug-link'] ?>">...</a></p>
</div>
<?php } ?>

</div>

<?php } ?>
