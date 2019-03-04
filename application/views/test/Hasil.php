<?php
//var_dump($input['kriteria']);
echo '<h3>'.$data['kriteria'].'</h3>';
?>
<table>
	<tr>
		<th></th>
		<?php
		foreach ($alke as $key => $value) {
			echo "<th>$value->nama</th>";
		}
		?>
	</tr>
	<?php
	foreach ($alke as $keya => $valuea) {
		echo "<tr>";
		echo "<td>$valuea->nama</td>";
		for ($i=0; $i < sizeof($ahp['hasil'][$keya]) ; $i++) { 
			//for ($j=0; $j < sizeof($ahp['hasil'][$i]) ; $j++) { 
				//echo "<td>$ahp['hasil'][$i][$j]</td>";
				echo '<td>'.round($ahp['hasil'][$keya][$i],4).'</td>';
			//}
		}
		echo "</tr>";
	}

	echo '<tr>
		<td>Total</td>';
		foreach ($ahp['total'] as $key => $value) {
			echo "<td>$value</td>";
		}
		echo '
	</tr>';
	?>
</table>

<table>

<table>
	<tr>
		<th></th>
		<?php
		foreach ($alke as $key => $value) {
			echo "<th>$value->nama</th>";
		}
		?>
		<th>Prioritas</th>
	</tr>
	<?php
	foreach ($alke as $keya => $valuea) {
		echo "<tr>";
		echo "<td>$valuea->nama</td>";
		for ($i=0; $i < sizeof($ahp2['hasil'][$keya]) ; $i++) { 
			//for ($j=0; $j < sizeof($ahp['hasil'][$i]) ; $j++) { 
				//echo "<td>$ahp['hasil'][$i][$j]</td>";
				echo '<td>'.round($ahp2['hasil'][$keya][$i],4).'</td>';
				//echo '<td>'.round($ahp2['prioritas'][$keya],4).'</td>';
			//}
		}
		echo '<td>'.$ahp2['prioritas'][$keya].'</td>';
		echo "</tr>";
	}

	echo '<tr>
		<td>Konsistensi</td>';
		foreach ($ahp2['total'] as $key => $value) {
			echo "<td>$value</td>";
		}
		echo '
	</tr>';

	?>
</table>

<table>