<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <?php
    $options = [
      'cost' => 10,
    ];

    use App\Controllers\Controller;
    use Core\Message;

    if (@$_SESSION) {
      Message::createMessage();
      unset($_SESSION['message']);
    }
    ?>
    <blockquote class="quote-danger mt-0">
      <h5 id="tip"><?= $data['header']; ?></h5>
      <p>Halaman ini menampung data fasilitas yang didapatkan saat kunjungan </p>
    </blockquote>
    <div class="card card-outline card-primary">
      <div class="col-sm-4 py-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal-jadwal">
          Tambah Jadwal Baru
        </button>
      </div>
      <div class="modal fade" id="add-modal-jadwal">
        <div class="modal-dialog">
          <div class="modal-content bg-default">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Jadwal Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= Controller . 'schedule/add/'; ?>" method="POST">
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Pengajuan Masuk</label>
                  <div class="col-sm-7">
                    <select name="visit_id" class="form-control">
                      <option value="">Pilih jadwal </option>
                      <?php foreach ($data['visited'] as $key => $value) { ?>
                        <option value="<?= $value->id; ?>"><?= $value->destination; ?></option>
                      <?php
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Status</label>
                  <div class="col-sm-7">
                    <select name="statuses_visit" class="form-control">
                      <option value="0">Pending</option>
                      <option value="1">Done</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-5 col-form-label">Masa Kunjungan</label>
                  <div class="col-sm-7">
                    <input type="date" class="form-control" name="date_expired" id="inputPassword3" placeholder="Password">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-5 col-form-label">Hasil Kunjungan</label>
                  <div class="col-sm-7">
                    <textarea name="results" id="results" class="form-control" cols="30" rows="2"></textarea>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Update</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="card-body">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Pengajuan Pegawai</th>
              <th>Tujuan Kunjungan</th>
              <th>Tanggal Pengajuan</th>
              <th>Total Fasilitas</th>
              <th>Masa Kunjungan</th>
              <th>Status</th>
              <th>Hasil</th>
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
                <td><?= date('Y m d', strtotime($value->date_visit)); ?></td>
                <td><?= date('Y m d', strtotime($value->date_expired)); ?></td>
                <td><?= $value->counted ?? ''; ?></td>
                <td><?= round(date(strtotime($value->date_expired) - strtotime($value->date_visit)) / (60 * 60 * 24)) . ' Hari'; ?></td>
                <td><?= $value->statuses_visit  == 0 ? '<label class="text-warning">Pending</label>' : '<label class="text-primary">Done</label>'; ?></td>
                <td><?= $value->results ?? '-'; ?></td>
                <td>
                  <?php if ($value->results == null && @$_SESSION['account']['Case'] == 1) { ?>
                    <button type="button" id="update" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-jadwal" data-route="<?= Controller; ?>schedule/update/<?= $value->PrimaryId; ?>" data-id="<?= $value->PrimaryId; ?>" data-statuses="<?= $value->statuses_visit; ?>" data-date="<?= date('Y-m-d', strtotime($value->date_expired)); ?>" data-hasil="<?= $value->results; ?>" data-tujuan="<?= $value->destination; ?>"> Edit</button>
                  <?php } ?>
                  <a type="button" href="<?= Controller; ?>schedule/show/<?= $value->PrimaryId; ?>" class="btn btn-info btn-sm">Lihat</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>


  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  $(document).ready(function() {
    $('#example').DataTable();
    $('#example').on('click', '#update', function(e) {
      $('#modal-jadwal').find('.modal-title').text('Updated data ' + $(this).data('tujuan'));
      $('#modal-jadwal form').attr('action', $(this).data('route'));
      $('#modal-jadwal input[name="date_expired"]').val($(this).data('date'))
      $('#modal-jadwal textarea[name="results"]').text($(this).data('hasil'))
      $('#modal-jadwal').find('select').val($(this).data('statuses')).trigger('change');
    })

  });
</script>