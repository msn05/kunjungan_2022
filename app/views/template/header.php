<?php

use App\Controllers\Controller;
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= DOC_ROOT; ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= DOC_ROOT; ?>/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= DOC_ROOT; ?>/AdminLTE/dist/css/adminlte.min.css">
  <script src="<?= DOC_ROOT; ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!--Bootstrap 4-->
  <script src="<?= DOC_ROOT; ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js">
  </script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Right navbar links -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= DOC_ROOT; ?>/home" class="brand-link">
        <img src="<?= DOC_ROOT; ?>/image/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIM-Pengunjung </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= DOC_ROOT; ?>/home" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php if (@$_SESSION['account']['isLogin'] == true) { ?>
              <li class="nav-item">
                <a href="<?= DOC_ROOT; ?>/visit" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Data Kunjungan
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= DOC_ROOT; ?>/fasility" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Data Fasilitas
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= DOC_ROOT; ?>/schedule" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Jadwal Kunjungan
                  </p>
                </a>
              </li>
            <?php } ?>
            <?php if (@$_SESSION['account']['isLogin'] == true || empty(@$_SESSION['account'])) { ?>
              <li class="nav-item">
                <a href="<?= DOC_ROOT; ?>/report" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Report
                  </p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <?php if (@$_SESSION['account']['isLogin'] == true) { ?>
                <a href="<?= Controller; ?>login/logout" type="button" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Logout
                  </p>
                </a>
              <?php } else { ?>
                <a href="<?= Controller; ?>" type="button" class="nav-link">
                  <i class="nav-icon fas fa-arrow-right"></i>
                  <p>
                    Login
                  </p>
                </a>
              <?php } ?>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $data['header']; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="#"><?= $data['header']; ?></a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="modal fade" id="modal-kunjungan">
        <div class="modal-dialog">
          <div class="modal-content bg-default">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Kunjungan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="<?= Controller . '/visit/add'; ?>" method="POST">
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
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-fasilitas">
        <div class="modal-dialog">
          <div class="modal-content bg-default">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Fasilitas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= Controller . 'fasility/add'; ?>" method="POST">
              <div class="card-body">
                <input type="hidden" name="id">
                <div class="form-group row">
                  <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Nama Fasilitas Kunjungan">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Simpan</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-jadwal">
        <div class="modal-dialog">
          <div class="modal-content bg-default">
            <div class="modal-header">
              <h4 class="modal-title">Update Jadwal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= Controller . 'schedule/update/'; ?>" method="POST">
              <div class="card-body">
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
      <!-- /.modal -->

      <script>
        $(document).ready(function() {
          $('#modal-fasilitas,#edit-modal-kunjungan,#modal-kunjangan').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset')
            $(this).find($('.modal-title')).text('');
            $('.new-row').remove()
          })
        })
      </script>