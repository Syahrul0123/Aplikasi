<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

?>
<!DOCTYPE html>
<html>

<head>
  <title>Tambah Siswa</title>

</head>

<body>
  <?php

  include('tampilan/header.php');
  include('tampilan/sidebar.php');
  include('tampilan/footer.php');
  ?>
  <div class="main-content bg-primary">
    <section class="section">
      <div class="section-header">
        <h1>TAMBAH SISWA</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item text-primary"><a href="siswa.php">Data Siswa</a></div>
          <div class="breadcrumb-item text-primary">Tambah Siswa</div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form class="wizard-content mt-2" method="post" action="proses_tambahsiswa.php">
                <div class="section-title mt-0">DATA SANTRI</div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <input type="text" name="nama" class="form-control" placeholder="Nama">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="nisn" class="form-control" placeholder="NISN">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="nis" class="form-control" placeholder="NIS">
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control" name="id_kelas">
                      <option value="not_option"> silahkan pilih ID kelas</option>
                      <?php
                      // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                      $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                      $result = mysqli_query($koneksi, $query);
                      //mengecek apakah ada error ketika menjalankan query
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }

                      //buat perulangan untuk element tabel dari data mahasiswa
                      $no = 1; //variabel untuk membuat nomor urut
                      // hasil query akan disimpan dalam variabel $data dalam bentuk array
                      // kemudian dicetak dengan perulangan while
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <option value="<?php echo $row['id_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
                      <?php
                        $no++; //untuk nomor urut terus bertambah 1
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="tempat_tgl_lahir" class="form-control" placeholder="Tempat tanggal lahir">
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control" name="tahun">
                      <option value="not_option"> silahkan pilih tahun masuk</option>
                      <?php
                      // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                      $query = "SELECT * FROM spp ORDER BY tahun ASC";
                      $result = mysqli_query($koneksi, $query);
                      //mengecek apakah ada error ketika menjalankan query
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }

                      //buat perulangan untuk element tabel dari data mahasiswa
                      $no = 1; //variabel untuk membuat nomor urut
                      // hasil query akan disimpan dalam variabel $data dalam bentuk array
                      // kemudian dicetak dengan perulangan while
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <option value="<?php echo $row['id_spp']; ?>"><?php echo $row['tahun']; ?></option>
                      <?php
                        $no++; //untuk nomor urut terus bertambah 1
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="section-title mt-0">DATA ORANG TUA / WALI SANTRI</div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Orang Tua / Wali">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="agama" class="form-control" placeholder="Agama">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="pendidikan_terakhir" class="form-control" placeholder="Pendidikan Terakhir">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="no_telpon" class="form-control" placeholder="No. Telpon">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="pendapatan_orangtua" class="form-control" placeholder="Pendapatan Perbulan">
                  </div>
                </div>
                <div class="section-title mt-0">PENDIDIKAN SEBELUMNYA</div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="asal_sekolah" class="form-control" placeholder="Dari Sekolah">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="kelas_sebelumnya" class="form-control" placeholder="Kelas Sebelumnya">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="no_ijzah" class="form-control" placeholder="No Ijazah">
                  </div>
                </div>
                <div class="section-title mt-0">DOKUMEN PENDUKUNG</div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Akta Kelahiran, KK, EKTP, Ijazah, NISN</label>
                    <input type="file" name="dokumen_pendukung" class="form-control" placeholder="Akta Kelahiran, KK, EKTP, Ijazah, NISN">
                  </div>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
          </div>

          </form>
        </div>
      </div>
    </section>
  </div>
</body>