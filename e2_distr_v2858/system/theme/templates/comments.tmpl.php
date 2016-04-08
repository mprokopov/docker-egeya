<?php if (array_key_exists ('comments', $content)) { ?>

<div class="e2-comments">

<?php if (!array_key_exists ('only', $content['comments'])) { ?>
<?php _T ('comments-heading'); ?>
<?php } ?>


<?php # THE COMMENTS # ?>

<?php foreach ($content['comments'] as $comment): ?>


<?php if ($comment['first-new?']) { ?><a name="new"></a><?php } ?>
      
<div class="e2-comment-and-reply">

<div class="<?= $comment['spam-suspect?']? 'e2-spam' : '' ?> <?= $comment['visible?']? '' : 'e2-hidden' ?>">

  <div class="e2-comment e2-comment-control-group">
    
    <div class="e2-comment-meta-area">
      
      <span
        class="e2-comment-author"
        title="<?= _DT ('j {month-g} Y, H:i, {zone}', $comment['time']) ?>"
      >
      <span class="e2-markable <?php if (@$comment['important?']) echo 'e2-marked' ?>"><?= @$comment['name'] ?></span>
      </span>
      
    
      <span class="e2-comment-actions">
        <?php if (array_key_exists ('important-toggle-href', $comment)): ?><a href="<?= $comment['important-toggle-href'] ?>" class="e2-important-toggle nu"><span class="i-important-<?= ($comment['important?']? 'set' : 'unset') ?>"></span></a><?php endif ?>
        <?php if (array_key_exists ('ip-href', $comment)) { ?><small><a href="<?=$comment['ip-href']?>" class="e2-admin-link"><?=$comment['ip']?></small></a><?php } ?>
      </span>

      
    </div>
  
    <div class="e2-comment-content-area">
  
      <div class="e2-comment-actions-removed admin-links" style="display: none">
  
      <?php if (array_key_exists ('removed-toggle-href', $comment)): ?>
      <a href="<?= $comment['removed-toggle-href'] ?>" class="e2-removed-toggle e2-pseudolink"><?= _S ('gs--comment-restore') ?></a>
      <?php endif; ?>
      
      </div>
      
      <div class="e2-comment-content e2-text">
      <?=@$comment['text']?>
    
      <?php if ($comment['visible?'] and !$comment['replying?'] and array_key_exists ('reply-href', $comment)): ?><a href="<?= $comment['reply-href'] ?>" class="nu"><span class="i-reply"></span></a><?php endif; ?><?php if (array_key_exists ('email', $comment)): ?><a href="mailto:<?=@$comment['email']?>" class="nu"><span class="i-email<?= (@$comment['subscriber?']? '-subscribed' : '') ?>"></span></a><?php endif; ?>
      </div>
        
    </div>

    <?php if (array_key_exists ('edit-href', $comment) or array_key_exists ('removed-toggle-href', $comment)): ?>
    <div class="e2-comment-control-area">
      <span class="e2-comment-secondary-controls e2-comment-actions">
        <?php if (array_key_exists ('edit-href', $comment)): ?><a href="<?= $comment['edit-href'] ?>" class="nu"><span class="i-edit-small"></span></a><?php endif ?><?php if (array_key_exists ('removed-toggle-href', $comment)): ?><a href="<?= $comment['removed-toggle-href'] ?>" class="e2-removed-toggle nu"><span class="i-remove"></span></a><?php endif ?>
      </span>
      <span class="i-loading e2-removed-toggling" style="display: none"></span>
    </div>
    <?php endif ?>
  
  </div>

  <?php if (@$content['form'] != 'form-comment-reply' and $comment['replied?']) { ?>

  <div class="e2-comment e2-comment-control-group e2-reply">

    <div class="e2-comment-meta-area">
      <div>
    
      <span
        class="e2-comment-author"
        title="<?= _DT ('j {month-g} Y, H:i, {zone}', @$comment['reply-time']) ?>"
      >
        <span class="e2-markable <?php if (@$comment['reply-important?']) echo 'e2-marked' ?>"><?= @$comment['author-name'] ?></span>
      </span>
  
      <span class="e2-comment-actions" style="margin-right: 16px">
        <?php if (array_key_exists ('reply-important-toggle-href', $comment)): ?><a href="<?= $comment['reply-important-toggle-href'] ?>" class="e2-important-toggle nu"><span class="i-important-<?= ($comment['reply-important?']? 'set' : 'unset') ?>"></span></a><?php endif ?>
      </span>
      
      </div>
    
    </div>
  
     
    <div class="e2-comment-content-area">

      <div class="e2-comment-actions-removed admin-links" style="display: none">
  
      <?php if (array_key_exists ('removed-reply-toggle-href', $comment)): ?>
      <a href="<?= $comment['removed-reply-toggle-href'] ?>" class="e2-removed-toggle e2-pseudolink"><small><?= _S ('gs--comment-restore') ?></small></a>
      <?php endif; ?>
      
      </div>
      
      <div class="e2-comment-content e2-text" <?= $comment['reply-visible?']? '' : 'style="display: none"' ?>>
      <?=@$comment['reply']?>
      </div>
  
    </div>
  
    <?php if (array_key_exists ('edit-reply-href', $comment) or array_key_exists ('removed-reply-toggle-href', $comment)): ?>
    <div class="e2-comment-control-area">
      <span class="e2-comment-secondary-controls e2-comment-actions">
        <?php if (array_key_exists ('edit-reply-href', $comment)): ?><a href="<?= $comment['edit-reply-href'] ?>" class="nu"><span class="i-edit-small"></span></a><?php endif; ?><?php if (array_key_exists ('removed-reply-toggle-href', $comment)): ?><a href="<?= $comment['removed-reply-toggle-href'] ?>" class="e2-removed-toggle nu"><span class="i-remove"></span></a><?php endif; ?>
      </span>
      <span class="i-loading e2-removed-toggling" style="display: none"></span>
    </div>
    <?php endif ?>
  
  </div>
  
  <?php } ?>
    
</div>

</div>

<?php endforeach ?>

</div>

<?php } ?>




<?php # OPEN / CLOSE # ?>

<?php if (array_key_exists ('comments-toggle', $content)) { ?>
<div class="e2-toolbar">
<a href="<?=$content['comments-toggle']['href']?>">
<button class="button"><?= $content['comments-toggle']['text'] ?></button>
</a>
</div>
<?php } ?>




<?php if (array_key_exists ('notes', $content)) { ?>
<?php if (array_key_exists ('only', $content['notes'])) { ?>
<?php if ($content['notes']['only']['can-be-commentable?']) { ?>
<?php if ($content['notes']['only']['commentable-now?']) { ?>

  <div class="e2-section-heading"><?= _S ('gs--your-comment') ?></div>

  <?php _T_FOR ('form-comment') ?>
  

<?php } else { ?>

  <div class="e2-section-heading"><span class="i-no-comments"></span></div>

<?php } ?>
<?php } ?>
<?php } ?>
<?php } ?>
