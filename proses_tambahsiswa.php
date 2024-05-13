<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// membuat variabel untuk menampung data dari form
$nama             = $_POST['nama'];
$nisn             = $_POST['nisn'];
$nis              = $_POST['nis'];
$id_kelas         = $_POST['id_kelas'];
$alamat           = $_POST['alamat'];
$jenis_kelamin    = $_POST['jenis_kelamin'];
$tempat_tgl_lahir = $_POST['tempat_tgl_lahir'];
$tahun              = $_POST['tahun'];

//data wali murid
$nama_wali        = $_POST['nama_wali'];
$agama            = $_POST['agama'];
$pend_terakhir    = $_POST['pend_terakhir'];
$pekerjaan        = $_POST['pekerjaan'];
$no_telp          = $_POST['no_telp'];
$pendapatan       = $_POST['pendapatan'];

//pendidikan terakhir
$asal_sekolah       = $_POST['asal_sekolah'];
$tahun_lulus        = $_POST['tahun_lulus'];
$kelas_sebelumnya   = $_POST['kelas_sebelumnya'];
$no_ijzah           = $_POST['no_ijzah'];
$dokumen            = $_POST['dokumen'];


$query = "INSERT INTO siswa VALUES ('$nisn', '$nis','$nama', '$id_kelas', '$alamat', '$tahun')";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  //tampil alert dan akan redirect ke halaman index.php
  //silahkan ganti index.php sesuai halaman yang akan dituju
  echo "<script>alert('Data berhasil ditambah.');window.location='siswa.php';</script>";
}
