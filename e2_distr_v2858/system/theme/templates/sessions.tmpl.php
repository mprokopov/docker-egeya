<?php if (count ($content['sessions']['each'])): ?>

<div class="e2-text">

<p><?= _S ('gs--sessions-description') ?></p>

<table>

<thead>
<tr>
  <th><?= _S ('gs--sessions-browser-or-device') ?></th>
  <th><?= _S ('gs--sessions-when') ?></th>
  <th><?= _S ('gs--sessions-from-where') ?></th>
  <th></th>
<tr>
</thead>

<tbody>
<?php foreach ($content['sessions']['each'] as $session): ?>
<tr>
  <td><span title="<?= $session['user-agent'] ?>"><?= $session['title'] ?></span></td>
  <td><span title="<?=_DT ('j {month-g} Y, H:i', $session['opened'])?>"><?= _AGO ($session['opened']) ?></span></td>
  <td><?= $session['source'] ?></td>
  <td><?= $session['current?']? '•' : '' ?></td>
<tr>
<?php endforeach ?>
</tbody>

</table>

</div>

<?php endif ?>
