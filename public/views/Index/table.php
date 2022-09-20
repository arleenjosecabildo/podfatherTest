<table class="table table-striped table-sm"  id="csvTable">
	<thead class="thead-dark">
		<tr><?php echo "<th class='text-center'>".str_replace('_', ' ', implode('</th><th class="text-center">', $header))."</th>"; ?></tr>
	</thead>

	<tbody>

	<?php foreach ($rs as $row ):?>
		<tr><?php echo "<td class='text-center'>".str_replace('_', ' ', implode('</td><td class="text-center">', $row))."</td>";?></tr>
	<?php endforeach;?>
	</tbody>
	
	<tfoot class="thead-dark">
		<tr><?php echo "<th class='text-center'>".str_replace('_', ' ', implode('</th><th class="text-center">', $header))."</th>"; ?></tr>
	</foot>
</table>
