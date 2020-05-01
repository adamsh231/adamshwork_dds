<div class="container-fluid">

    <!-- Page Heading -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <!-- Card Body -->
            <div class="card-body">
                <?php if (isset($_SESSION['register'])) {
                    echo $_SESSION['register'];
                } ?>
                <!-- <?php if (isset($_SESSION['tambah'])) {
                            echo $_SESSION['tambah'];
                        } ?> -->
                <form id="frm" action="<?php echo base_url() ?>index.php/tambahIbu" method="post">
                    <div class="form-group">
                        <label for="inputNik">NIK</label>
                        <input value="" type="text" class="form-control" id="name1" name="inputNik" placeholder="Input Nomor Induk Kependudukan">
                    </div>
                    <div class="form-group">
                        <label for="inputNama">Nama</label>
                        <input value="" type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama Ibu" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Nama Panggilan</label>
                        <input value="" type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Nama Panggilan" required>
                    </div>
                    <div class="form-group">
                        <label for="inputHp">Hp</label>
                        <input value="" type="number" class="form-control" id="inputHp" name="inputHp" placeholder="No Hp yang dapat dihubungi">
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat Sekarang</label>
                        <textarea id="inputAlamat" name="inputAlamat" class="form-control" rows="5"></textarea>
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