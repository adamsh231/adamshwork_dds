        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="https://www.instagram.com/faiz_adhitya/">DDS<sub>app</sub>.com</a></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Profile Modal-->
        <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profile Anda</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <br>

                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form id="frm" action="<?php echo base_url() ?>index.php/DDS_Insert/updateProfile" method="post">
                                        <?php foreach ($ibu as $i) { ?>
                                            <div class="form-group">
                                                <label for="inputNama">Nama</label>
                                                <input value="<?php echo $i['nama'] ?>" type="text" class="form-control" id="inputNama" name="inputNama" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputNIK">NIK</label>
                                                <input value="<?php echo $i['nik'] ?>" type="text" class="form-control" id="inputNIK" name="inputNIK" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Username</label>
                                                <input value="<?php echo $i['email'] ?>" type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Password</label>
                                                <input value="<?php echo $i['password'] ?>" type="text" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputHp">Nomor Handphone</label>
                                                <input value="<?php echo $i['hp'] ?>" type="number" class="form-control" id="inputHp" name="inputHp" placeholder="Nomor Handphone yang dapat dihubungi">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAlamat">Alamat Sekarang</label>
                                                <textarea id="inputAlamat" name="inputAlamat" class="form-control" rows="5"><?php echo $i['alamat'] ?></textarea>
                                            </div>
                                        <?php } ?>
                                        <button class="btn btn-primary btn-user btn-block" name="submit" type="submit">
                                            Update
                                        </button>
                                        <!-- <hr> -->
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/logout">Ya</a>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url(); ?>sbadmin/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url(); ?>sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url(); ?>sbadmin/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?php echo base_url(); ?>sbadmin/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo base_url(); ?>sbadmin/js/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url(); ?>sbadmin/js/demo/chart-pie-demo.js"></script>

        <!-- Active js -->
        <script src="<?php echo base_url() ?>uza/js/default-assets/active.js"></script>

        </body>

        </html>