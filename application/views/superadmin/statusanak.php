<style>
  .heart {
    color: #e00;
    animation: beat .5s infinite alternate;
    transform-origin: center;
  }

  @keyframes beat {
    to {
      transform: scale(1.1);
    }
  }
</style>
<?php
$dataAnak[] = "";
$count = 0;
$update = "";
$jk = "";
$catatan = "";
$cekCat = "";
$usia = "";
$tb = $bb = 0;
if (isset($_SESSION['id_anak'])) {
  foreach ($anak as $a) {
    $dataAnak['bb_lahir'] = $a['bb_lahir'];
    $dataAnak['tb_lahir'] = $a['tb_lahir'];
    $dataAnak['nama'] = $a['nama'];
    $dataAnak['nik'] = $a['nik'];
    $dataAnak['nik_ibu'] = $a['nik_ibu'];
    $dataAnak['tgl_lahir'] = date_create($a['tgl_lahir']);
    $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
    $umur = $diff->days / 30;
    $day = $diff->days % 30;
    $tgl_lahir = date_create($a['tgl_lahir']);
    $count++;
    $jk = $a['jenis_kelamin'];
    if ($jk == "p") {
      $jk = "girl";
    } else if ($jk == "l") {
      $jk = "boy";
    }
    $catatan = $a['catatan'];
    $cekCat = $a['cekCat'];
  }
  $sts = [];
  foreach ($record as $r) {
    $bb = $r['bb_skrg'];
    $tb = $r['tb_skrg'];
    $usia = $r['usia'];
    $update = $r['update'];
    $dataAnak['bb_skrg'] = $r['bb_skrg'];
    $dataAnak['tb_skrg'] = $r['tb_skrg'];
    $dataAnak['usia'] = $r['usia'];
    if ($r['zbb'] < -3) {
      $sts['BB'] = "Gizi Buruk";
    } else if ($r['zbb'] > 2) {
      $sts['BB'] = "Gizi Lebih";
    } else if ($r['zbb'] < -2) {
      $sts['BB'] = "Gizi Kurang";
    } else if ($r['zbb'] <= 2 && $r['zbb'] >= -2) {
      $sts['BB'] = "Gizi Baik";
    }
    if ($r['ztb'] < -3) {
      $sts['TB'] = "Sangat Pendek";
    } else if ($r['ztb'] > 2) {
      $sts['TB'] = "Tinggi";
    } else if ($r['ztb'] < -2) {
      $sts['TB'] = "Pendek";
    } else if ($r['ztb'] <= 2 && $r['ztb'] >= -2) {
      $sts['TB'] = "Normal";
    }
    if ($r['zbbtb'] == 999999) {
      $sts['BBTB'] = "Tidak Terdefinisi";
    } else if ($r['zbbtb'] < -3) {
      $sts['BBTB'] = "Sangat Kurus";
    } else if ($r['zbbtb'] > 2) {
      $sts['BBTB'] = "Gemuk";
    } else if ($r['zbbtb'] < -2) {
      $sts['BBTB'] = "Kurus";
    } else if ($r['zbbtb'] <= 2 && $r['zbbtb'] >= -2) {
      $sts['BBTB'] = "Normal";
    }

    $warna1 = "";
    if ($r['zbb'] > 2 || $r['zbb'] < -2) {
      $warna1 = "danger";
    } else if (($r['zbb'] >= -2 && $r['zbb'] <= -1)) {
      $warna1 = "warning";
    } else {
      $warna1 = "primary";
    }
    $warna2 = "";
    if ($r['ztb'] > 2 || $r['ztb'] < -2) {
      $warna2 = "danger";
    } else if (($r['ztb'] >= -2 && $r['ztb'] <= -1)) {
      $warna2 = "warning";
    } else {
      $warna2 = "primary";
    }
    $warna3 = "";
    if ($r['zbbtb'] > 2 || $r['zbbtb'] < -2) {
      $warna3 = "danger";
    } else if (($r['zbbtb'] >= -2 && $r['zbbtb'] <= -1)) {
      $warna3 = "warning";
    } else {
      $warna3 = "primary";
    }
    if ($r['zbbtb'] == 999999) {
      $warna3 = "grey";
    }
  }
}
$update = date_create($update);
$update = date_format($update, 'd M Y') . " ,";
?>
<?php
$ibux = [];
foreach ($ibu2 as $i) {
  $ibux['nama'] = $i['nama'];
  $ibux['nik'] = $i['nik'];
  $ibux['pos'] = $i['nama_pos'];
}
?>
<?php if ($count != 0) { ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Posyandu <?php echo ucwords($ibux['pos']) ?></h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#catatan"><i class="fas fa-scroll"></i> Catatan</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="jumbotron">
        <div class="text-center">
          <h2><?php echo ucwords($dataAnak['nama']) ?></h2>
          <h5>Anak dari ibu <a class="text-primary"><?php echo ucwords($ibux['nama']) ?></a></h5>
          <hr>
          <?php if ($a['foto'] == "?") { ?>
          <img style="width: 200px;" src="<?php echo base_url() ?>sbadmin/img/baby-<?php echo $jk ?>.ico" alt="">
          <?php } else { ?>
          <img style="width: 200px;" src="<?php echo base_url() . $a['foto'] ?>" alt="">
          <?php } ?>
        </div>
        <hr>
        <div class="row">

          <div class="col-md-8 col-xs-12 col-sm-6 col-lg-6">

            <ul class="container details">
              <li>
                <p>Berat Badan Saat Lahir <span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo $dataAnak['bb_lahir'] ?> Kg</p>
              </li>
              <li>
                <p>Tinggi Badan Saat Lahir <span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $dataAnak['tb_lahir'] ?> cm</p>
              </li>
              <li>
                <p>Tanggal Lahir (<span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span><?php echo date_format($dataAnak['tgl_lahir'], "d-M-Y") ?>)</p>
              </li>
            </ul>
            <p style="text-align: right" id="see1"><a href="#see1" onclick="simor(1)">Lihat Detail..</a></p>
          </div>

          <div class="col-md-8 col-xs-12 col-sm-6 col-lg-6">
            <div id="kotak" style="display:none" class="container">
              <!-- <br><br><br>
                <hr> -->
              <ul class="container details p-0">
                <li>
                  <p>NIK : <span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo $dataAnak['nik'] ?></p>
                </li>
                <li>
                  <p>NIK Ibu : <span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $dataAnak['nik_ibu'] ?></p>
                </li>
                <li>
                  <p>Berat Badan Saat ini <span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo $dataAnak['bb_skrg'] ?> Kg</p>
                </li>
                <li>
                  <p>Tinggi Badan Saat ini <span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $dataAnak['tb_skrg'] ?> cm</p>
                </li>
                <li>
                  <p>Record Terakhir pada Usia (<span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span><?php echo $dataAnak['usia'] ?> Bulan)</p>
                </li>
              </ul>
              <p style="text-align: right" id="see2"><a href="#see2" onclick="simor(2)">Tutup</a></p>
            </div>

          </div>
        </div>

        <hr>
        <!-- batas keasuan -->
        <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-0">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">Umur Anak</div>
                    <hr>
                    <div style="text-align:center" class="h5 mb-0 font-weight-bold text-success"><?php echo (int) $umur . " Bulan " . $day . " Hari" ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-hourglass-half fa-2x text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-0">
            <div class="card border-left-<?php echo $warna1 ?> shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">berat badan menurut Umur (BB/U)</div>
                    <!-- <div style="text-align:center" class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sts['BB'] ?> Kg</div> -->
                    <hr>
                    <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna1 ?>"><?php echo $sts['BB'] ?></div>
                  </div>
                  <div class="col-auto">
                    <div class="heart">
                      <a href="#" data-toggle="modal" data-target="#modalBB">
                        <i class="fas fa-weight fa-2x text-<?php echo $warna1 ?>"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-0">
            <div class="card border-left-<?php echo $warna2 ?> shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">panjang badan menurut Umur (PB/U)</div>
                    <hr>
                    <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna2 ?>"><?php echo $sts['TB'] ?></div>
                  </div>
                  <div class="col-auto">
                    <div class="heart">
                      <a href="#" data-toggle="modal" data-target="#modalTB">
                        <i class="fas fa-ruler-vertical fa-2x text-<?php echo $warna2 ?>"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-0">
            <div class="card border-left-<?php echo $warna3 ?> shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div style="text-align:center" class="text-xs font-weight-bold text-uppercase mb-1">berat badan menurut panjang badan (BB/PB)</div>
                    <hr>
                    <div style="text-align:center" class="h5 mb-0 font-weight-bold text-<?php echo $warna3 ?>"><?php echo $sts['BBTB'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-balance-scale fa-2x text-<?php echo $warna3 ?>"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h6 style="float:right;margin-top:10px" class="badge mb-0 font-weight-bold text-gray-800">Last Update: <?php echo $update ?> Usia: (<?php echo $usia ?> bulan)</h6>
      </div>
      <!-- batas keasuan -->

    </div>


    <!-- Area Chart -->
    <div id="grafik" class="col-xl-13 col-lg-13">
      <div class="card shadow mb-4">

        <div class="card-header py-3 flex-row align-items-center justify-content-between">
          <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Grafik Pertumbuhan Baduta Setiap Bulan</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php } else { ?>
  <!-- /.container-fluid -->
  <div class="card shadow mb-4">

    <div class="card-body">
      <div class="text-center">
        <img class="figure-img img-fluid rounded" style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-boy.ico" alt="">
        <img class="figure-img img-fluid rounded" style="width: 6rem;" src="<?php echo base_url() ?>sbadmin/img/baby-girl.ico" alt="">
      </div>
      <hr>
      <div style="text-align:center">
        <a class="btn btn-primary btn-lg" href="<?php echo base_url() ?>index.php/DDS/index/daftaranak">Pilih Anak</a>
      </div>
      <hr>

    </div>
    <?php } ?>
  </div>
  <!-- End of Main Content -->

  <!-- Catatan Modal-->
  <div class="modal fade" id="catatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Catatan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <br>
        <div class="container">
          <form id="frm" action="<?php echo base_url() ?>index.php/DDS_Insert/updateCatatan" method="post">
            <div class="form-group">
              <textarea id="catatan" name="catatan" class="form-control" rows="5" id="comment"><?php echo $catatan ?></textarea>
            </div>
            <div class="modal-footer">
              <?php if ($cekCat == 0 || $cekCat == 1) { ?>
              <button class="btn btn-warning" name="submit" type="submit">Submit</button>
              <button class="btn btn-success" name="submit3" type="submit">Batal</button>
              <?php } else if ($cekCat == 2) { ?>
              <button class="btn btn-success" name="submit3" type="submit">Sudah</button>
              <button class="btn btn-danger" name="submit1_2" type="submit">Belum</button>
              <?php } ?>
              <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal BB-->
  <div class="modal fade" id="modalBB" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Modal">Status Gizi Berat Badan Anak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="mt-0">Status Gizi Berat Badan Menurut Umur termasuk "<a class="text-primary"><?php echo $sts['BB'] ?></a>"</p>
          <p class="mb-0">Berat Badan Anak : <?php echo $bb ?> Kg</p>
          <p class="mt-0">Standar Berat Badan : <?php echo $standar['BB'] ?> Kg</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal TB-->
  <div class="modal fade" id="modalTB" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Modal">Status Gizi Panjang Badan Anak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="mt-0">Status Gizi Panjang Badan Menurut Umur termasuk "<a class="text-primary"><?php echo $sts['TB'] ?></a>"</p>
          <p class="mb-0">Panjang Badan Anak : <?php echo $tb ?> cm</p>
          <p class="mt-0">Standar Panjang Badan : <?php echo $standar['TB'] ?> cm</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function simor(id) {
      if (id == 1) {
        document.getElementById("see1").style.display = "none";
        document.getElementById("kotak").style.display = "block";
      } else if (id == 2) {
        document.getElementById("see1").style.display = "block";
        document.getElementById("kotak").style.display = "none";
      }
    }
  </script>