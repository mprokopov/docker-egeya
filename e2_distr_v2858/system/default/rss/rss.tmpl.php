<?= '<?xml version="1.0" encoding="utf-8"?>' ?> 
<rss version="2.0">

<channel>

<title><?= $content['title'] ?></title>
<link><?= $content['link'] ?></link>
<description><?= $content['description'] ?></description>
<generator><?= $content['generator'] ?></generator>

<?php # _T_FOR ('items') ?>
<?= $content['items'] ?>

</channel>

</rss>