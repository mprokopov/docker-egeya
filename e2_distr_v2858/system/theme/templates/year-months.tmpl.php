<div class="e2-year-months">

<?php foreach ($content['year-months'] as $month): ?>

<?php if ($month['fruitful?']): ?>
<span class="e2-year-month"><a href="<?= $month['href'] ?>"><?=  (_DT ('{month}', $month['start-time'])) ?></a></span>
<?php else: ?>
<span class="e2-year-month e2-period-unavailable"><?=  (_DT ('{month}', $month['start-time'])) ?></span>
<?php endif; ?> &nbsp;

<?php endforeach ?>

</div>