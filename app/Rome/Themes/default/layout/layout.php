<!DOCTYPE html>
<html>
	<head>
		<title><?= $site_title ?></title>
		<meta name="keywords" content="<?= $meta_keywords ?>" />
		<meta name="description" content="<?= $meta_description ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />
	</head>
	<body>
		<?= $content ?>
		<?= ($environment === 'production')? Rome::googleAnalytics($google_analytics) : '' ?>
		<!-- powered by ROME CMS -->
	</body>
</html>