<?php

if (array_key_exists ('pages', $content)) {

	$larr = $rarr = '';
	
	if ($content['pages']['prev-href']) {
		$prev_link = '<a href="'. $content['pages']['prev-href'] .'">'. $content['pages']['prev-title'] .'</a>';
		if ($content['pages']['prev-jump?']) $prev_link = $prev_link .'   · · ·';
		$larr = '&larr;';
	} else {
		$prev_link = '<span class="unavailable">'. strip_tags ($content['pages']['prev-title']) .'</span>';
		$larr = '<span class="e2-page-unavailable">&larr;</span>';
	}
	
	if ($content['pages']['next-href']) {
		$next_link = '<a href="'. $content['pages']['next-href'] .'">'. $content['pages']['next-title'] .'</a>';
		if ($content['pages']['next-jump?']) $next_link = '· · ·   '. $next_link;
		$rarr = '&rarr;';
	} else {
		$next_link = '<span class="unavailable">'. strip_tags ($content['pages']['next-title']) .'</span>';
		$rarr = '<span class="e2-page-unavailable">&rarr;</span>';
	}
	
?>

<?php if (!@$content['pages']['timeline?']):?>
<?php if ($content['pages']['prev-title'] or $content['pages']['next-title']): ?>
<div class="e2-pages">
<div class="e2-pages-prev-next">

<div class="e2-pages-prev"><?= $prev_link ?></div><div class="e2-pages-between"><?= $larr ?><span class="e2-keyboard-shortcut"><?= _SHORTCUT ('navigation') ?></span><?= $rarr ?></div><div class="e2-pages-next"><?= $next_link ?></div>

</div>
</div>
<?php endif ?>
<?php endif ?>

<?php } ?>