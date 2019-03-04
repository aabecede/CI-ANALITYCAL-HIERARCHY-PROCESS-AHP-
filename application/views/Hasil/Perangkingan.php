
 <div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="row">
			<div class="col-md-8 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span> Penilaian Karyawan Tenaga Harian Lepas (THL)</strong>
			</div>
			<div class="col-md-4 text-right">
				<a href="<?php echo site_url('kriteria/print_doc');?>" target="_blank" class="btn btn-dark">Print</a>
				<!-- <button onclick="window.print()" class="btn btn-dark" id="print">Print</button> -->
			</div>
		</div>
		<br>
		<table class="table table-striped table-bordered">
			<tr>
				<th></th>
				<?php
				foreach ($kriteria as $key => $value) {
					echo "<th>$value->nama</th>";
				}
				?>
			</tr>
			<?php
				foreach ($nama_alternatif as $key => $value) {
					echo "<tr>
							<td class='info'>$value->nama</td>";
							foreach ($nilai as $keys => $values) {
								if($value->id == $values->alternatif){
									echo "<td class='success'>$values->prioritas</td>";	
								}
							}
					echo "</tr>";
				}
				echo "<tr class='warning'>";
					echo "<td>Prioritas</td>";
					foreach ($prioritas_kriteria as $key => $value) {
						echo "<td>$value->prioritas</td>";
					}
					echo "</tr>";
			?>
		</table>

		<h3>Hasil Rangking Metode</h3>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Nama</th>
				<th>Nilai</th>
				<th>Ranking</th>
			</tr>
			<?php
			
			foreach ($nama_alternatif as $key => $value) {
				
				echo "<tr>
					 <td class='info'>$value->nama</td>";
				echo '<td class="success">'.@$ahp[$key].'</td>';
				echo '<td class="warning">'.@$rank[$key].'</td>';
				echo "</tr>";
			}
			?>
		</table>

		<h3>Hasil Ranking Normal</h3>
		<table class="table table-striped table-bordered">
			<thead>
				<tr style="background-color:white">
					<th>Nama</th>
					<th>Nilai</th>
					<th>Ranking</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($nilai_awal as $key => $value) {
					echo "<tr>
							<td class='info'>$value->nama</td>
							<td class='success'>$value->nilai</td>
							<td class='warning'>$rank_awal[$key]</td>
						</tr>";
				}
				?>
			</tbody>
		</table>
		
	</div>
</div>
