<form action="<?php echo site_url('alternatif/ins_nilai_alternatif');?>" method="post" enctype="multipart/form-data">
	<select name="kriteria">
		<?php
		foreach ($this->db->get('kriteria')->result() as $key => $value) {
			echo "<option value='$value->nama'>$value->nama</option>";
		}
		?>
	</select>
	<br>
	<?php
	foreach ($data as $key => $value) {
		foreach ($data as $keys => $values) {
			if($key < $keys){

				echo "<input type='text' value='$value->nama' name='alternatif1[$key][$keys]'>-";
				echo "<select name='bobot[$key][$keys]'>";
				foreach ($bobot as $keyb => $valueb) {
					echo "<option value='$keyb'>$keyb-$valueb</option>";
				}
				echo '</select>';
				echo "-<input type='text' name='alternatif2[$key][$keys]' value='$values->nama'><br>";

			}
		}
	}
	?>
	<input type="submit" name="">
</form>
<a href="<?php echo site_url('alternatif/perbandingan_alternatif');?>" id="nilai_kriteria">Hasil Kriteria</a>
<a href="<?php echo site_url('kriteria/hasil_perhitungan');?>" id="nilai_kriteria">Hasil Perhitungan</a>