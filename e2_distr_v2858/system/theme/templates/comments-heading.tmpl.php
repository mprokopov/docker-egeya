<?php // mui ?>

<?php if ($content['notes']['only']['comments-count']) { ?>

<div class="e2-section-heading">

<span id="e2-comments-count"><?= $content['notes']['only']['comments-count-text'] ?></span><?php if ($content['notes']['only']['new-comments-count'] == 1 and $content['notes']['only']['comments-count'] == 1) { ?>, <?= _S ('gs--comments-all-one-new') ?><?php } elseif ($content['notes']['only']['new-comments-count'] == $content['notes']['only']['comments-count']) { ?>, <?= _S ('gs--comments-all-new') ?><?php } elseif ($content['notes']['only']['new-comments-count']) { ?> · <span class="admin-links"><a href="<?=$content['current-href']?>#new" class="e2-pseudolink"><?= $content['notes']['only']['new-comments-count-text'] ?></a></span>
<?php } ?>

</div>

<?php } ?>