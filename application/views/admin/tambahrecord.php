<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container-fluid">
    <?php if (isset($_SESSION['id_anak'])) {
        foreach ($anak as $a) {
            $diff = date_diff(date_create($a['tgl_lahir']), date_create(date('Y-m-d')));
            $umur = $diff->days / 30;
            $day = $diff->days % 30;
            $jk = $a['jenis_kelamin'];
            ?>
    <!-- Page Heading -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 flex-row align-items-center justify-content-between">
                <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords(strtolower($a['nama'])) ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- <?php if (isset($_SESSION['tambah'])) {
                                    echo $_SESSION['tambah'];
                                } ?> -->
                <form id="frm" action="<?php echo base_url() ?>index.php/tambahRecord" method="post">
                    <div class="form-group">
                        <label for="inputRecord">Data Pada Umur</label>
                        <input style="text-align:center" class="input" oninput="auto()" type="number" class="text-grey" id="inputUmur" name="inputUmur" value="<?php echo (int) $umur ?>" min="1" max="<?php echo (int) $umur ?>" required>
                        <label>Bulan</label>
                    </div>

                    <div id="inputJU" class="form-group">
                        <div class="form-group">
                            <label for="inputBeratBadan">Jenis Mengukur Tinggi Badan</label>
                            <select name="inputJU" class="custom-select" id="inputselect">
                                <option value="t" selected>Berbaring</option>
                                <option value="b">Berdiri</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customRange2">Berat Badan Sekarang (Kg)</label>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input placeholder="Berat(Kg)" onkeyup="berat2()" id="valueBB" name="inputBB" type="number" class="form-control" min="0.1" max="50" step="0.1" required>
                            </div>
                            <div style="display:none" class="col-sm-10 mb-3 mb-sm-0">
                                <input oninput="berat()" id="inputBB" type="range" class="custom-range" min="0.1" max="50" step="0.1" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTinggiBadan">Tinggi Badan Sekarang (cm)</label>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input onkeyup="tinggi2()" type="number" min="0.1" max="200" step="0.1" value="" class="form-control" id="valueTB" name="inputTB" placeholder="Tinggi(cm)" required>
                            </div>
                            <div style="display:none" class="col-sm-10 mb-3 mb-sm-0">
                                <input oninput="tinggi()" id="inputTB" type="range" class="custom-range" min="0.1" max="200" step="0.1" required>
                            </div>
                        </div>
                    </div>

                    <button id="btnInner" class="btn btn-primary btn-user btn-block" name="submit" type="submit">
                        Tambah
                    </button>
                    <hr>
                    <input type="hidden" name="inputJK" id="inputJK" value="<?php echo $jk ?>">
                    <a id="kosong" style="display:none" class="btn btn-danger btn-user btn-block" href="#" data-toggle="modal" data-target="#hapusRecord">
                        Hapus Data
                    </a>
                </form>

            </div>
        </div>
    </div>
    <?php }
    } else { ?>
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 flex-row align-items-center justify-content-between">
                <div style="text-align:center">
                    <a class="btn btn-primary btn-lg" href="<?php echo base_url() ?>index.php/DDS/index/daftaranak">Pilih Anak</a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<!-- Modal-->
<div class="modal fade" id="hapusRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="recordUmur" class="modal-title" id="exampleModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frm" action="<?php echo base_url() ?>index.php/DDS_Insert/deleteRecord" method="post">
                <div class="modal-footer">
                    <input id="valueUsia" name="valueUsia" type="hidden" value="">
                    <button class="btn btn-danger" name="submit">Ya</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function berat() {
        document.getElementById("valueBB").value = document.getElementById("inputBB").value;
    }

    function berat2() {
        document.getElementById("inputBB").value = document.getElementById("valueBB").value;
    }

    function tinggi() {
        document.getElementById("valueTB").value = document.getElementById("inputTB").value;
    }

    function tinggi2() {
        document.getElementById("inputTB").value = document.getElementById("valueTB").value;
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

    var umur = [];
    getJSON('https://dds.mathnow.fun/index.php/DDS_Json/autoValue/', function(err, data) {
        if (err !== null) {
            alert('Something went wrong: ' + err);
        } else {
            for (i = 0; i < data.length; i++) {
                umur[i] = data[i].usia;
            }
        }
    });

    function auto() {
        var usia = document.getElementById("inputUmur").value;
        var tidakada = true;

        for (i = 0; i < umur.length; i++) {
            if (usia == umur[i]) {
                tidakada = false;
            }
        }

        document.getElementById("btnInner").innerHTML = "Tambah";
        document.getElementById("valueBB").value = null;
        berat2();
        document.getElementById("valueTB").value = null;
        tinggi2();
        document.getElementById("kosong").style.display = "none";

        if (usia > 60) {
            document.getElementById("inputUmur").value = 60;
            lakukanJson(60);
        } else if (usia == 0) {
            document.getElementById("inputUmur").value = "";
        } else if (tidakada == false) {
            lakukanJson(usia);
        }
    }

    function lakukanJson(usia) {
        getJSON('https://dds.mathnow.fun/index.php/DDS_Json/autoValue/' + usia, function(err, data) {
            if (err !== null) {
                alert('Something went wrong: ' + err);
            } else {
                var umur = "";
                var bb = "";
                var tb = "";
                var datax = [];
                for (i = 0; i < data.length; i++) {
                    umur = data[i].usia;
                    bb = data[i].bb_skrg;
                    tb = data[i].tb_skrg;
                }
                datax['umur'] = umur;
                datax['bb'] = bb;
                datax['tb'] = tb;
                if (umur != "") {
                    autoChangeValue(datax);
                }
            }
        });
    }

    function autoChangeValue(data) {
        var usia = document.getElementById("inputUmur").value;
        document.getElementById("valueBB").value = data['bb'];
        berat2();
        document.getElementById("valueTB").value = data['tb'];
        tinggi2();
        document.getElementById("btnInner").innerHTML = "Perbarui";
        document.getElementById("kosong").style.display = "block";
        document.getElementById("recordUmur").innerHTML = "Apakah anda Yakin Menghapus Riwayat Pada Umur ke " + usia;
        document.getElementById("valueUsia").value = usia;
    }

    var age = document.getElementById("inputUmur").value;
    lakukanJson(age);
</script>
