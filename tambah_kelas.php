<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Tambah Kelas</title>
  </head>
<body>
  <?php
  include ('tampilan/header.php');
  include ('tampilan/sidebar.php');
  include ('tampilan/footer.php');
?>
  
<div class="main-content bg-primary">
  <section class="section">
    <div class="section-header">
      <h1>TAMBAH KELAS</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="kelas.php">Data Kelas</a></div>
        <div class="breadcrumb-item text-primary">Tambah Kelas</div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form class="wizard-content mt-2" method="post" action="proses_tambahkelas.php">
              <div class="section-title mt-0">KELAS</div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas">
                </div>
                <div class="form-group col-md-12">
                  <input type="text" name="kompetensi_keahlian" class="form-control" placeholder="Jenjang Pendidikan">
                </div>
              </div>
              <div class="mr-2 text-right">
                <button type="submit" class="btn btn-icon icon-right btn-primary">TAMBAH KELAS<i class="fas fa-arrow-right"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
