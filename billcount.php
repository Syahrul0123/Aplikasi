<?php
// handle_post.php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startYear = $_POST["startYear"];
    $endYear = $_POST["endYear"];
    $query = "SELECT tahun_dibayar, SUM(jumlah_bayar) AS total_jumlah_bayar FROM pembayaran WHERE tahun_dibayar BETWEEN $startYear AND $endYear GROUP BY tahun_dibayar";
    // Generate sample data (replace this with your actual data retrieval logic)
    $result = mysqli_query($koneksi, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Convert the PHP array to JSON
    $json_data = json_encode($data);

    // Output the JSON data
    echo $json_data;
} else {
    // If the request method is not POST, return an error message
    echo "Error: This endpoint only accepts POST requests.";
}
