<div class="in forms">
	<form action="/options/<?= ($formAction)? $formAction : 'save' ?>/" method="post">
		<input type="hidden" name="id" value="<?= $data['option_id'] ?>" />
		
		<p><label for="system">System</label>
		<input type="text" name="system" id="system" size="30" value="<?= ($data['system'])? $data['system'] : '1' ?>" class="box" /></p>
		
		<p><label for="name">Name</label>
		<input type="text" name="name" id="name" size="30" value="<?= $data['name'] ?>" class="box" /></p>
		
		<p><label for="value">Value</label>
		<input type="text" name="value" id="value" size="30" value="<?= $data['value'] ?>" class="box" /></p>
		
		<p><input type="submit" value="SAVE CONTENT" class="com_btn" /><a class="formCancel" href="/content/">Cancel</a></p>
	</form>
</div>
