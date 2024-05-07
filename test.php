<?php
include 'koneksi.php';
function format_rupiah($angka){
    $rupiah = "Rp " . number_format($angka,0,',','.');
    return $rupiah;
}
  if (isset($_POST['daritanggal'])) {
    $daritanggal = ($_POST['daritanggal']);
 $sampaitanggal = ($_POST['sampaitanggal']);
 
    $query = "SELECT * FROM pembayaran,siswa,spp,petugas,kelas WHERE pembayaran.nisn=siswa.nisn AND siswa.id_spp=spp.id_spp AND pembayaran.id_petugas=petugas.id_petugas AND siswa.id_kelas=kelas.id_kelas AND (pembayaran.tgl_bayar between '$daritanggal' AND '$sampaitanggal')";
    $result = mysqli_query($koneksi, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
    }
   $no=1;
	  while ($data = mysqli_fetch_assoc($result)){
   $tahunsekarang=date('Y');
	  $tahunmasuksiswa=$data['tahun'];
	  $diff  = ($tahunsekarang-$tahunmasuksiswa) ;   
	  if($diff==0){
	  $kelasnow="X";
	  }
	  
	  else if($diff==1){
	  $bulansekarang=date('n');
	  if($bulansekarang==7 ||$bulansekarang==8 ||$bulansekarang== 9 ||$bulansekarang==10 || $bulansekarang==11 || $bulansekarang==12){
	  $kelasnow= "XI";
	  }
	  else{
	  $kelasnow="X";
	  }
	  }
	  
	  else if($diff==2){
	  $bulansekarang=date('n');
	  if($bulansekarang==7 ||$bulansekarang==8 ||$bulansekarang== 9 ||$bulansekarang==10 || $bulansekarang==11 || $bulansekarang==12){
	  $kelasnow= "XII";
	  }
	  else{
	  $kelasnow="XI";
	  }
	  }
	  
	  else if($diff==3){
	  $bulansekarang=date('n');
	  if($bulansekarang==7 ||$bulansekarang==8 ||$bulansekarang== 9 ||$bulansekarang==10 || $bulansekarang==11 || $bulansekarang==12){
	  $kelasnow= "alumni";
	  }
	  else{
	  $kelasnow="XII";
	  }
	  }
	  
	  else if($diff>3){
	 
	  $kelasnow="alumni";
	  
	  }  
    }
}
  ?>