<!DOCTYPE html>
<html>
	<head>
		<title><?= $site_title ?></title>
		<meta name="keywords" content="<?= $meta_keywords ?>" />
		<meta name="description" content="<?= $meta_description ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />

		<link rel="stylesheet" href="<?= Rome::getThemePath() ?>css/reset.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?= Rome::getThemePath() ?>css/spite.css" type="text/css" media="screen" charset="utf-8" />

		<?php if ($environment == 'production') { ?>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
		<?php } else { ?>
		<script type="text/javascript" src="<?= Rome::getThemePath() ?>js/jquery.js"></script>
		<?php } ?>

		<script type="text/javascript" src="<?= Rome::getThemePath() ?>js/spiteshow.js"></script>
		<script type="text/javascript" src="<?= Rome::getThemePath() ?>js/cufon.js"></script>
		<script type="text/javascript" src="<?= Rome::getThemePath() ?>js/Diavlo2.js"></script>
	<body>
	
		<div id="container">
			<?= $content ?>
		</div>
		
		<?= ($environment === 'production')? Rome::googleAnalytics($google_analytics) : '' ?>
		
		<!-- powered by ROME CMS -->
		
	</body>
</html>