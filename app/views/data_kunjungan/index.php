<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <?php

    use App\Controllers\Controller;
    use Core\Message;

    if (@$_SESSION) {
      Message::createMessage();
      unset($_SESSION['message']);
    }
    ?>
    <blockquote class="quote-info mt-0">
      <h5 id="tip"><?= $data['header']; ?></h5>
      <p>Halaman ini menampung data kunjungan yang belum dilakukan proses lanjuttan atau pending.</p>
    </blockquote>
    <div class="card card-outline card-primary">
      <div class="col-sm-4 py-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-kunjungan">
          Tambah Kunjungan
        </button>
      </div>

      <div class="card-body">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pembuat</th>
              <th>Tanggal Kunjungan</th>
              <th>Tujuan</th>
              <th>Jumlah Pegawai</th>
              <th>Keperluan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($data['table'] as $key => $value) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $value->name_employee; ?></td>
                <td><?= date('d M Y', strtotime($value->date_visit)); ?></td>
                <td><?= $value->destination; ?></td>
                <td><?= $value->totals_follow_employee . ' Orang'; ?></td>
                <td><?= $value->necessity ?? '-'; ?></td>
                <td>
                  <?php if (date('Y-m-d', strtotime($value->date_visit)) >= date('Y-m-d')) { ?>
                    <a type="submit" href="<?= Controller; ?>visit/delete/<?= $value->PrimaryId; ?>" class="btn btn-danger btn-sm">Delete</a>
                    <button type="button" id="edit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-modal-kunjungan" data-id="<?= $value->PrimaryKey; ?>" data-name="<?= $value->name_employee; ?>" data-date="<?= date('Y-m-d', strtotime($value->date_visit)); ?>" data-destination="<?= $value->destination; ?>" data-totals="<?= $value->totals_follow_employee; ?>" data-necessity="<?= $value->necessity; ?>"> Edit</button>
                  <?php } ?>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <div class="modal fade" id="edit-modal-kunjungan">
          <div class="modal-dialog">
            <div class="modal-content bg-default">
              <div class="modal-header">
                <h4 class="modal-title">Edit Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="<?= Controller . 'visit/update/' . $value->PrimaryId; ?>" method="POST">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-5 col-form-label">Nama</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" name="name_employee" id="inputEmail3" placeholder="Nama Pegawai Pengajuan Kunjungan">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-5 col-form-label">Tanggal Kunjungan</label>
                      <div class="col-sm-7">
                        <input type="date" class="form-control" name="date_visit" id="inputPassword3" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-5 col-form-label">Tujuan</label>
                      <div class="col-sm-7">
                        <textarea name="destination" id="destination" class="form-control" cols="30" rows="2"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-5 col-form-label">Jumlah Anggota</label>
                      <div class="col-sm-7">
                        <input type="number" class="form-control" name="totals_follow_employee" id="inputPassword3" placeholder="Jumlah Anggota">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-5 col-form-label">Keperluan</label>
                      <div class="col-sm-7">
                        <textarea name="necessity" id="necessity" class="form-control" cols="30" rows="2"></textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>
    </div>


  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  $(document).ready(function() {
    $('#example').DataTable();
    $('#example').on('click', '#edit', function(e) {
      $('#edit-modal-kunjungan input[name="name_employee"]').val($(this).data('name'))
      $('#edit-modal-kunjungan input[name="totals_follow_employee"]').val($(this).data('totals'))
      $('#edit-modal-kunjungan input[name="date_visit"]').val($(this).data('date'))
      $('#edit-modal-kunjungan textarea[name="necessity"]').text($(this).data('necessity'))
      $('#edit-modal-kunjungan textarea[name="destination"]').text($(this).data('destination'))
      // $(this).data('target').show('modal');
    })
  });
</script>