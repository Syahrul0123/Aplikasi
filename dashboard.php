<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
include('tampilan/header.php');
include('tampilan/sidebar.php');
include('tampilan/footer.php');

$query_santri = "SELECT * FROM siswa";
$query_petugas = "SELECT * FROM petugas";
$query_guru = "SELECT * FROM guru";
$result_santri = mysqli_query($koneksi, $query_santri);
$result_petugas = mysqli_query($koneksi, $query_petugas);
$result_guru = mysqli_query($koneksi, $query_guru);

if (!$result_santri || !$result_petugas || !$result_guru) {
  die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
}

$count_santriwan = 0;
$count_santriwati = 0;
$count_petugas = 0;
$count_guru = 0;

while ($row = mysqli_fetch_assoc($result_santri)) {
  if ($row['jenis_kelamin'] == 'L') { // Assuming 'L' denotes male
    $count_santriwan++;
  } elseif ($row['jenis_kelamin'] == 'P') { // Assuming 'P' denotes female
    $count_santriwati++;
  }
}

while ($row = mysqli_fetch_assoc($result_petugas)) {
  $count_petugas++;
}

while ($row = mysqli_fetch_assoc($result_guru)) {
  $count_guru++;
}
?>
<div class="main-content bg-primary">
  <section class="section">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-male fa-5x"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>SANTRIWAN</h4>
            </div>
            <div class="card-body">
              <?php echo $count_santriwan; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-female fa-xl"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>SANTRIWATI</h4>
            </div>
            <div class="card-body">
              <?php echo $count_santriwati; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>GURU</h4>
            </div>
            <div class="card-body">
              <?php echo $count_guru; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>PETUGAS</h4>
            </div>
            <div class="card-body">
              <?php echo $count_petugas; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4>PILIH TAHUN</h4>

            <div class="card-header-form">
              <div class="form-row input-group">
                <input type="text" class="form-control" id="startYearPicker" placeholder="Start Year" />
                <input type="text" class="form-control" id="endYearPicker" placeholder="End Year" />
                <div class="input-group-append">
                  <button class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive table-invoice table-container">
              <table class="table table-striped" id="yearRangeData">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tahun</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
              <div id="loading" class="justify-content-center align-items-center">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  function formatRupiah(amount) {
    // Convert the amount to a string
    amount = amount.toString();

    // Split the amount into whole and decimal parts
    var parts = amount.split('.');
    var wholePart = parts[0];
    var decimalPart = parts.length > 1 ? '.' + parts[1] : '';

    // Add separators for thousands
    wholePart = wholePart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Return the formatted amount with the currency symbol
    return 'Rp ' + wholePart + decimalPart;
  }
  // Initialize start year picker
  $("#startYearPicker").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    autoclose: true,
  });

  // Initialize end year picker
  $("#endYearPicker").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    autoclose: true,
  });

  $("#submitBtn").on("click", function() {
    var startYear = $("#startYearPicker").val();
    var endYear = $("#endYearPicker").val();
    $("#loading").css("display", "flex");
    // Create an object to store the data
    var data = {
      startYear: startYear,
      endYear: endYear,
    };

    // Perform POST request using jQuery
    $.post("billcount.php", data)
      .done(function(response) {
        $("#loading").hide();
        // Handle success response here
        var jsonData = JSON.parse(response);
        // Clear existing table rows
        $("#yearRangeData tbody").empty();
        // Initialize row number counter
        var rowNum = 1;

        jsonData.forEach(function(row) {
          $("#yearRangeData tbody").append(
            "<tr>" +
            "<td>" + rowNum + "</td>" +
            "<td>" + row.tahun_dibayar + "</td>" +
            "<td>" + formatRupiah(row.total_jumlah_bayar) + "</td>" +
            "</tr>"
          );

          // Increment row number counter
          rowNum++;
        });
      })
      .fail(function(error) {
        $("#loading").hide();
        // Handle error response here
        console.error("Error:", error);
      });
  });
</script>