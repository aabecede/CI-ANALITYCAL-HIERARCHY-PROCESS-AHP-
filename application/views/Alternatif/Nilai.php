<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url();?>assets/chart/chart.js"></script>
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
                    <h4 class="modal-title">Update Nilai</h4>
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
                    <h4 class="modal-title">Tambah Nilai Pegawai</h4>
                </div>
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                  <form action="<?php echo site_url('alternatif/ins_nilai');?>" method="post" enctype="multipart/form-data">
                    <table class="table table-striped">
                      <tr>
                        <td>Nama Pegawai</td>
                        <td>
                          <select name="id_alternatif" class="form-control">
                          <?php
                          foreach ($pegawai as $key => $value) {
                            echo '<option value="'.$value->id.'"> '.$value->nama.'</option>';
                          }
                        ?>
                        </select>
                        </td>
                      </tr>
                      <?php
                      foreach ($kriteria as $key => $value) {
                        echo '<tr>
                                <td>'.$value->nama.'</td>
                                <td><input type="hidden" name="id_kriteria[]" value="'.$value->id.'">
                                <input type="number" min="0" max="100" name="nilai[]" class="form-control">
                                </td>
                              </tr>';
                      }
                      $sekarang = date('Y');
                      echo '<tr>
                              <td>Periode</td>
                              <td><select name="periode" class="form-control">';
                            for ($i=$sekarang; $i >= 2016 ; $i--) { 
                              echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            }      
                      echo '</select></td>
                           </tr>';
                      ?>
                    </table>
                 

                    <input type="submit" class="btn btn-info" value="Tambah">
                  </form>
                </div>
                <div class="col-lg-1">
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
        <li class="active">Nilai Awal</li>
      </ol>

      <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
      <div class="row">
      <canvas id="myChart" height="50px"></canvas>
      </div>

      <br><br><br
      <form method="post">
        <div class="row">
          <div class="col-md-6 text-left">
            <strong style="font-size:18pt;"><span class="fa fa-modx"></span> Data Nilai Preferensi</strong>
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
              <th>Nilai</th>
              <th>Keterangan</th>
              <th>Periode</th>
              <th width="100px">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Nilai</th>
              <th>Keterangan</th>
              <th>Periode</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
              foreach ($data as $key => $value) {
                echo "<tr>
                        <td style='vertical-align:middle;'><input type='checkbox' value='$value->idnilai' name='checkbox[]'' /></td>
                        <td>$value->id_alternatif</td>
                        <td>$value->nama</td>
                        <td>$value->nilai</<td>
                        <td>$value->keterangan</td>
                        <td>$value->periode</td>";
                echo '  <td style="text-align:center;vertical-align:middle;">
                   
                     <a href="#" data-target="#modaledit" data-toggle="modal" data-id="'.$value->idnilai.'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                      <a href="'.site_url('alternatif/del_nilai/'.$value->idnilai).'" onclick="return confirm("Yakin ingin menghapus data")" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                      

                    </td></tr>';
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
            url : '<?php echo site_url('alternatif/get_edit_nilai');?>',
                data : 'rowid='+rowid,
                success : function(data){
                    $('.fetched-data').html(data);//tampil data di modal.
                }

            });
        });
    });

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Kurang", "Buruk", "Cukup Buruk", "Cukup Baik", "Baik", "Sangat Baik"],
        datasets: [{
            label: 'Keterangan Nilai',
            data: [40, 60, 70, 80, 90, 100],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>