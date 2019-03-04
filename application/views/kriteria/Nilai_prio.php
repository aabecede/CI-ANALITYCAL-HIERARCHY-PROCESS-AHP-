<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('atasan');?>">Beranda</a></li>
		  	<li><a href="<?php echo site_url('kriteria/analisa');?>">Analisa Kriteria</a></li>
		  	<li class="active">Tabel Analisa Kriteria</li>
		</ol><!-- end ol -->

		<div class="row">
			<div class="col-md-6 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span> Perbandingan Kriteria</strong>
			</div>
			<div class="col-md-6 text-right">
				<!-- <form method="post">
         		 <button name="hapus" class="btn btn-danger">Hapus Semua Data</button>
				</form> -->
			</div>
		</div> <!-- end row -->

		<table width="100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Antar Kriteria</th>
					<?php
					foreach ($kriteria as $key => $value) {
						echo "<th>$value->nama</th>";
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($kriteria as $key => $value) {
						echo "<tr>";
						echo "<td><b>$value->nama</b></td>";
						foreach ($ahp1['hasil'][$key] as $keys => $values) {
							echo '<td>'.$values.'</td>';
						}
						echo "</tr>";
					}
						echo "<tr class='info'>";
							echo "<td><b>Total</b></td>";
							foreach ($ahp1['total_bawah'] as $key => $value) {
								echo "<td><b>$value</b></td>";
							}
						echo "</tr>";
					?>
			</tbody>
		</table>

		<div class="row">
			<div class="col-md-6 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span> Normalisasi Kriteria</strong>
			</div>
			<div class="col-md-6 text-right">
				<!-- <form method="post">
         		 <button name="hapus" class="btn btn-danger">Hapus Semua Data</button>
				</form> -->
			</div>
		</div> <!-- end row -->

		<table width="100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Antar Kriteria</th>
					<?php
					foreach ($kriteria as $key => $value) {
						echo "<th>$value->nama</th>";
					}
					?>
					<th class="info">Jumlah</th>
					<th class="success">Bobot Prioritas</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($kriteria as $key => $value) {
					echo "<tr>";
					echo "<td><b>$value->nama</b></td>";
						foreach ($ahp2['hasil'][$key] as $keys => $values) {
							echo '<td>'.$values.'</td>';
						}
						echo '<td class="info"><b>'.$ahp2['jumlah'][$key].'</b></td>';
							echo '<td class="success"><b>'.$ahp2['prioritas'][$key].'</b></td>';
						echo "</tr>";
					}
					echo "<tr class='success'>";
						echo "<td><b>Total</b></td>";
						foreach ($ahp2['total'] as $key => $value) {
							echo "<td><b>$value</b></td>";
						}
					echo "</tr>";
					?>
			</tbody>
		</table>

		<div class="row">
			<div class="col-md-6 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span> Uji Kompetensi </strong>
			</div>
			<div class="col-md-6 text-right">
				<!-- <form method="post">
         		 <button name="hapus" class="btn btn-danger">Hapus Semua Data</button>
				</form> -->
			</div>
		</div> <!-- end row -->
	<form action="<?php echo site_url('kriteria/save_prioritas');?>" method="post" enctype="multipart/form-data">
		<table width="100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Antar Kriteria</th>
					<?php
					foreach ($kriteria as $key => $value) {
						echo "<th>$value->nama</th>";
						echo '<input type="hidden" name="kriteria[]" value="'.$value->id.'">';
					}
					?>
					<th class="info">Prioritas</th>
					<th class="success">Vector</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($kriteria as $key => $value) {
					echo "<tr>";
					echo "<td><b>$value->nama</b></td>";
						foreach ($ahp1['hasil'][$key] as $keys => $values) {
							echo '<td>'.$values.'</td>';
						}
						echo '<td class="info"><b>'.$ahp2['prioritas'][$key].'</b></td>';
						echo '<td class="success"><b>'.$ahp2['vector'][$key].'</b></td>';
						echo '<input type="hidden" name="prioritas[]" value="'.$ahp2['prioritas'][$key].'">';
						echo "</tr>";
					}
					echo "<tr>";
						echo "<td class='danger'><b>Total</b></td>";
						foreach ($ahp1['total_bawah'] as $key => $value) {
							echo "<td class='danger'><b>$value</b></td>";
						}
						echo '<td class="success"><b>Jumlah Rata Vector</b></td><td class="success"><b>'.$ahp3['lamdamax'].'</b></td>';
					echo "</tr>";
					?>
			</tbody>
		</table>

		<div class="row">
			<div class="col-md-6 text-left">
				<strong style="font-size:18pt;"><span class="fa fa-table"></span> Hasil Akhir </strong>
			</div>
			<div class="col-md-6 text-right">
				<!-- <form method="post">
         		 <button name="hapus" class="btn btn-danger">Hapus Semua Data</button>
				</form> -->
			</div>
		</div> <!-- end row -->
	
		<table width="100%" class="table table-striped table-bordered">
			<tbody>
				<tr>
					<th>Simpan Periode</th>
					<th>
					<?php
					$now = date('Y');
					echo '<select name="periode" class="form-control">';
					for ($i=$now;  $i >= 2016 ; $i--) { 
						echo "<option value='$i'>$i</option>";
					}
					echo '</select>';
					?>
					</th>
				</tr>
				<tr>
					<th>N ( Kriteria )</th>
					<th><?php echo count($ahp2['prioritas']);?></th>
				</tr>
				<tr>
					<th>Lamda MAX</th>
					<Th><?php echo $ahp3['lamdamax'];?></Th>
				</tr>
				<tr>
					<th>CI</th>
					<th><?php echo $ahp3['ci'];?></th>
				</tr>
				<tr>
					<th>CR</th>
					<th><?Php echo $ahp3['cr'];?></th>
				</tr>
			</tbody>
		</table>
		<?php
		if($ahp3['cr'] <= 0.1){
			echo '<p class="info">KONSISTEN</p>';
			echo '<input type="submit" name="" class="btn btn-dark" value="Simpan Hasil">';
		}else{
			echo '<p style="color:red">TIDAK KONSISTEN</p>';
			echo "<a href='".site_url('kriteria/analisa')."' class='btn btn-danger'>Ulangi Perhitungan</a>";
		}
		?>
		
	</form>

	</div> <!-- enc ol-xs-->
</div><!-- end row-->

<!-- <table>
	<tr>
		<th></th>
		<?php
		foreach ($kriteria as $key => $value) {
			echo "<th>$value->nama</th>";
		}
		?>
	</tr>
	<?php
	foreach ($kriteria as $key => $value) {
		echo "<tr>";
		echo "<td>$value->nama</td>";
		foreach ($ahp1['hasil'][$key] as $keys => $values) {
			echo '<td>'.$values.'</td>';
		}
		echo "</tr>";
	}
		echo "<tr>";
			echo "<td>Total</td>";
			foreach ($ahp1['total_bawah'] as $key => $value) {
				echo "<td>$value</td>";
			}
		echo "</tr>";
	?>
</table>
<h3>Normalisasi</h3>
<table>
	<tr>
		<th></th>
		<?php
		foreach ($kriteria as $key => $value) {
			echo "<th>$value->nama</th>";
		}
		?>
		<th>Jumlah</th>
		<th>Bobot Prioritas</th>
	</tr>
	<?php
	foreach ($kriteria as $key => $value) {
		echo "<tr>";
		echo "<td>$value->nama</td>";
		foreach ($ahp2['hasil'][$key] as $keys => $values) {
			echo '<td>'.$values.'</td>';
		}
		echo '<td>'.$ahp2['jumlah'][$key].'</td>';
			echo '<td>'.$ahp2['prioritas'][$key].'</td>';
		echo "</tr>";
	}
		echo "<tr>";
			echo "<td>Total</td>";
			foreach ($ahp2['total'] as $key => $value) {
				echo "<td>$value</td>";
			}
		echo "</tr>";
	?>
</table>

<h3>Uji Kompetensi</h3>
<form action="<?php echo site_url('kriteria/save_prioritas');?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<th></th>
			<?php
			foreach ($kriteria as $key => $value) {
				echo "<th>$value->nama</th>";
				echo '<input type="hidden" name="kriteria[]" value="'.$value->nama.'">';
			}
			?>
			<th>Bobot</th>
			<th>CM / EIGON VECTOR</th>
		</tr>
		<?php
		foreach ($kriteria as $key => $value) {
			echo "<tr>";
			echo "<td>$value->nama</td>";
			foreach ($ahp1['hasil'][$key] as $keys => $values) {
				echo '<td>'.$values.'</td>';
			}
			echo '<td>'.$ahp2['prioritas'][$key].'</td>';
			echo '<td>'.$ahp2['vector'][$key].'</td>';
			echo '<input type="hidden" name="prioritas[]" value="'.$ahp2['prioritas'][$key].'">';
			echo "</tr>";
		}
			echo "<tr>";
				echo "<td>Total</td>";
				foreach ($ahp1['total_bawah'] as $key => $value) {
					echo "<td>$value</td>";
				}

			echo "</tr>";
		?>
	</table>
	<table>
		<tr>
			<td><b>Lamda</b></td>
			<td><?php echo $ahp3['lamdamax'];?></td>
		</tr>
		<tr>
			<td><b>CI</b></td>
			<td><?php echo $ahp3['ci'];?></td>
		</tr>
		<tr>
			<td><b>CR</b></td>
			<td><?php echo $ahp3['cr'];?></td>
		</tr>
	</table>
	<input type="submit" name="">
</form> -->