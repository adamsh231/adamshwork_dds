<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 style="text-align:center" class="m-0 font-weight-bold text-primary">Daftar Kader</h6>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url() ?>index.php/DDS/index/tambahkader" style="float:right" class="btn btn-sm btn-success btn-icon-split"><span class="icon text-white"><i class="fas fa-user-plus"></i></span><span class="text">Tambah Admin</span></a>
      <br>
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="30px" style="text-align:center">No</th>
              <th style="text-align:center">Nama</th>
              <th style="text-align:center"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            foreach ($ibu as $a) {
              $count++; ?>
              <tr>
                <td style="text-align:center"><?php echo $count ?></td>
                <td><?php echo ucwords($a['nama']) ?></td>
                <!-- <td style="text-align:center"><?php echo $a['email'] ?></td>
                <td style="text-align:center"><?php echo $a['password'] ?></td>
                <td style="text-align:center"><?php echo $a['hp'] ?></td>
                <td style="text-align:center"><?php echo $a['alamat'] ?></td>
                <td style="text-align:center">
                  <a onclick="valueId(<?php echo $a['id'] ?>,'<?php echo $a['nama'] ?>')" href="#" data-toggle="modal" data-target="#delete">
                    <i class='fas fa-trash-alt text-danger'></i>
                  </a>
                </td> -->
                <td style="text-align:center"><a onclick="loading(<?php echo $a['id'] ?>)" href="#" data-toggle="modal" data-target="#info"><i class='fas fa-info-circle'></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!--Modal-->
<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content" id="informasi">

    </div>
  </div>
</div>

<script>
  function getId(id) {
    $.ajax({
      url: "<?php echo base_url(); ?>index.php/DDS_Json/getAdmin",
      method: "POST",
      data: {
        id: id
      },
      success: function(data) {
        $('#informasi').html(data);
      }
    })
  }

  function loading(id) {
    $('#informasi').html('<div class="modal-header cssload-loader><h4 class="modal-title" id="exampleModalLabel">Loading..</h4><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    getId(id);
  }
</script>