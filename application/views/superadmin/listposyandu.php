<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Daftar Posyandu</h6>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url() ?>index.php/DDS/index/tambahposyandu" style="float:right" class="btn btn-sm btn-success btn-icon-split"><span class="icon text-white"><i class="fas fa-user-plus"></i></span><span class="text">Tambah Posyandu</span></a>
      <br>
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="text-align:center">No</th>
              <th style="text-align:center">Nama</th>
              <th style="text-align:center">Anak</th>
              <th style="text-align:center">Alamat</th>
              <!-- <th style="text-align:center">Kode Pos</th> -->
              <th style="text-align:center">Edit</th>
            </tr>
          </thead>
          <!-- <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot> -->
          <tbody>
            <?php
            $count = 0;
            foreach ($pos as $a) {
              $count++; ?>
              <tr>
                <td style="text-align:center"><?php echo $count ?></td>
                <td><a id="nama<?php echo $a['id'] ?>" href="<?php echo base_url() ?>index.php/DDS_Auth/pilihPosyandu/<?php echo $a['id'] ?>"><?php echo ucwords($a['nama']) ?></a></td>
                <td style="text-align:center"><?php echo $jml[$count] ?></td>
                <td style="text-align:center"><?php echo $a['alamat'] ?></td>
                <!-- <td style="text-align:center"><?php echo $a['kodepos'] ?></td> -->
                <td style="text-align:center">
                  <a href="<?php echo base_url() ?>index.php/DDS_Auth/pilihPosyandu/<?php echo $a['id'] ?>/edit">
                    <i class='fas fa-edit'></i>
                  </a>
                  <a onclick="namaPos(<?php echo $a['id'] ?>)" href="#" data-toggle="modal" data-target="#hapusPosyandu">
                    <i class='fas fa-trash-alt text-danger'></i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="hapusPosyandu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="text-align:left" class="modal-body text-dark" id="tulisan">
      </div>
      <form action="<?php echo base_url()?>index.php/DDS_Insert/deletePosyandu" method="post">
        <input type="hidden" name="id_pos" id="id_pos">
        <div style="text-align:left" class="modal-body text-dark">
          Dengan menghapus posyandu, <a style="color:red">Seluruh data ibu dan anak</a>  dari posyandu diatas akan dihapus dari database.
          <br>
          <div class="checkbox text-right">
            <label>Setuju <input id="cekbok" type="checkbox" required></label>
          </div>
        </div>

        <div class="modal-footer">

          <button type="submit" name="submit" class="btn btn-danger">Ya Hapus</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function namaPos(id) {
    var nama = document.getElementById("nama" + id).innerHTML;
    var cekbok = document.getElementById("cekbok");
    if(cekbok.checked){
      cekbok.click();
    }
    document.getElementById("id_pos").value = id;
    document.getElementById("tulisan").innerHTML = "<h3 class='text-danger text-center'>Hapus Posyandu " + nama + " ?</h3>";
  }
</script>