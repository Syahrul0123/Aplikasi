<?php
include 'koneksi.php';
 
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=data-transaksi.doc");
function format_rupiah($angka){
    $rupiah = "Rp " . number_format($angka,0,',','.');
    return $rupiah;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 9">
<meta name=Originator content="Microsoft Word 9">
<title>Kwitansi Pembayaran SPP SMK Mahardhika</title>
<style>
	 @page Section1 {size:595.45pt 841.7pt; margin:1.0in 1.25in 1.0in 1.25in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
	div.Section1 {page:Section1;}
	@page Section2 {size:841.7pt 595.45pt;mso-page-orientation:landscape;margin:1.25in 1.0in 1.25in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
	div.Section2 {page:Section2;}
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }

	th.number {
        width: 50px; /* Adjust width for number */
    }
    th.nisn {
        width: 100px; /* Adjust width for name */
    }
    th.address {
        width: 300px; /* Adjust width for address */
    }
	td {
  height: 30px;
}
th {
  height: 50px;
}
</style>
</head>

<body>
<div class=Section2>
 <?php
  if (isset($_POST['daritanggal'])) {
    $daritanggal = ($_POST['daritanggal']);
 $sampaitanggal = ($_POST['sampaitanggal']);
 ?>
<p align="center">DATA TRANSAKSI PEMBAYARAN SPP </p>
<p align="center">SMK MAHARDHIKA</p>
<p align="center">DARI TANGGAL <?php echo $daritanggal;?> SAMPAI TANGGAL <?php echo $sampaitanggal;?></p>
  <table>
      <thead style='background-color: #D1C4E9;'>
        <tr>
          <th class="number">No</th>
          <th class="nisn">NISN</th>
          <th calss="address">Nama</th>	
		  <th>Kelas</th>
		    <th>Tanggal Bayar</th>
			  <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
			<th class="nisn">Petugas</th>
			<th>Jumlah Bayar</th>
          
    </thead>
    <tbody>
      <?php
    $query = "SELECT * FROM pembayaran,siswa,spp,petugas,kelas WHERE pembayaran.nisn=siswa.nisn AND siswa.id_spp=spp.id_spp AND pembayaran.id_petugas=petugas.id_petugas AND siswa.id_kelas=kelas.id_kelas AND (pembayaran.tgl_bayar between '$daritanggal' AND '$sampaitanggal')";
    $result = mysqli_query($koneksi, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
    }
	$total_amount = 0;
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
  ?>
       <tr>
          <td align="center"><?php echo $no; ?></td>
          <td align="center"><?php echo $data['nisn']; ?></td>
		  <td align="center"><?php echo $data['nama']; ?></td>
		  <td align="center"><?= $kelasnow; ?> - <?= $data['nama_kelas']; ?></td>
		  <td align="center"><?php echo $data['tgl_bayar']; ?></td>
		  <td align="center"><?php echo $data['bulan_dibayar']?></td>
		  <td align="center"><?php echo $data['tahun_dibayar']; ?></td>
		  <td align="center"><?php echo $data['nama_petugas']; ?></td>
		  <td align="center"><?php echo format_rupiah($data['jumlah_bayar']); ?></td>
      </tr>
      <?php
	  $total_amount += $data['jumlah_bayar'];
	  $no++; 
      }
	  }
      ?>
	<tr>
    <td colspan='8' align='right'><strong>Total:</strong></td>
    <td align='center'><strong><?php echo format_rupiah($total_amount) ?></strong></td>
    </tr>
    </tbody>
    </table>
</div>
</body>
</html>