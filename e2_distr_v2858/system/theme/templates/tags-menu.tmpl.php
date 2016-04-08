<?php // mui ?>

<?php if (array_key_exists ('tags', $content['hrefs'])) { ?> 

<?php if ($content['tags-menu']['not-empty?']) { ?> 

<?php if (_AT ($content['hrefs']['tags'])): ?> 
<h2><?= _S ('gs--tags') ?> &rarr;</h2>
<?php else: ?>
<h2><a href="<?= $content['hrefs']['tags'] ?>"><?= _S ('gs--tags') ?></a></h2>
<?php endif ?>

<ul>
<?php foreach ($content['tags-menu']['each'] as $tag): ?>
<?php if ($tag['current?']) { ?>
<li><?=$tag['tag']?>
  <?php if ($tag['pinnable?']) { ?>
  <span style="white-space: nowrap"><a href="<?=$tag['pinned-toggle-href']?>" class="e2-tag e2-pinned-toggle nu"><span class="i-pinned-<?= ($tag['pinned?']? 'set' : 'unset') ?>"></span></a></span>
  <?php } ?>
  &rarr;
</li>
<?php } else { ?>
<li><a href="<?=@$tag['href']?>" class="e2-tag"><?=@$tag['tag']?></a></li>
<?php } ?>
<?php endforeach ?>
</ul>

<?php } else { ?>

<?php if (_AT ($content['hrefs']['tags'])): ?> 
<p><?= _S ('gs--tags') ?> &rarr;</p>
<?php else: ?>
<p><a href="<?= $content['hrefs']['tags'] ?>"><?= _S ('gs--tags') ?></a></p>
<?php endif ?>

<?php } ?>

<?php } ?>