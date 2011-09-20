<div class="in">
	<table width="850" border="0" cellspacing="0" cellpadding="10" class="table_main" >
		<tr class="header">
			<th width="150">Name</th>
			<th width="150">Minutes</th>
			<th width="200">Created</th>
			<th>Actions</th>
		</tr>
		<?php if ($data) { foreach ($data as $row) { ?>
		<tr>
			<td><?= $row['name'] ?></td>
			<td><?= $row['minutes'] ?></td>
			<td><?= $row['created'] ?></td>
			<td>
				<a href="/caches/delete/<?= $row['cache_id'] ?>/">Delete</a>
			</td>
		</tr>
		<?php } } ?>
	</table>
</div>
