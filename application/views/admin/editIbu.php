<?php if (isset($_SESSION['update'])) {
    echo ($_SESSION['update']);
} ?>
<?php foreach ($ibu as $a) { ?>
    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
                <h6 style="text-align:center" class="m-0 font-weight-bold text-primary"><?php echo ucwords($a['nama_ibu']) ?></h6>
            </div> -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url() ?>index.php/DDS_Insert/updateProfile/edit" enctype="multipart/form-data">

                                <div class="form-group">
                                <label for="inputNik">NIK</label>
                                    <input value="<?php echo $a['nik'] ?>" type="text" class="form-control" id="name1" name="inputNik" placeholder="Input Nomor Induk Kependudukan">
                                </div>

                                <div class="form-group">
                                    <label for="inputNama">Nama</label>
                                    <input value="<?php echo $a['nama'] ?>" type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama Kader" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Username</label>
                                    <input value="<?php echo $a['email'] ?>" type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Password</label>
                                    <input value="<?php echo $a['password'] ?>" type="text" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputHp">Nomor Handphone</label>
                                    <input value="<?php echo $a['hp'] ?>" type="number" class="form-control" id="inputHp" name="inputHp" placeholder="Nomor Handphone yang dapat dihubungi">
                                </div>
                                <div class="form-group">
                                    <label for="inputAlamat">Alamat Sekarang</label>
                                    <textarea id="inputAlamat" name="inputAlamat" class="form-control" rows="5"><?php echo $a['alamat'] ?></textarea>
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