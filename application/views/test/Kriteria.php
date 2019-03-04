<form action="<?php echo site_url('test/ins_kriteria');?>" method="post" enctype="multipart/form-data">
	<input type="text" name="nama" value="">
	<input type="submit" name="" value="Submit">
</form>

<table class="table table-responsive">
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Aksi</th>
	</tr>
	<?php
	foreach ($data as $key => $value) {
		echo "<tr><td>$key</td><td>$value->nama</td><td><a href='del_kriteria/$value->id'>Del</a>|<a href='up_kriteria/$value->id'>Update</a></td></tr>";
	}
	?>
</table>