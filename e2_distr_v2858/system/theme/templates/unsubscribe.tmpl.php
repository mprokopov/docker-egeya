<?php if (array_key_exists ('unsubscribe', $content)) { ?>

<?php if ($content['unsubscribe']['success?']) { ?>

<h2><?= _S ('pt--unsubscription-done') ?></h2>
<p><?= _S ('gs--you-are-no-longer-subscribed') ?> <a href="<?= $content['unsubscribe']['note-href'] ?>"><?= $content['unsubscribe']['note-title'] ?></a>.</p>

<?php } else { ?>

<h2><?= _S ('pt--unsubscription-failed') ?></h2>
<p><?= $content['unsubscribe']['error-message'] ?></p>

<?php } ?>

<?php } ?>