<div class="in">
	<?= ($title)? '<h3>' . $title . '</h3>' : '' ?>
	<table width="850" border="0" cellspacing="0" cellpadding="10" class="table_main" >
		<tr class="header">
			<th width="200">Developer</th>
			<th width="150">Title</th>
			<th width="150">Email</th>
			<th></th>
		</tr>
		<?php foreach ($users as $user) { ?>
		<tr>
			<td><a href="/profiles/user/<?= $user['user_id'] ?>"><?= $user['firstname'] . ' ' . $user['lastname'] ?></a></td>
			<td><?= H::shorten($user['title']) ?></td>
			<td><?= $user['email'] ?></td>
			<td></td>
		</tr>
		<?php } ?>
	</table>
</div>