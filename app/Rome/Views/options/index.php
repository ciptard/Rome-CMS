<div class="in">
	<table width="850" border="0" cellspacing="0" cellpadding="10" class="table_main" >
		<tr class="header">
			<th width="100">System</th>
			<th width="200">Name</th>
			<th width="200">Modified</th>
			<th>Actions</th>
		</tr>
		<?php if ($data) { foreach ($data as $row) { ?>
		<tr>
			<td><?= $row['system'] ?></td>
			<td><?= $row['name'] ?></td>
			<td><?= $row['modified'] ?></td>
			<td>
				<a href="/options/edit/<?= $row['option_id'] ?>/">Edit</a> - 
				<a href="/options/delete/<?= $row['option_id'] ?>/">Delete</a>
			</td>
		</tr>
		<?php } } ?>
	</table>
</div>

<div class="in">
	<p><a href="/options/create/">New Option</a></p>
</div>
