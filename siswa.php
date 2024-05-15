<!DOCTYPE html>
<html>

<head>
  <title>DATA SISWA</title>
</head>

<body>

  <?php
  // Include header, sidebar, and footer
  include('tampilan/header.php');
  include('tampilan/sidebar.php');
  include('tampilan/footer.php');
  ?>

  <!-- Main Content -->
  <div class="main-content bg-primary">
    <section class="section">
      <div class="section-header">
        <h1>DATA SISWA</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
          <div class="breadcrumb-item text-primary">Data Siswa</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>LIST SISWA</h4>
              <div class="card-header-form">
                <form class="form-inline">
                  <div class="input-group-btn">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search">
                  </div>
                  <a href="tambah_siswa.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                </form>
              </div>
            </div>
            <div class="card-body p-0 ">
              <div class="col-md-12">
                <div class="table-responsive ">
                  <table class="table table-striped ">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>ID KELAS</th>
                        <th>ALAMAT</th>
                        <th>NO TELP</th>
                        <th>JENIS KELAMIN</th>
                        <th>ID SPP</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody">
                      <!-- Table rows will be filled dynamically via AJAX -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-body">
              <nav aria-label="Page navigation" class="pagination-container md-2">
            </div>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    $(document).ready(function() {
      // Function to generate pagination links
      function generatePagination(totalPages, currentPage) {
        var paginationContainer = $('.pagination-container');
        paginationContainer.empty(); // Clear previous pagination links

        var ul = $('<ul class="pagination"></ul>');

        // Add "Previous" link
        if (currentPage > 1) {
          ul.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (currentPage - 1) + '">Previous</a></li>');
        }

        // Add individual page links
        for (var i = 1; i <= totalPages; i++) {
          ul.append('<li class="page-item ' + (currentPage === i ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
        }

        // Add "Next" link
        if (currentPage < totalPages) {
          ul.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (currentPage + 1) + '">Next</a></li>');
        }

        paginationContainer.append(ul);

        // Attach event listener for page links
        paginationContainer.find('.page-link').click(function(e) {
          e.preventDefault();
          var page = parseInt($(this).attr('data-page'));
          var searchQuery = $('#searchInput').val(); // Get search query
          fetchData(page, searchQuery); // Update content based on the clicked page and search query
        });
      }

      // Function to fetch data based on page number and search query
      function fetchData(page, searchQuery = '') {
        $.ajax({
          url: 'fetch_siswa.php', // URL to fetch data from
          type: 'GET',
          data: {
            page: page,
            search: searchQuery // Pass search query to the backend
          },
          dataType: 'json', // Expect JSON response
          success: function(response) {
            // Update table body with fetched data
            $('#tableBody').html(response.html);

            // Generate pagination links based on total pages
            generatePagination(response.totalPages, page);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data:', errorThrown);
          }
        });
      }

      // Example: Initial setup with page 1
      fetchData(1);

      // Event listener for search input
      $('#searchInput').on('keyup', function() {
        var searchQuery = $(this).val(); // Get search query
        fetchData(1, searchQuery); // Update content with search query and reset to page 1
      });
    });
  </script>
</body>

</html>