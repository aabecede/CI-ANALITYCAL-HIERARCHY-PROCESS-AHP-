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

<div class="modal fade bs-example-modal-lg" id="myModalb" role="dialog" aria-labelledby="myLargeModalLabel">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Alternatif / Tambah Pegawai</h4>
                </div>

                <?php
                $now = $this->db->query('select CURRENT_DATE as now')->row();
                #$max = $this->db->query('select DATE_SUB(curdate(), INTERVAL 15 Year) as now')->row();
                $tahun = date('Y');
                $tahun = $tahun - 15;
                $max = $tahun.'-12-31';
                $pendidikan = array('SMA','D3','S1/D4');
                ?>
               <div class="row">
                  <div class="col-lg-1">
                  </div>
                  <div class="col-lg-10">
                    <form action="<?php echo site_url('alternatif/ins_alternatif');?>" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-resposive">
                      <tr>
                        <td>NIK</td>
                        <td> <input type="number" min = "1" max = "9999999999999999" maxlength="19" name="id" id='nik' required="" class="form-control"  placeholder="NIK"></td>
                      </tr>
                      <tr>
                        <td>Nama Pegawai / Alternatif</td>
                        <td> <input type="text" name="nama" required="" class="form-control" placeholder="Nama Pegawai / Alternatif"></td>
                      </tr>
                      <tr>
                        <td>Tempat Lahir</td>
                        <td><input type="text" name="tempat_lahir" required="" class="form-control" placeholder="Tempat Lahir"></td>
                      </tr>
                      <tr>
                        <td>Tanggal Lahir</td>
                        <td><input type="date" name="tanggal_lahir" max="<?php echo $max;?>" required class="form-control" placeholder="Nama Pegawai / Alternatif"></td>
                      </tr>
                      <tr>
                        <td>Kelamin</td>
                        <td><select name="kelamin" class="form-control" required="">
                       <option value="Pria"> Pria </option>
                       <option value="Wanita"> Wanita </option>
                     </select></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td> <textarea required="" name="alamat" class="form-control"></textarea></td>
                      </tr>
                      <tr>
                        <td>Jabatan</td>
                        <!-- <td><input type="text" name="jabatan" class="form-control" placeholder="Jabatan"></td> -->
                        <td>
                          <select name='jabatan' class="form-control" required="">
                            <?php
                            foreach ($jabatan as $key => $value) {
                              echo "<option value='$value'>$value</option>";
                            }
                            ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Tanggal Masuk</td>
                        <td> <input type="date" name="tanggal_masuk" max="<?php echo $now->now;?>" required class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Pendidikan</td>
                        <!-- <td><input type="text" name="pendidikan" class="form-control" placeholder="Pendidikan"></td> -->
                        <td>
                          <select name='pendidikan' class="form-control" required="">
                            <?php
                            foreach ($pendidikan as $key => $value) {
                              echo "<option value='$value'>$value</option>";
                            }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </table>
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
        <li class="active">Tambah Alternatif / Pegawai</li>
      </ol>

      <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

      <form method="post">
        <div class="row">
          <div class="col-md-6 text-left">
            <strong style="font-size:18pt;"><span class="fa fa-modx"></span> Data Alternatif / Pegawai</strong>
          </div>
          <div class="col-md-6 text-right">
            <div class="btn-group">
              <button type="submit" name="hapus-contengan" class="btn btn-danger"><span class="fa fa-close"></span> Hapus Contengan</button>
             <a href="#" data-target="#myModalb" data-toggle="modal" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</a>
            </div>
          </div>
        </div>
        <br/>
        <table width="100%" class="table table-striped table-bordered" id="tabeldata">
          <thead>
            <tr>
              <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Kelamin</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Tanggal Masuk</th>
              <th>Pendidikan</th>
              <th width="100px">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Kelamin</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Tanggal Masuk</th>
              <th>Pendidikan</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach ($data as $key => $value) {

              $tanggal_lahir = explode('-', $value->tanggal_lahir);
              
              $tahun_lahir = $tanggal_lahir[0];
              $bulan_lahir = $tanggal_lahir[1];
              $hari_lahir = $tanggal_lahir[2];

              $date_lahir = array($hari_lahir, $bulan_lahir, $tahun_lahir);
              $date_lahir =implode('-', $date_lahir);

              $tanggal_masuk = explode('-', $value->tanggal_masuk);

              $tahun_masuk = $tanggal_masuk[0];
              $bulan_masuk = $tanggal_masuk[1];
              $hari_masuk = $tanggal_masuk[2];

              $date_masuk = array($hari_masuk, $bulan_masuk, $tahun_masuk);
              $date_masuk =implode('-', $date_masuk);
             

              #echo json_encode($date_lahir);

#              die;


              echo '<tr>
                    <td style="vertical-align:middle;"><input type="checkbox" value="'.$value->id.'" name="checkbox[]" /></td>
                    <td>'.$value->id.'</td>
                    <td>'.$value->nama.'</td>
                    <td>'.$value->tempat_lahir.'</td>
                    <td>'.$date_lahir.'</td>
                    <td>'.$value->kelamin.'</td>
                    <td>'.$value->alamat.'</td>
                    <td>'.$value->jabatan.'</td>
                    <td>'.$date_masuk.'</td>
                    <td>'.$value->pendidikan.'</td>
                    <td style="text-align:center;vertical-align:middle;">
                   
                      <a href="#" data-target="#modaledit" data-toggle="modal" data-id="'.$value->id.'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                      <a href="'.site_url('alternatif/del_alternatif/'.$value->id).'" onclick="return confirm("Yakin ingin menghapus data")" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      

                    </td>
                    </tr>';
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>

  <!-- Default bootstrap modal example -->
  <div class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nilai Detail</h4>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
            url : '<?php echo site_url('alternatif/get_edit');?>',
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);//tampil data di modal.
                }

            });
        });
    });
</script>
