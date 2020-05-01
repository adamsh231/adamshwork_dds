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
$jk = "";
$catatan = "";
$cekCat = "";
$usia = "";
$update = "";
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
    $update = "";
    $jk = $a['jenis_kelamin'];
    $jk2 = $a['jenis_kelamin'];
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
    $usia = $r['usia'];
    $update = $r['update'];
    $dataAnak['bb_skrg'] = $r['bb_skrg'];
    $dataAnak['tb_skrg'] = $r['tb_skrg'];
    $dataAnak['usia'] = $r['usia'];
    $bb = $r['bb_skrg'];
    $tb = $r['tb_skrg'];
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
<?php if ($count != 0) { ?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <?php if ($cekCat != 0) { ?>
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <div style="text-align:center;font-size:15px" class="text-lg text-primary font-weight-bold text-uppercase mb-1 heart">CATATAN</div>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse" id="collapseCardExample">
      <div class="card-body">
        <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="6" readonly><?php echo $catatan ?></textarea>
        <div class="modal-footer">
          <?php if ($cekCat == 1) { ?>
          <button class="btn btn-info" data-toggle="modal" data-target="#sudah">Sudah</button>
          <?php } else if ($cekCat == 2) { ?>
          <button class="btn btn-danger" data-toggle="modal" data-target="#sudah">Belum</button>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="sudah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="frm" action="<?php echo base_url() ?>index.php/DDS_Insert/updateCatatan" method="post">
          <div class="modal-footer">
            <?php if ($cekCat == 1) { ?>
            <button name="submit2" class="btn btn-info">Sudah</button>
            <?php } else if ($cekCat == 2) { ?>
            <button class="btn btn-danger" name="submit1_2" type="submit">Belum</button>
            <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>
  <!-- Illustrations -->
  <div class="card shadow mb-4">

    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url() ?>index.php/DDS_Auth/pilihAnak/<?php echo $a['id'] ?>/<?php echo $a['id_ibu'] ?>/edit"><i class="fas fa-edit"></i> Edit Data Anak</a>
          <a class="dropdown-item" href="<?php echo base_url() ?>index.php/DDS/index/tambahriwayat"><i class="fas fa-user-clock"></i> Update Riwayat</a>
        </div>
      </div>
    </div>

    <div class="card-body">

      <input type="hidden" id="jenisKelamin" value=<?php echo $jk2 ?>>

      <div class="jumbotron">
        <div class="text-center">
          <h2><?php echo ucwords($dataAnak['nama']) ?></h2>
          <?php
            $ibux = [];
            foreach ($ibu2 as $i) {
              $ibux['nama'] = $i['nama'];
              $ibux['nik'] = $i['nik'];
            }
            ?>
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
          <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">KMS BB</h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="kms"></canvas>
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
    var getJSON = function(url, callback) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.responseType = 'json';
      xhr.onload = function() {
        var status = xhr.status;
        if (status === 200) {
          callback(null, xhr.response);
        } else {
          callback(status, xhr.response);
        }
      };
      xhr.send();
    };

    var jk = document.getElementById("jenisKelamin").value;

    getJSON('https://dds.mathnow.fun/index.php/DDS_Json/autoValueBB/' + jk, function(err, data) {
      if (err !== null) {
        alert('Something went wrong: ' + err);
      } else {
        var msd3 = [];
        var sd3 = [];
        var msd2 = [];
        var sd2 = [];
        var msd1 = [];
        var sd1 = [];
        var med = [];
        var umur = [];
        var datax = [];
        for (i = 0; i < data.length; i++) {
          umur[i] = data[i].umur;
          msd3[i] = data[i]['-3sd'];
          msd2[i] = data[i]['-2sd'];
          msd1[i] = data[i]['-1sd'];
          med[i] = data[i].median;
          sd1[i] = data[i]['+1sd'];
          sd2[i] = data[i]['+2sd'];
          sd3[i] = data[i]['+3sd'];
        }
        datax['umur'] = umur;
        datax['msd3'] = msd3;
        datax['msd2'] = msd2;
        datax['msd1'] = msd1;
        datax['med'] = med;
        datax['sd1'] = sd1;
        datax['sd2'] = sd2;
        datax['sd3'] = sd3;

        getJSON('https://dds.mathnow.fun/index.php/DDS_Json/getRecord/', function(err2, data2) {
          if (err2 !== null) {
            alert('Something went wrong: ' + err2);
          } else {
            var bb = [];
            var datax2 = [];

            var min = 100;
            min = data2[0].usia;

            for (i = 0; i < data2.length; i++) {
              bb[data2[i].usia - min] = data2[i].bb_skrg;
            }
            datax2['bb'] = bb;
          }
          drawChart2(datax, datax2);
        });

      }
    });

    function drawChart2(data, data2) {
      // Area Chart Example
      var ctx = document.getElementById("kms");
      var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: data['umur'],
          datasets: [
            //BATAS
            {
              label: "Batas Atas",
              lineTension: 0.3,
              //backgroundColor: "rgba(10, 255, 10, 0.2)",
              borderColor: "rgba(255, 0, 0, 0.6)",
              pointRadius: 0,
              pointBackgroundColor: "rgba(78, 115, 223, 1)",
              pointBorderColor: "rgba(78, 115, 223, 1)",
              pointHoverRadius: 0,
              pointHoverBackgroundColor: "grey",
              pointHoverBorderColor: "grey",
              pointHitRadius: 0,
              pointBorderWidth: 2,
              data: data['sd3'],
              fill: false
            },
            {
              label: "Batas Bawah",
              lineTension: 0.3,
              //backgroundColor: "rgba(10, 255, 10, 0.2)",
              borderColor: "rgba(255, 0, 0, 0.6)",
              pointRadius: 0,
              pointBackgroundColor: "rgba(102, 255, 102, 1)",
              pointBorderColor: "rgba(102, 255, 102, 1)",
              pointHoverRadius: 0,
              pointHoverBackgroundColor: "grey",
              pointHoverBorderColor: "grey",
              pointHitRadius: 0,
              pointBorderWidth: 2,
              data: data['msd3'],
              fill: false
            },
            //BATAS
            {
              label: "Median",
              lineTension: 0.3,
              backgroundColor: "rgba(0, 0, 0, 0)",
              borderColor: "rgb(95, 226, 110)",
              pointRadius: 0,
              pointBackgroundColor: "rgb(95, 226, 110)",
              pointBorderColor: "rgb(95, 226, 110)",
              pointHoverRadius: 0,
              pointHoverBackgroundColor: "grey",
              pointHoverBorderColor: "grey",
              pointHitRadius: 0,
              pointBorderWidth: 2,
              data: data['med'],
              fill: false
            },
            {
              label: "BB",
              lineTension: 0.3,
              backgroundColor: "rgba(0, 0, 0, 0)",
              borderColor: "rgb(95, 110, 226)",
              pointRadius: 3,
              pointBackgroundColor: "rgb(95, 110, 226)",
              pointBorderColor: "rgb(95, 110, 226)",
              pointHoverRadius: 3,
              pointHoverBackgroundColor: "grey",
              pointHoverBorderColor: "grey",
              pointHitRadius: 10,
              pointBorderWidth: 2,
              data: data2['bb'],
              fill: false
            }

          ],
        },
        options: {
          maintainAspectRatio: false,
          spanGaps: true,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Umur (Bulan)'
              },
              gridLines: {
                display: true,
                drawBorder: true,
                borderDash: [2],
                zeroLineBorderDash: [2]
              },
              ticks: {
                maxTicksLimit: 7,
              }
            }],
            yAxes: [{
              ticks: {
                maxTicksLimit: 5,
                padding: 10,
              },
              gridLines: {
                display: true,
                color: "rgb(234, 236, 244)",
                //zeroLineColor: "black",
                drawBorder: true,
                borderDash: [2],
                //zeroLineBorderDash: [1]
              },
              scaleLabel: {
                display: true,
                labelString: 'Kg'
              },
            }],
          },
          legend: {
            display: false
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: true,
            mode: 'nearest',
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ' ' + number_format(tooltipItem.yLabel) + ' Kg';
              }
            }
          }
        }
      });
    }
  </script>
