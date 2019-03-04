<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<h3><b>Penilaian Karyawan Tenaga Harian Lepas (THL)</b></h3><br><h4><b>Balai Besar Pelatihan Peternakan (BBPP) BATU</b></h4>
		</div>
	</div>
	<!-- <div class="col-md-8 text-left">
		<strong style="font-size:18pt;">Penilaian Karyawan Tenaga Harian Lepas (THL)</strong>
	</div> -->
	<table class="table table-responsive">
		<thead>
				<tr>
				<th>Nama</th>
				<th>Nilai</th>
				<th>Ranking</th>
			</tr>
		</thead>
		<tbody>
			<?php

			foreach ($nama_alternatif as $key => $value) {
				
				echo "<tr>
					 <td>$value->nama</td>";
				echo '<td>'.$ahp[$key].'</td>';
				echo '<td>'.$rank[$key].'</td>';
				echo "</tr>";
			}
			?>
		</tbody>
	</table>

	<div class="col-md-12">
		<div class="text-right">
			Yang bertanggung Jawab
			<br><br><br><br>
			<?php echo $nama;?>
		</div>
	</div>

</div>

<script type="text/javascript">
	window.print();
</script>