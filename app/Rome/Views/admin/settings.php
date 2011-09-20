<div class="in forms">

	<form action="/admin/updatesettings/" method="post">
	
		<?= Roam::partial('admin/fields', array('settings' => $settings, 'themesList' => $themesList)) ?>
		
		<p><input type="submit" value="UPDATE SETTINGS" class="com_btn" /></p>
	
	</form>
	
</div>
