<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TAMBAH PENGGUNA</title>
   
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
            <h1>TAMBAH PENGGUNA</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="petugas.php">Data Pengguna</a></div>
              <div class="breadcrumb-item text-primary">Tambah Pengguna</div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form class="wizard-content mt-2" method="post" action="proses_tambahsiswa.php">
                    <div class="section-title mt-0">DATA SANTRI</div>
                    <div class="form-row">
                    <div class="form-group row col-md-6">
                      <input type="text" name="id_petugas" class="form-control" placeholder="ID Petugas">
                    </div>
                    <div class="form-group row col-md-6">
                      <input type="text" name="username" class="form-control" placeholder="User Name">
                    </div>
                    <div class="form-group row col-md-6">
                      <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group row col-md-6">
                      <input type="text" name="nama_petugas" class="form-control" placeholder="Nama Pengguna">
                    </div>
                    <div class="form-group col-md-6">
                      <select class="form-control" name="level">
                          <option value="not_option">Level</option>
                          <?php
                                  // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                                  $query = "SELECT * FROM petugas ORDER BY level ASC";
                                  $result = mysqli_query($koneksi, $query);
                                  //mengecek apakah ada error ketika menjalankan query
                                  if(!$result){
                                    die ("Query Error: ".mysqli_errno($koneksi).
                                       " - ".mysqli_error($koneksi));
                                  }

                                  //buat perulangan untuk element tabel dari data mahasiswa
                                  $no = 1; //variabel untuk membuat nomor urut
                                  // hasil query akan disimpan dalam variabel $data dalam bentuk array
                                  // kemudian dicetak dengan perulangan while
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                  ?>
                             <option value="<?php echo $row['id_petugas']; ?>"><?php echo $row['level']; ?></option>
                             <?php
                                    $no++; //untuk nomor urut terus bertambah 1
                                  }
                                  ?>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-4"></div>
                          <div class="col-lg-4 col-md-6 text-right">
                            <button type="submit" class="btn btn-icon icon-right btn-primary">TAMBAH PENGGUNA<i class="fas fa-arrow-right"></i></button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>