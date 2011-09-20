<div class="in">
	<table width="850" border="0" cellspacing="0" cellpadding="10" class="table_main" >
		<tr class="header">
			<th width="200">Name</th>
			<th width="400">Content</th>
			<th>Actions</th>
		</tr>
		<?php if ($data) { foreach ($data as $row) { ?>
		<tr>
			<td><?= $row['name'] ?></td>
			<td><?= H::shorten($row['value'], 55) ?></td>
			<td>
				<a href="/admin/editcontent/<?= $row['option_id'] ?>/">Edit</a> - 
				<a href="/admin/destroycontent/<?= $row['option_id'] ?>/">Delete</a>
			</td>
		</tr>
		<?php } } ?>
	</table>
</div>

<div class="in">
	<p><a href="/admin/newcontent/">New Content</a></p>
</div>
