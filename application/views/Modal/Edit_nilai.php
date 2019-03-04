<div class="row">
	<div class="col-xs-12 col-md-12">
		<?php

		$attributes = array(
			'class' => 'form-control',
			'type' => 'number',
			'max' => '100',
			'min' => '0',
		);

		echo form_open('Nilai_awal/update_nilai_awal');
		echo "<table class='table table-striped'>";
		echo "<tr>
				<td>Nama</td>
				<td>".form_hidden('id_alternatif', $id)."$nama</td>
			</tr>";
		foreach ($kriteria as $key => $value) {
			echo "<tr>
					<td>$value->nama</td>";
			echo '<td>'.form_input('nilai[]', $nilai[$key], $attributes).'</td>';
					#echo "<td><input type=</td>";
			echo "</tr>";

			/*$this->form_label($value->nama, $nama);
			$this->form_input('nilai', 'value', $attributes);*/
		}
		echo "</table>";
		echo "<input type='submit' class='btn btn-dark' value='Ubah'>";
		echo form_close();
		?>
	</div>
</div>