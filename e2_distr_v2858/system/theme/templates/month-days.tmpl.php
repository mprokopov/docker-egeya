<div class="e2-month-days">

<?php foreach ($content['month-days'] as $day): ?>

<?php if ($day['this?']): ?>
<span class="e2-month-day e2-month-day-current"><?= _DT ('j', $day['start-time']) ?></span>
<?php elseif ($day['fruitful?']): ?>
<span class="e2-month-day"><a href="<?= $day['href'] ?>"><?= _DT ('j', $day['start-time']) ?></a></span>
<?php else: ?>
<span class="e2-month-day e2-period-unavailable"><?= _DT ('j', $day['start-time']) ?></span>
<?php endif; ?>

<?php endforeach ?>

</div>