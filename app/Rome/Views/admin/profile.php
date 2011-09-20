<div class="in forms">
	<form action="/admin/updateprofile/" method="post">
	
		<p><label for="name">Name</label>
		<input type="text" name="name" id="name" size="30" value="<?= $settings['name'] ?>" class="box" /></p>

		<p><label for="email">Email</label>
		<input type="text" name="email" id="email" size="30" value="<?= $settings['email'] ?>" class="box" /></p>

		<p><label for="twitter_username">Twitter Username</label>
		<input type="text" name="twitter_username" id="twitter_username" size="30" value="<?= $settings['twitter_username'] ?>" class="box" /></p>

		<p><label for="tagline">Tagline</label>
		<input type="text" name="tagline" id="tagline" size="30" value="<?= $settings['tagline'] ?>" class="box" /></p>
		
		<p>
			<label for="bio">
				Bio - Use <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a>
			</label>
			<textarea rows="10" cols="50" name="bio" id="bio" class="box"><?= $settings['bio'] ?></textarea>
		</p>
		
		<p><input type="submit" value="UPDATE PROFILE" class="com_btn" /></p>
	
	</form>
</div>
