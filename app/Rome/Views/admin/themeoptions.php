<div class="in forms">

	<form action="/admin/updatethemeoptions/" method="post">
	
		<?php foreach($settings as $name=>$value) { ?>
			
			<?php if ($themeOptions[$name]['input'] === 'textarea') { ?>
				<p>
					<label for="<?= $name ?>"><?= H::humanTitle($name) ?> - Use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a></label>
					<textarea rows="10" cols="50" name="<?= $name ?>" id="<?= $name ?>" class="box"><?= $value ?></textarea>
				</p>
			<?php } else { ?>
				<p><label for="<?= $name ?>"><?= H::humanTitle($name) ?></label>
				<input type="text" name="<?= $name ?>" id="<?= $name ?>" size="30" value="<?= $value?>" class="box" /></p>
			<?php } ?>
			
		<?php } ?>
		
		<p><input type="submit" value="SAVE THEME CONFIG" class="com_btn" /></p>
	
	</form>
	
</div>
