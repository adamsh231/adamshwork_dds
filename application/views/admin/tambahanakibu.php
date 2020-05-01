<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <?php
                $ibux = [];
                foreach ($ibu as $i) {
                    $ibux['nama'] = $i['nama'];
                }
                ?>
                <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords($ibux['nama']) ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php if (isset($_SESSION['tambah'])) {
                    echo $_SESSION['tambah'];
                } ?>
                <form id="frm" action="<?php echo base_url() ?>index.php/tambahAnak" method="post">
                    <div class="form-group">
                        <label for="inputNik">NIK</label>
                        <input value="" type="text" class="form-control" id="name1" name="inputNik" placeholder="Input Nomor Induk Kependudukan">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">Nama</label>
                        <input value="" type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama Balita" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
                        </div>
                        <select name="inputJK" class="custom-select" id="inputGroupSelect01">
                            <option value="l" selected>Laki - Laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputTanggal">Tanggal Lahir</label>
                        <input value="" type="date" class="form-control" id="inputTanggal" name="inputTanggal" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . "-1800 days")); ?>" max="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="customRange2">Berat Badan Saat Lahir (Kg)</label>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input placeholder="Berat(Kg)" onkeyup="berat2()" id="valueBB" name="inputBB" type="number" value="3.2" class="form-control" min="0.1" max="50" step="0.1" required>
                            </div>
                            <div style="display:none" class="col-sm-10 mb-3 mb-sm-0">
                                <input oninput="berat()" id="inputBB" type="range" class="custom-range" min="0.1" max="50" step="0.1" value="3.2" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTinggiBadan">Tinggi Badan Saat Lahir (cm)</label>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input onkeyup="tinggi2()" type="number" min="0.1" max="200" step="0.1" value="49.5" class="form-control" id="valueTB" name="inputTB" placeholder="Tinggi(cm)" required>
                            </div>
                            <div style="display:none" class="col-sm-10 mb-3 mb-sm-0">
                                <input oninput="tinggi()" id="inputTB" type="range" class="custom-range" min="0.1" max="200" value="49.5" step="0.1" required>
                            </div>
                        </div>
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
                    <button class="btn btn-primary btn-user btn-block" name="submit" type="submit">
                        Tambah
                    </button>
                    <!-- <hr> -->
                </form>
            </div>
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
</script>