
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('atasan');?>">Beranda</a></li>
			<li class="active">Analisa Alternatif</li>
			<li><a href="<?php echo site_url('alternatif/perbandingan_alternatif');?>">Hasil Analisa Alternatif</a></li>
		</ol>
		<table width="100%" class="table table-striped table-bordered" id="tabeldata">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Nilai</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        
          <tbody>
           <?php
				if(count($nilai) > 0){
					foreach ($nilai as $key => $value) {
						$key = $key + 1;
						echo '<tr>
						<td class="text-center">
							<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalNilaiDetail" data-id="'.$value->id.'"><span class="fa fa-eye" aria-hidden="true"></span></button>
						</td>
						<td>'.$key.'</td>
						<td>'.$value->nik.'</td>
						<td>'.$value->nater.'</td>
						<td>'.$value->nilai.'</td>
						<td>'.$value->keterangan.'</td>
					 </tr>';	
					}	
				}else{
					echo '<p>Data Doesnt Exist</p>
					<a href="'.site_url('alternatif/nilai_awal').'" class="btn btn-dark">Klik Here For Add Data</a>
					';
				}
				?>
          </tbody>
        </table>

		<div class="panel panel-default">
			<div class="panel-body">
				<form method="post" action="<?php echo site_url('alternatif/perbandingan_alternatif_single');?>">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							
							<div class="form-group">
								<p style="padding:10px 0;"><label>Pilih Kriteria
								</label></p>
							</div>
						</div>
						<div class="col-xs-12 col-md-9">
							<div class="form-group">
								<select name="kriteria" class="form-control" onclick="get_kriteria()" id="kriteria">
									<?php
									foreach ($kriteria as $key => $value) {
										echo '<option value="'.$value->id.'">'.$value->nama.'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<label>Kriteria Pertama</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label>Pernilaian</label>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<label>Kriteria Kedua</label>
							</div>
						</div>
					</div>

					<div id="bobot"></div>

					<button type="submit" class="btn btn-dark"> Selanjutnya <span class="fa fa-arrow-right"></span></button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModalalt" tabindex="-1" role="dialog" aria-labelledby="myModalLabelalt">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabelalt">Pilih Kriteria</h4>
			</div>
			<div class="modal-body">
				<div class="list-group">
				
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalNilaiDetail" tabindex="-1" role="dialog" aria-labelledby="modalNilaiDetailLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalNilaiDetailLabel">Nilai Detail</h4>
			</div>

			<div class="fetched-data"></div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	function get_kriteria(){
		var id = $("#kriteria").val();
		$.ajax({
			type 	: "POST",
			url 	: "<?php echo base_url('index.php/alternatif/get_kriteria');?>",
			data 	: "kriteria="+id,
				success:function(msg){
					$("#bobot").html(msg);
				}
		});
	}

	function harga(){
		var id = $("#tujuan").val();
	    $.ajax ({
	      type 	: "POST",
	      url 	: "<?=base_url('index.php/member/get_harga');?>",
	      data 	: "tujuan="+id,
	      success:function(msg){
	        $("#div_harga").html(msg);

	      }
	    });
	}

	$(document).ready(function(){
        $('#modalNilaiDetail').on('show.bs.modal', function(e){
            var rowid = $(e.relatedTarget).data('id');
            //ambil data
            $.ajax({
               type :'POST',
            url : '<?php echo site_url('alternatif/nilai_detail');?>',
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);//tampil data di modal.
                }

            });
        });
    });
</script>