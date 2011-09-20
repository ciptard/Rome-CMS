<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
			<title>Rome CMS</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta http-equiv="Content-Language" content="en" />

			<?= Roam::partial('layout/jquery', array('environment' => $environment)) ?>

			<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/jquery-ui.js"></script>
			<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/dropnav.js"></script>
			<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/admin.js"></script>

			<link rel="stylesheet" type="text/css"  href="/app/Roam/Frontend/css/main.css" />
			<link rel="stylesheet" type="text/css"  href="/app/Roam/Frontend/css/smoothness/jquery-ui-1.8.13.custom.css" />
	</head>
	
	<body>
	
		<div class="wrapper">
		
			<h1 class="logo">ROME CMS</h1>
			<p class="txt_right">
				Logged in as, <strong><?= $loginName ?></strong><span class="v_line"> | </span> 
				<a href="/" target="_blank">View Site</a><span class="v_line"> | </span> 
				<a href="/login/logout/">Logout</a>
			</p>
	
			<div class="navigation">
				<ul id="dropDownNav">
					<li>
						<a href="/admin/"<?= ($activeNav === 'admin')? ' class="active"' : '' ?>>Admin</a>
						<?php if ($isAdmin) { ?>
						<ul>
							<li>
								<a href="/caches/">Cache</a>
								<ul class="submenu">
									<li><a href="/admin/refresh">Refresh Index</a></li>
									<li><a href="/admin/destroycache">Destroy Cache</a></li>
								</ul>
							</li>
						</ul>
						<?php } ?>
					</li>
					<li>
						<a href="/admin/profile/"<?= ($activeNav === 'profile')? ' class="active"' : '' ?>>Profile</a>
						<ul>
							<li><a href="/admin/content/">Content</a></li>
							<li><a href="/admin/services/">Links</a></li>
						</ul>
					</li>
					<li><a href="/admin/settings/"<?= ($activeNav === 'settings')? ' class="active"' : '' ?>>Config</a></li>
					<?php if ($enableThemeOptionsNav) { ?>
					<li><a href="/admin/themeoptions/"<?= ($activeNav === 'themeoptions')? ' class="active"' : '' ?>>Theme Options</a></li>
					<?php } ?>
				</ul>

			</div>
			
			<div class="clear"></div>
	
			<div class="content">
			
				<?php if ($sectionTitle) { ?>
				<div class="in author">
					<h2><?= $sectionTitle ?></h2>
					<?= ($subSectionTitle)? '<p>' . $subSectionTitle . '</p>' : '' ?>
				</div>
				<div class="line"></div>
				<?php } ?>
			
				<?= $content ?>
	
			</div>
			
			<p class="footer">
				Rome CMS by <a href="http://www.tjeastmond.com" target="_blank" class="romeBy">TJ Eastmond</a><span class="v_line">|</span>
				<?php if ($isAdmin) { ?>
					<a href="/users/">Users</a><span class="v_line">|</span>
					<?php if (Registry::get('RomeDebug')) { ?>
					<a href="/options/">Options</a><span class="v_line">|</span>
					<?php } ?>
				<?php } ?>
				<a href="/login/logout/">Logout</a>
			</p>
			
		</div>
		
		
	</body>
</html>