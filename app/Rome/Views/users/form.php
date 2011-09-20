<div class="in forms">

<form action="/users/<?= ($formAction)? $formAction : 'save' ?>/" method="post">

<input type="hidden" name="id" value="<?= $data['user_id'] ?>" />

<p><label for="username">Username</label>
<input type="text" name="username" id="username" size="30" value="<?= $data['username'] ?>" class="box" /></p>

<?php if ($formAction !== 'update') { ?>
<p><label for="password">Password</label>
<input type="password" name="password" id="password" size="30" value="<?= $data['password'] ?>" class="box" /></p>
<?php } ?>

<p>
	<input type="submit" value="SAVE USER" class="com_btn" />
	<a class="formCancel" href="<?= ($controller == 'profiles')? '/profiles/user/' . $data['user_id'] . '/' : '/users/' ?>">Cancel</a>
</p>

</form>

</div>