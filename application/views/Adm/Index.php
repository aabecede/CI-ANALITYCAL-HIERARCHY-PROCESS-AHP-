<!-- modal -->
	<div class="modal fade bs-example-modal-lg" id="modaledit" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Alternatif</h4>
                </div>
                <div class="row">
                  <div class="col-lg-1">
                  </div>
                  <div class="col-lg-10">
                    <div class="fetched-data"></div>
                  </div>
                  <div class="col-lg-1">
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade bs-example-modal-lg" id="myModaltambah" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah User</h4>
                </div>
                <div class="row">
                  <div class="col-lg-1">
                  </div>
                  <div class="col-lg-10">
                    <?php
                    $att_input = array(
                    	'nama_lengkap' => array(
                    		'class' => 'form-control',
                    		'placeholder' => 'Nama Lengkap',
                    		'required' => 'required',
                    		),
                    	'username' => array(
                    		'class' => 'form-control',
                    		'placeholder' => 'Username',
                    		'required' => 'required',
                    	),
                    	'pw' => array(
                    		'class' => 'form-control',
                    		'placeholder' => 'password',
                    		'required' => 'required',
                    	)
                    );

                    echo form_open('admin/add_user');
                    echo form_label('Nama Lengkap', 'nama_lengkap');
                    echo form_input('nama_lengkap', '' ,$att_input['nama_lengkap']);
                    echo form_hidden('role', 'atasan');
                    /*echo form_label('Role', 'role');
                    echo "<select class='form-control' name='role' >";
                    		foreach ($role as $key => $value) {
                    			echo "<option value='$value'>$value</option>";
                    		}
                   	echo "</select>";*/
                   	echo form_label('Username', 'username');
                   	echo form_input('username', '', $att_input['username']);
                   	echo form_label('Password', 'password');
                   	echo form_password('password', '', $att_input['pw']);
                   	echo "<input type='submit' class='btn btn-dark' value='Tambah'>";
                    echo form_close();
                    ?>
                  </div>
                  <div class="col-lg-1">
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
<!-- end modal-->

<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

<div class="container">
	<div class="row">
		<div class="panel panel-info">
			<div class="panel panel-heading">
				<h3>Info User</h3>
			</div>
			<div class="panel panel-body">
				<div class="col-md-6 text-left">
				</div>
				<div class="col-md-6 text-right">
		            <div class="btn-group">
		              <button type="submit" name="hapus-contengan" class="btn btn-danger"><span class="fa fa-close"></span> Hapus Contengan</button>
		             <a href="#" data-target="#myModaltambah" data-toggle="modal" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</a>
		            </div>
		          </div>
		          <br><br><br>
		          <div class="col-lg-12">
		          	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
		          <thead>
		            <tr>
		              <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
		              <th>NIK</th>
		              <th>Nama</th>
		              <th>Role</th>
		              <th>Aksi</th>
		            </tr>
		          </thead>
		          <tfoot>
		            <tr>
		              <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
		              <th>NIK</th>
		              <th>Nama</th>
		              <th>Role</th>
		              <th>Aksi</th>
		            </tr>
		          </tfoot>
		          <tbody>
		          	<?php
		          	foreach ($user as $key => $value) {
		          		$key = $key + 1;
		          		echo "<tr>
		          				<td></td>
		          				<td>$key</td>
		          				<td>$value->nama_lengkap</td>
		          				<td>$value->role</td>
		          				<td>
		          				<a href='#' data-target='#modaledit' data-toggle='modal' data-id='$value->id' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                      <a href='".site_url('admin/del/'.$value->id.'')."' onclick='return confirm('Yakin ingin menghapus data')' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
		          				</td>
		          			</tr>";
		          	}
		          	?>
		          </tbody>
		        </table>
		          </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	 $(document).ready(function(){
        $('#modaledit').on('show.bs.modal', function(e){
            var rowid = $(e.relatedTarget).data('id');
            //ambil data
            $.ajax({
               type :'POST',
            url : '<?php echo site_url('admin/get_edit');?>',
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);//tampil data di modal.
                }

            });
        });
    });
</script>