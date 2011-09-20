<div class="in forms">

	<form action="/admin/updateservices/" method="post">
	
		<?= Roam::partial('admin/fields', array('settings' => $settings)) ?>
		
		<p><input type="submit" value="UPDATE SERVICES" class="com_btn" /></p>
	
	</form>
	
</div>
