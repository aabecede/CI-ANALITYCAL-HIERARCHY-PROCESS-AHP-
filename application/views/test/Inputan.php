<?php



?>

<!-- <form action="<?php echo site_url('test/ins_nilai_kriteria');?>" method="post" enctype="multipart/form-data"> -->
<form action="<?php echo site_url('test/perbandingan_kriteria');?>" method="post" enctype="multipart/form-data">
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

<form action="<?php echo site_url('test/kriteria');?>" method="post" enctype="multipart/form-data">
	<?php
	foreach ($kriteria as $key => $value) {
		foreach ($kriteria as $keys => $values) {
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