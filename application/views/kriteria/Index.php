<form action="<?php echo site_url('kriteria/ins_nilai_kriteria');?>" method="post" enctype="multipart/form-data">
	
	<?php
	foreach ($kriteria as $key => $value) {
		foreach ($kriteria as $keys => $values) {
			if($key < $keys){

				echo "<input type='text' value='$value->nama' name='kriteria1[$key][$keys]'>-";
				echo "<select name='bobot[$key][$keys]'>";
				foreach ($bobot as $keyb => $valueb) {
					echo "<option value='$keyb'>$keyb-$valueb</option>";
				}
				echo '</select>';
				echo "-<input type='text' name='kriteria2[$key][$keys]' value='$values->nama'><br>";

			}
		}
	}
	?>
	<input type="submit" name="">
</form>
<a href="<?php echo site_url('kriteria/perbandingan_kriteria');?>" id="nilai_kriteria">Hasil Kriteria</a>
<a href="<?php echo site_url('kriteria/hasil_perhitungan');?>" id="nilai_kriteria">Hasil Perhitungan</a>