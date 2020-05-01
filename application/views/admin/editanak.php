<?php if (isset($_SESSION['update'])) {
    echo ($_SESSION['update']);
} ?>
<?php foreach ($anak as $a) { ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords($a['nama_ibu']) ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url() ?>index.php/DDS_Insert/updateAnak" enctype="multipart/form-data">

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="exampleInputEmail1">NIK</label>
                                        <input value="<?php echo $a['nik'] ?>" type="text" class="form-control" id="name1" name="inputNik" placeholder="Input Nomor Induk Kependudukan">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="exampleInputEmail1">Nama</label>
                                        <input value="<?php echo $a['nama'] ?>" type="text" class="form-control" id="name1" name="inputNama" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="exampleInputEmail1">Tanggal Lahir</label>
                                        <input value="<?php echo $a['tgl_lahir'] ?>" type="date" class="form-control" id="name1" name="inputTgl" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="customRange2">Berat Badan Lahir (Kg)</label>
                                    <div class="form-group row">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input value="<?php echo $a['bb_lahir'] ?>" oninput="berat()" id="inputBB" type="range" class="custom-range" min="0.1" max="50" step="0.1" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <input value="<?php echo $a['bb_lahir'] ?>" placeholder="Berat(Kg)" onkeyup="berat2()" id="valueBB" name="inputBB" type="number" class="form-control" min="0.1" max="50" step="0.1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTinggiBadan">Tinggi Badan Lahir (cm)</label>
                                    <div class="form-group row">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input value="<?php echo $a['tb_lahir'] ?>" oninput="tinggi()" id="inputTB" type="range" class="custom-range" min="0.1" max="200" step="0.1" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <input value="<?php echo $a['tb_lahir'] ?>" onkeyup="tinggi2()" type="number" min="0.1" max="200" step="0.1" value="" class="form-control" id="valueTB" name="inputTB" placeholder="Tinggi(cm)" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="exampleInputEmail1">Jenis Kelamin</label>
                                        <select class="form-control" name="inputJK" required>
                                            <option value="p" <?php if ($a['jenis_kelamin'] == 'p') {
                                                                    echo 'selected';
                                                                } ?>>Perempuan</option>
                                            <option value="l" <?php if ($a['jenis_kelamin'] == 'l') {
                                                                    echo 'selected';
                                                                } ?>>Laki - Laki</option>
                                        </select>
                                    </div>
                                </div>

                                <button style="float:right" type="submit" name="submit" class="btn btn-primary ">Edit</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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