<?php foreach ($settings as $setting) { if ($setting['name'] != 'theme') { ?>
	<p><label for="<?= $setting['name'] ?>"><?= H::humanTitle($setting['name']) ?></label>
	<input type="text" name="<?= $setting['name'] ?>" id="<?= $setting['name'] ?>" size="30" value="<?= $setting['value'] ?>" class="box" /></p>
<?php } else { ?>
	<p>
		<label for="theme">Theme</label>
		<select name="theme" id="theme" class="box2">
			<option>+++ Select a Theme</option>
			<?php foreach ($themesList as $theme) { $selected = ($theme == $setting['value'])? ' selected' : ''; ?>
			<option value="<?= $theme ?>"<?= $selected ?>><?= H::humanTitle($theme) ?></option>
			<?php } ?>
		</select>
	</p>
<?php }} ?>