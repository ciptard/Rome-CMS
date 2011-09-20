<div class="in forms">
	<form action="/admin/<?= $formAction ?>/" method="post">
		<input type="hidden" name="id" value="<?= $data['option_id'] ?>" />
		
		<p><label for="name">Name</label>
		<input type="text" name="name" id="name" size="30" value="<?= $data['name'] ?>" class="box" /></p>
		
		<p>
			<label for="value">Value - Use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a> or some HTML <small><i>(p, a, b, strong, ul, li, img)</i></small></label>
			<textarea rows="10" cols="50" name="value" id="bio" class="box"><?= $data['value'] ?></textarea>
		</p>
		
		<p><input type="submit" value="SAVE OPTION" class="com_btn" /><a class="formCancel" href="/admin/content/">Cancel</a></p>
	</form>
</div>
