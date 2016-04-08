<div style="margin: 20px 60px">




<br /><br /><br />




<?php _X ('header-pre') ?>
<?php _X ('sidebar-pre') ?>
<?php _T ('user-picture') ?>

<h1>
  <?= _A ('<a href="'. $content['blog']['href']. '"><span id="e2-blog-title">'. $content['blog']['title']. '</span></a>') ?> 
  <?php 
    if (
      array_key_exists ('admin-hrefs', $content)
      and array_key_exists ('name-and-author', $content['admin-hrefs'])
      and !_AT ($content['admin-hrefs']['name-and-author'] )
    ) { 
  ?>
    <a href="<?= $content['admin-hrefs']['name-and-author'] ?>" class="nu"><span class="i-edit-small"></span></a>
  <?php } ?>
</h1>

<?php if ($content['frontpage?']) {?>
<p><span id="e2-blog-description"><?= $content['blog']['description'] ?></span></p>
<?php } ?>

<?php _T_FOR ('tags-menu') ?>
<?php _T_FOR ('favourites') ?>
<?php _T_FOR ('most-commented') ?>
<?php _T_FOR ('search') ?>
<a class="e2-rss" href="<?=@$content['blog']['rss-href']?>"><?= _S ('gs--rss') ?></a>

<?php _X ('sidebar-post') ?>
<?php _X ('header-post') ?>




<br /><br /><br />




<?php _T ('message') ?>
<?php _T ('heading') ?>




<br /><br /><br />




<?php _T ('welcome') ?>
<?php _T ('notes') ?>
<?php _T ('drafts') ?>
<?php _T ('notes-list') ?>
<?php _T ('tags') ?>
<?php _T ('sessions') ?>
<?php _T ('pages') ?>
<?php _T ('comments') ?>
<?php _T ('popular') ?>
<?php _T ('unsubscribe') ?>
<?php _T ('form') ?>




<br /><br /><br />




<?php _X ('footer-pre') ?>
© <span id="e2-blog-author"><?= @$content['blog']['author'] ?></span>, <?=$content['blog']['years-range']?> 
<?=$content['engine']['about']?>
<?php if ($content['sign-in']['done?']) { ?>
&nbsp;&nbsp;&nbsp;
<span title="<?= _S ('gs--pgt') ?>"><?=$content['engine']['pgt']?> <?= _S ('gs--seconds-contraction') ?></span>
<?php } ?>

<?php _X ('footer-post') ?>




</div>