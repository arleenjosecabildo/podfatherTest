<table class="table table-striped table-sm"  id="csvTable">
	<thead class="thead-dark">
		<tr><?php echo "<th class='text-center'>".str_replace('_', ' ', implode('</th><th class="text-center">', $header))."</th>"; ?></tr>
	</thead>


	<tfoot class="thead-dark">
		<tr><?php echo "<th class='text-center'>".str_replace('_', ' ', implode('</th><th class="text-center">', $header))."</th>"; ?></tr>
	</foot>
</table>
