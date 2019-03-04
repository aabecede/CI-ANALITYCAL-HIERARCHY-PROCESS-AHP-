<?php
if(($this->input->post('hapus-contengan')) > 0){
  //echo '<script>alert("ada")</script>';
  ?>
  <script type="text/javascript">
        window.onload=function(){
            showSuccessToast();
            setTimeout(function(){
                window.location.reload(1);
                history.go(0)
                location.href = location.href
            }, 5000);
        };


        </script>
  <?php
}
?>
<!-- modal -->

 <div class="modal fade bs-example-modal-lg" id="modaledit" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Kriteria</h4>
                </div>
                
                    <div class="fetched-data"></div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade bs-example-modal-lg" id="myModalb" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Kriteria</h4>
                </div>
               <div class="row">
                  <div class="col-lg-1">
                  </div>
                  <div class="col-lg-10">
                    <form action="<?php echo site_url('kriteria/ins_kriteria');?>" method="post" enctype="multipart/form-data">
                    <label>Nama Kriteria</label>  
                    <div class="col-md1">
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="nama" class="form-control" placeholder="Nama Kriteria">
                    </div>
                    <input type="submit" name="" class="btn btn-info" value="Tambah">
                  </form>
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

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
  	<ol class="breadcrumb">
  	  <li><a href="<?php echo site_url('atasan');?>">Beranda</a></li>
  	  <li class="active">Data Kriteria</li>
  	</ol>

    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>

    <form method="post">
    	<div class="row">
    		<div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-bank"></span> Data Kriteria</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
            <button type="submit" name="hapus-contengan" class="btn btn-danger"><span class="fa fa-close"></span> Hapus Contengan</button>
      			<!-- <button type="button" onclick="location.href='data-kriteria-baru.php'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button> -->
            <a href="#" data-target="#myModalb" data-toggle="modal" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data Kriteria</a>
          </div>
    		</div>
    	</div>
    	<br/>
    	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
              <th>ID Kriteria</th>
              <th>Nama Kriteria</th>
              <th width="100px">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
              foreach ($kriteria as $key => $value) {
                 echo '<tr><td style="vertical-align:middle;"><input type="checkbox" value="'.$value->id.'" name="checkbox[]" /></td>
                    <td style="vertical-align:middle;">'.($key+1).'</td>
                    <td style="vertical-align:middle;">'.$value->nama.'</td>
                     <td style="text-align:center;vertical-align:middle;">
                   
                      <a href="#" data-target="#modaledit" data-toggle="modal" data-id="'.$value->id.'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                      <a href="'.site_url('kriteria/del_kriteria/'.$value->id).'" onclick="return confirm("Yakin ingin menghapus data")" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      

                    </td>';
                 echo '</tr>';
              }
            ?>
          </tbody>
        </table>
    </form>
  </div>
</div>


<script type="text/javascript">
   $(document).ready(function(){
        $('#modaledit').on('show.bs.modal', function(e){
            var rowid = $(e.relatedTarget).data('id');
            //ambil data
            $.ajax({
               type :'POST',
            url : '<?php echo site_url('kriteria/edit');?>',
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);//tampil data di modal.
                }

            });
        });
    });
</script>

