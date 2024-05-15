<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

?>
<!DOCTYPE html>
<html>
<style>
  #progress-container {
    display: none;
    width: 100%;
    background-color: #f3f3f3;
  }

  #progress-bar {
    width: 0;
    height: 30px;
    background-color: #4caf50;
  }
</style>

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
                  <div class="form-group col-md-6">
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
                      <option value="not_option"> Silahkan Pilih ID kelas</option>
                      <?php
                      // jalankan query untuk menampilkan semua data diurutkan berdasarkan
                      $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                      $result = mysqli_query($koneksi, $query);
                      //mengecek apakah ada error ketika menjalankan query
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }

                      $no = 1; //variabel untuk membuat nomor urut

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
                    <input class="form-control" name='tahun' type="text" id="yearPicker" value="Silahkan Pilih Tahun Masuk"> </input>
                  </div>
                </div>
                <div class="section-title mt-0">DATA ORANG TUA / WALI SANTRI</div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="nama_wali" class="form-control" placeholder="Nama Orang Tua / Wali">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="agama" class="form-control" placeholder="Agama">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="pend_terakhir" class="form-control" placeholder="Pendidikan Terakhir">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="no_telp" class="form-control" placeholder="No. Telpon">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="pendapatan" class="form-control" placeholder="Pendapatan Perbulan">
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
                    <input type="file" id="fileInput" name="dokumen" class="form-control" placeholder="Akta Kelahiran, KK, EKTP, Ijazah, NISN">
                    <div id="progress-container">
                      <div id="progress-bar"></div>
                    </div>
                    <div id="result"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function() {
    $('#yearPicker').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      endDate: "'" + new Date().getFullYear() + "'",
    });
  });

  let uploadedFilePath = null;

  function deleteFile(filePath) {
    $.ajax({
      url: 'fileupload.php',
      type: 'POST',
      data: JSON.stringify({
        action: 'delete',
        filePath: filePath
      }),
      contentType: 'application/json',
      success: function(response) {
        console.log('File deleted successfully');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Error deleting file: ' + errorThrown);
      }
    });
  }

  $(document).ready(function() {
    $('#fileInput').on('change', function() {
      var file = this.files[0];
      if (file) {
        var allowedExtensions = /(\.doc|\.docx|\.pdf)$/i;
        if (!allowedExtensions.exec(file.name)) {
          $('#result').html('<p>Error: Invalid file type. Only .doc, .docx, and .pdf files are allowed.</p>');
          $('#fileInput').val('');
          return false;
        }

        if (uploadedFilePath) {
          deleteFile(uploadedFilePath);
        }

        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
          url: 'fileupload.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          xhr: function() {
            var xhr = new XMLHttpRequest();
            xhr.upload.addEventListener('progress', function(e) {
              if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                $('#progress-container').show();
                $('#progress-bar').css('width', percentComplete + '%');
              }
            }, false);
            return xhr;
          },
          beforeSend: function() {
            $('#progress-container').show();
            $('#progress-bar').css('width', '0%');
            $('#result').html('');
          },
          success: function(response) {
            response = JSON.parse(response);
            if (response.filePath) {
              uploadedFilePath = response.filePath;
              $('#result').html('<p>File uploaded and renamed successfully!');
            } else {
              $('#result').html('<p>Error: ' + response.message + '</p>');
            }
            $('#progress-container').hide();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $('#result').html('<p>Error: ' + errorThrown + '</p>');
            $('#progress-container').hide();
          }
        });
      }
    });
  });
</script>