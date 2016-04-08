<?php if (_AT ($content['most-commented']['href'])): ?>

  <h2><?= $content['most-commented']['title'] ?> →</h2>

<?php else: ?>

  <h2><a href="<?= $content['most-commented']['href'] ?>"><?= $content['most-commented']['title'] ?></a></h2>

<?php endif ?>


<?php # if there's a list, show it #?>
<?php if (array_key_exists ('each', $content['most-commented'])): ?> 

<ul class="links-list">

  <?php foreach ($content['most-commented']['each'] as $item) { ?>
    <li><?php if ($item['current?']) { ?><?= $item['title'] ?> →<?php } else { ?><a href="<?= $item['href'] ?>" title="<?=_DT ('j {month-g} Y, H:i', $item['time'])?>"><?= $item['title'] ?></a><?php } ?></li>
  <?php } ?>

</ul>

<?php endif ?>
