<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
include('tampilan/header.php');
include('tampilan/sidebar.php');
include('tampilan/footer.php');
// jalankan query untuk menampilkan semua data diurutkan berdasarkan id
$query_santri = "SELECT * FROM siswa"; // Query for students
$query_petugas = "SELECT * FROM petugas"; // Query for petugas members
$result_santri = mysqli_query($koneksi, $query_santri);
$result_petugas = mysqli_query($koneksi, $query_petugas);

// Check for errors in query execution
if (!$result_santri || !$result_petugas) {
  die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
}

// Initialize counters
$count_santriwan = 0;
$count_santriwati = 0;
$count_petugas = 0;

// Count students
while ($row = mysqli_fetch_assoc($result_santri)) {
  // Assuming 'jenis_kelamin' is the column for gender in the 'siswa' table
  if ($row['jenis_kelamin'] == 'L') { // Assuming 'L' denotes male
    $count_santriwan++;
  } elseif ($row['jenis_kelamin'] == 'P') { // Assuming 'P' denotes female
    $count_santriwati++;
  }
}

// Count petugas members
while ($row = mysqli_fetch_assoc($result_petugas)) {
  // Adjust the condition according to the actual column name for gender in the 'petugas' table
  // Assuming 'jenis_kelamin' is the column for gender in the 'petugas' table
  // If the column name or values are different, adjust accordingly
  $count_petugas++;
}

?>
<!-- Main Content -->
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
              1,201
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Invoices</h4>
            <div class="card-header-action">
              <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive table-invoice">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Invoice ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </tr>
                  <tr>
                    <td><a href="#">INV-87239</a></td>
                    <td class="font-weight-600">Kusnadi</td>
                    <td>
                      <div class="badge badge-warning">Unpaid</div>
                    </td>
                    <td>July 19, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-48574</a></td>
                    <td class="font-weight-600">Hasan Basri</td>
                    <td>
                      <div class="badge badge-success">Paid</div>
                    </td>
                    <td>July 21, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-76824</a></td>
                    <td class="font-weight-600">Muhamad Nuruzzaki</td>
                    <td>
                      <div class="badge badge-warning">Unpaid</div>
                    </td>
                    <td>July 22, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-84990</a></td>
                    <td class="font-weight-600">Agung Ardiansyah</td>
                    <td>
                      <div class="badge badge-warning">Unpaid</div>
                    </td>
                    <td>July 22, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-87320</a></td>
                    <td class="font-weight-600">Ardian Rahardiansyah</td>
                    <td>
                      <div class="badge badge-success">Paid</div>
                    </td>
                    <td>July 28, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                </tbody>
              </table>
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