<?php if (array_key_exists ('tags', $content)) { ?>

<?php if ($content['tags']['many?']) { ?>

<?php _JS ('tags') ?>

<?php /* js uses
    #e2-tag-slide - for the shaft
    #e2-tag-slider - for the lift
*/?>

<div class="e2-tag-filter" id="e2-tag-filter">
<?= _S ('gs--tags-important') ?><span id="e2-tag-slide-area" class="e2-tag-filter-slide-area"><span id="e2-tag-slide" class="e2-tag-filter-slide">
  <div class="e2-tag-filter-slide-shaft">
    <div id="e2-tag-slider" class="e2-tag-filter-slider" style="display: none"><span></span></div>
  </div>
</span></span><?= _S ('gs--tags-all') ?>
</div>

<?php } ?>

<?php /* js uses
    .e2-tag-weight-X - for tags with specific weight
*/?>

<div class="e2-tags">
<?php foreach ($content['tags']['each'] as $tag): ?>
<span class="e2-tag-weight-<?= 1 + (int) ($tag['weight'] * 99)?>">
<a
  href="<?=@$tag['href']?>"
  class="e2-tag"
  style="opacity: <?= 0.2 + 0.8 * pow ($tag['weight'], 0.7) ?>"
  <?php if ($tag['weight'] == 0): ?> class="e2-tag-disused" <?php endif ?>
><?=@$tag['tag']?></a>
</span>
<?php endforeach ?>
</div>

<?php } ?>
