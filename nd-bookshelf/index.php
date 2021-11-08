<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$books = get_posts(['post_type' => 'book', 'posts_per_page' => 100]);
$pluginPath = plugin_dir_url(__FILE__);
?>
<!doctypehtml>
<html data-cookies-popup=true lang=en>
<head>
    <meta content="text/html; charset=UTF-8"http-equiv=Content-Type>
    <meta content="width=device-width,initial-scale=1"name=viewport>
    <title>BookShelf</title>
    <link href="<?= $pluginPath ?>assets/css/styles.css" rel=stylesheet>
    <link href="<?= $pluginPath ?>assets/css/themes/theme-bottle.css" rel=stylesheet id=theme>
    <link href="<?= $pluginPath ?>assets/css/shelf.css" rel=stylesheet>
    <link href="<?= $pluginPath ?>assets/css/book.css" rel=stylesheet>
    <link href="<?= $pluginPath ?>pflip/css/pdfflip.css" rel=stylesheet>
</head>
<body>
      <div class="row pt-50 theshelf" style="width:96%; margin:2%;">
        <?php $count = 0 ?>
        <?php foreach($books as $book){ ?>
            <div class="col-md-2 col-xs-6">
              <div class="book" style=width:172px;height:243px>
                <a class="_PDFF_link" id="PDFF_<?= $count ?>" backgroundimage="<?= $pluginPath ?>pflip/background.jpg" source="<?= get_field('pdf_file', $book->ID) ?>">
                    <?= get_the_post_thumbnail($book); ?>
                </a>
              </div>
            </div>
            <?php $count++; ?>
            <?php if($count % 6 === 0){ ?>
                    <div class="col-xs-12 shelf"></div>
            <?php }elseif($count % 2 === 0){ ?>
                    <div class="col-xs-12 shelf hidden-lg hidden-md"></div>
            <?php } ?>
        <?php } ?>
      </div>

<script src="<?= $pluginPath ?>assets/js/libs/utils.js"></script>
<script src="<?= $pluginPath ?>assets/js/plugins.js"></script>
<script src="<?= $pluginPath ?>assets/js/core.js"></script>
<script src="<?= $pluginPath ?>pflip/js/pdfflip.js"></script>
<script src="<?= $pluginPath ?>pflip/js/open.js"></script>
<!--<script src="<?/*= $pluginPath */?>settings.js"></script>-->
<!--<script src="<?/*= $pluginPath */?>toc.js"></script>-->
</body>
</html>
