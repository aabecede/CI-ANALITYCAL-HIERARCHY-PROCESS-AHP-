<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilihan Pegawai Terbaik</title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css');?>">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.toastmessage.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    <script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">
  body {
    <?php echo $url;?>
    }
</style>
<body>
    <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li><a href="<?php echo site_url('atasan');?>">Home <span class="sr-only">(current)</span></a></li>
              <?php if ($role == 'pegawai'): ?>
                  <li role="presentation"><a href="data-alternatif.php">Pegawai</a></li>
              <?php endif; ?>

              <?php if ($role == "atasan"): ?>
                  <li role="presentation"><a href="<?php echo site_url('kriteria');?>">Kriteria</a></li>
                  <li role="presentation"><a href="<?php echo site_url('alternatif');?>">Alternatif</a></li>
                  <!-- <li role="presentation"><a href="nilai.php">Skala Dasar AHP</a></li> -->
                  <li role="presentation"><a href="<?php echo site_url('alternatif/nilai_awal');?>">Nilai Awal</a></li>
              <?php endif; ?>

              <?php if ($role == "atasan"): ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perbandingan <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li role="presentation"><a href="<?php echo site_url('kriteria/analisa');?>">Kriteria</a></li>
                          <li role="presentation"><a href="<?php echo site_url('alternatif/analisa');?>">Alternatif</a></li>
                      </ul>
                  </li>
              <?php endif; ?>
              <?php if ($role == "atasan" OR $role == "manajer"): ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li role="presentation"><a href="<?php echo site_url('kriteria/hasil_perhitungan');?>">Hasil Akhir</a></li>
                      </ul>
                  </li>
              <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle text-red text-bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nama?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <?php if ($role == "kepegawaian"): ?>
                          
                      <?php endif; ?>
                      <li role="separator" class="divider"></li>
                      <li><a href="<?php echo site_url('login/logout');?>">Logout</a></li>
                  </ul>
              </li>
          </ul>
          </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
  </nav>
