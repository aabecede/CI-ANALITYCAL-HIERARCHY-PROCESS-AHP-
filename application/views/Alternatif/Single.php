<div class="row">
	<div class="col-lg-12 col-xs-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('Alternatif');?>">Beranda</a></li>
			<li class="active"><a href="<?php echo site_url('Alternatif/analisa');?>">Analisa Alternatif</a></li>
			<li> Perbandingan Alternatif</li>
		</ol>

		<h3>Perbandingan Antar alternatif --> <?php echo $kriteria->nama;?> <-- </h3>
		<h4>Bobot</h4>
<form action="<?php echo site_url('alternatif/ins_nilai_alternatif');?>" method="post" enctype="multipart/form-data">
		<table width="100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Antar Alternatif</th>
					<input type="hidden" name="kriteria" value="<?php echo $input;?>">
					<?php
					foreach ($alke as $key => $value) {
						foreach ($alke as $keys => $values) {
							if($key < $keys){
								echo '<input type="hidden" name="alternatif1['.$key.']['.$keys.']" value="'.$value->id.'">';
								echo "<input type='hidden' name='alternatif2[$key][$keys]' value='$values->id'>";
								echo '<input type="hidden" name="bobot['.$key.']['.$keys.']" value="'.$ahp1['bobot'][$key][$keys].'">';
							}
						}
					}
					foreach ($alke as $key => $value) {
						echo "<th>$value->nama</th>";
						
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($alke as $key => $value) {
						echo "<tr><td>$value->nama</td>";
						
						foreach ($ahp1['hasil'] as $keys => $value_ahp1) {
							echo '<td>'.$ahp1['hasil'][$key][$keys].'</td>';
						}
						echo '<tr>';
					}
				?>
			</tbody>
		</table>

		<h4>Normalisasi</h4>
		<table width="100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Antar Alternatif</th>
					<?php
					foreach ($alke as $key => $value) {
						echo "<th>$value->nama</th>";
					}
					?>
					<th class="info">Jumlah</th>
					<th class="danger">Prioritas</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($alke as $key => $value) {
						echo "<tr><td>$value->nama</td>";
						foreach ($ahp2['hasil'] as $keys => $value_ahp1) {
							echo '<td>'.$ahp2['hasil'][$key][$keys].'</td>';
						}
						echo '<td class="info">'.$ahp2['jumlah'][$key].'</td>';
						echo '<td class="danger">'.$ahp2['prioritas'][$key].'</td>
						<tr>';
					}
					echo '
						<tr class="success">
							<td>Total</td>';
							foreach ($ahp2['total'] as $key => $value) {
								echo "<td>$value</td>";
							}
					echo'</tr>';
				?>
			</tbody>
		</table>
		<input type="submit" value="Simpan Bobot dan Periode" class="btn btn-dark">
</form>
	</div>
</div>