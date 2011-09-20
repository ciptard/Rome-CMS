<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?= $loginTitle ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />

		<?= Roam::partial('layout/jquery', array('environment' => $environment)) ?>

		<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/login.js"></script>
		<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/md5.js"></script>
		
		<link rel="stylesheet" type="text/css"  href="/app/Roam/Frontend/css/main.css" />
	</head>
	<body id="login">	
		<div class="wrapper">
			<div class="content">
				<?= $content ?>
			</div>
		</div>
	</body>
</html>