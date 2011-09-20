<div class="in">
	<table width="850" border="0" cellspacing="0" cellpadding="10" class="table_main" >
	
		<tr class="header">
			<th width="150">User</th>
			<th width="100">Status</th>
			<th width="100">Admin</th>
			<th>Actions</th>
		</tr>
		
		<?php foreach ($data as $user) { ?>
		<tr>
			<td><?= $user['username'] ?></td>
			<td><?= ($user['status'] == 1)? 'Active' : 'On Hold' ?></td>
			<td><?= ($user['admin'] == 1)? 'Yes' : 'No' ?></td>
			<td>
				<a href="/users/edit/<?= $user['user_id'] ?>/">Edit</a> - 
				<a href="/users/resetpassword/<?= $user['user_id'] ?>/">Reset Password</a> - 

				<?php if ($user['status'] == 1) { ?>
				<a href="/users/disable/<?= $user['user_id'] ?>/">Disable</a> - 
				<?php } else { ?>
				<a href="/users/enable/<?= $user['user_id'] ?>/">Enable</a> - 
				<?php } ?>

				<?php if ($user['admin'] == 1) { ?>
				<a href="/users/makeuser/<?= $user['user_id'] ?>/">Make User</a>
				<?php } else { ?>
				<a href="/users/makeadmin/<?= $user['user_id'] ?>/">Make Admin</a>
				<?php } ?>

				 - <a href="/users/delete/<?= $user['user_id'] ?>/">Delete</a>
			</td>
		</tr>
		<?php } ?>
	
	</table>
</div>

<div class="in">
	<p><a href="/users/create/">New User</a></p>
</div>