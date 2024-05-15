<?php
include('koneksi.php');

// Set up pagination parameters
$perPage = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Fetch total number of records from the database based on search query
$search = isset($_GET['search']) ? $_GET['search'] : '';
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM siswa WHERE nisn LIKE '%$search%' OR nis LIKE '%$search%' OR nama LIKE '%$search%'";
$totalRecordsResult = mysqli_query($koneksi, $totalRecordsQuery);
$totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
$totalRecords = $totalRecordsRow['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $perPage);

// Calculate the offset
$offset = ($page - 1) * $perPage;

// Fetch data from the database based on pagination and search criteria
$query = "SELECT * FROM siswa WHERE nisn LIKE '%$search%' OR nis LIKE '%$search%' OR nama LIKE '%$search%' ORDER BY nisn ASC LIMIT $perPage OFFSET $offset";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
}

// Generate HTML for table rows
$output = '';
$no = ($page - 1) * $perPage + 1; // Calculate initial numbering for the current page
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<tr>';
    $output .= '<td>' . $no . '</td>';
    $output .= '<td>' . $row['nisn'] . '</td>';
    $output .= '<td>' . $row['nis'] . '</td>';
    $output .= '<td>' . $row['nama'] . '</td>';
    $output .= '<td>' . $row['id_kelas'] . '</td>';
    $output .= '<td>' . $row['alamat'] . '</td>';
    $output .= '<td>' . $row['no_telp'] . '</td>';
    $output .= '<td>' . $row['jenis_kelamin'] . '</td>';
    $output .= '<td>' . $row['tahun'] . '</td>';
    $output .= '<td>';
    $output .= '<a href="edit_siswa.php?id=' . $row['nisn'] . '" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    $output .= '<a href="proses_hapussiswa.php?id=' . $row['nisn'] . '" class="btn btn-danger" onClick="return confirm(\'Anda yakin akan menghapus data ini?\')"><i class="fas fa-trash"></i></a>';
    $output .= '</td>';
    $output .= '</tr>';
    $no++; // Increment numbering for the next row
}

// Output the HTML content along with the total pages
echo json_encode(array('html' => $output, 'totalPages' => $totalPages));
