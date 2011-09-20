<div class="in forms">
<form action="/caches/<?= ($formAction)? $formAction : 'save' ?>/" method="post">
<input type="hidden" name="id" value="<?= $data['cache_id'] ?>" />
<p><label for="name">Name</label>
<input type="text" name="name" id="name" size="30" value="<?= $data['name'] ?>" class="box" /></p>
<p><label for="content">Content</label>
<input type="text" name="content" id="content" size="30" value="<?= $data['content'] ?>" class="box" /></p>
<p><label for="clear">Clear</label>
<input type="text" name="clear" id="clear" size="30" value="<?= $data['clear'] ?>" class="box" /></p>
<p><label for="minutes">Minutes</label>
<input type="text" name="minutes" id="minutes" size="30" value="<?= $data['minutes'] ?>" class="box" /></p>
<p><input type="submit" value="SAVE CACHE" class="com_btn" /><a class="formCancel" href="/<?= caches ?>/">Cancel</a></p>
</form>
</div>
