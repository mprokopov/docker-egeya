<?php if (_AT ($content['favourites']['href'])): ?>

  <h2><?=$content['favourites']['title']?> &#9733; →</h2>

<?php else: ?>

  <h2><a href="<?= $content['favourites']['href'] ?>" class="nu"><u><?=$content['favourites']['title']?></u> &#9733;</a></h2>

<?php endif ?>


<?php # if there's a list, show it #?>
<?php if (array_key_exists ('each', $content['favourites'])): ?> 

<ul class="links-list">

  <?php foreach ($content['favourites']['each'] as $item) { ?>
    <li><?php if ($item['current?']) { ?><?= $item['title'] ?> →<?php } else { ?><a href="<?= $item['href'] ?>" title="<?=_DT ('j {month-g} Y, H:i', $item['time'])?>"><?= $item['title'] ?></a><?php } ?></li>
  <?php } ?>

</ul>

<?php endif ?>