<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Options</th>
			<th>Price</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php $i=0;foreach($options as $rs): $i++;?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $rs['optionsname'] ?></td>
			<td><?php echo $rs['price'] ?></td>
			<td>
				<button class="btn btn-danger btn-sm"><i class="fa fa-trach"></i></button>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>