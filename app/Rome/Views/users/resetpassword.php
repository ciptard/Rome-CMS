<div class="in forms">

<form action="/users/update/" method="post">

<input type="hidden" name="id" value="<?= $data['user_id'] ?>" />

<p><label for="password">Password</label>
<input type="password" name="password" id="password" size="30" value="" class="box" /></p>

<p><input type="submit" value="RESET PASSWORD" class="com_btn" /><a class="formCancel" href="/users/">Cancel</a></p>

</form>

</div>