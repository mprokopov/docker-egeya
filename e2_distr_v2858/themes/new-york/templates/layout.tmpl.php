<div class="common">




<div class="level">
<div class="header">

  <?php _X ('header-pre') ?>

  <div class="title">
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
  </div>

  <div class="intro">
    <span id="e2-blog-description"><?= $content['blog']['description'] ?></span>
  </div>

  <?php if ($content['frontpage?']) {?><?php } ?>
  
  <?php _X ('header-post') ?>

</div>
</div>




<div class="level">
<?php if ($content['notes']) { ?>
<div class="sidebar">
  
<div class="handle"></div>

<?php _X ('sidebar-pre') ?>

<div class="widget">
<?php _T_FOR ('tags-menu') ?>
</div>

<div class="widget">
<?php _T_FOR ('favourites') ?>
</div>

<div class="widget">
<?php _T_FOR ('most-commented') ?>
</div>

<?php if ($content['class'] != 'found') { ?>
<div class="widget">
  <div class="spotlight">
    <?php _T_FOR ('search') ?>
  </div>
</div>
<?php } ?>

<a class="e2-rss" href="<?=@$content['blog']['rss-href']?>"><?= _S ('gs--rss') ?></a>

<?php _X ('sidebar-post') ?>

</div>
<?php } ?>
<div class="content">

<?php _T ('message') ?>
<?php _T ('heading') ?>

<?php _T ('welcome') ?>
<?php _T ('notes') ?>
<?php _T ('drafts') ?>
<?php _T ('notes-list') ?>
<?php _T ('tags') ?>
<?php _T ('sessions') ?>
<?php _T ('pages') ?>
<?php _T ('comments') ?>
<?php _T ('unsubscribe') ?>
<?php _T ('form') ?>

</div>
</div>

<div class="level">
<div class="footer">
<?php _X ('footer-pre') ?>
© <span id="e2-blog-author"><?= @$content['blog']['author'] ?></span>, <?=$content['blog']['years-range']?> 
<?php # please do not remove: #?>
<div class="engine">
<?=$content['engine']['about']?>
<?php if ($content['sign-in']['done?']) { ?>
&nbsp;&nbsp;&nbsp;
<span title="<?= _S ('gs--pgt') ?>"><?=$content['engine']['pgt']?> <?= _S ('gs--seconds-contraction') ?></span>
<?php } ?>
</div>

<?php _X ('footer-post') ?>
</div>
</div>




</div>