<?php foreach ($content['drafts'] as $draft) { ?>

<div class="e2-draft-preview">
<a href="<?= $draft['href'] ?>" class="e2-admin-link nu">
  <div class="e2-draft-preview-box">
    <div class="e2-draft-preview-text">
    <?php if (array_key_exists ('image-href', $draft)) { ?>
      <img src="<?= $draft['image-href']?>" /><br />
    <?php } ?>
    <?= $draft['text-fragment']?>
    </div>
  </div>
  <u><?= $draft['title']?></u>
</a>
</div>

<?php } ?>