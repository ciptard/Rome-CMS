<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?= $loginTitle ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />

		<?= Roam::partial('layout/jquery', array('environment' => $environment)) ?>

		<link rel="stylesheet" type="text/css"  href="/app/Roam/Frontend/css/main.css" />
		<link rel="stylesheet" type="text/css"  href="/css/modal.css" />
	</head>
	<body id="modal">	
		<div class="wrapper">
		
			<div class="navigation">
				<ul id="dropDownNav">
					<li><a href="/admin/settings/"<?= ($activeNav === 'settings')? ' class="active"' : '' ?>>Profile</a></li>
					<li><a href="/admin/content/"<?= ($activeNav === 'content')? ' class="active"' : '' ?>>Content</a></li>
				</ul>
			</div>
			
			<div class="clear"></div>
			
			<div class="content">
				<?= $content ?>
			</div>
		</div>
	</body>
</html>