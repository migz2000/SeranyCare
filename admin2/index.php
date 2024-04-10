<?php
session_start();
if(!isset($_SESSION['SESS_USERNAME'])){
    header("location: sign-in.php");
}

include "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Serany Foundation</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- Example: Font Awesome CDN link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/logo3.png" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->

  <!-- Bootstrap 4 Dropdown JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
           
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">


                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-cash-multiple icon-lg me-3 text-success"></i>
                        
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Cash Donations</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary  p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA"  aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">25,000</h5>
                              </a>
                             
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-account-box me-3 icon-lg text-primary"></i>
            <?php            
                        // Query to fetch total users from the database
                        $sql = "SELECT COUNT(*) AS total_users FROM login";
                        $result = $conn->query($sql);

                        // Check if query was successful
                        if ($result->num_rows > 0) {
                            // Fetch data
                            $row = $result->fetch_assoc();
                            $total_users = $row["total_users"];
                        } else {
                            $total_users = 0;
                        }


                        ?>

                        <!-- HTML code with PHP replaced -->
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Users</small>
                            <h5 class="me-2 mb-0"><?php echo $total_users; ?></h5>
                        </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                            <i class="mdi mdi-human-handsup me-3 icon-lg text-success"></i>
                        <?php                    
                        // Query to fetch total volunteers from the database
                        $sql = "SELECT COUNT(*) AS total_volunteers FROM volunteers";
                        $result = $conn->query($sql);

                        // Check if query was successful
                        if ($result->num_rows > 0) {
                            // Fetch data
                            $row = $result->fetch_assoc();
                            $total_volunteers = $row["total_volunteers"];
                        } else {
                            $total_volunteers = 0;
                        }


                        ?>

                        <!-- HTML code with PHP replaced -->
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Volunteers</small>
                            <h5 class="me-2 mb-0"><?php echo $total_volunteers; ?></h5>
                        </div>

                        </div>
                       <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                       <i class="mdi mdi-wallet-giftcard me-3 icon-lg text-warning"></i>
                        
                       <?php
                       $sql = "SELECT COUNT(*) AS total_donations FROM inkind";
                        $result = $conn->query($sql);

                        // Step 3: Display the total number of donations in the admin panel
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalDonations = $row["total_donations"];

                        } else {
                            echo "No donations found.";
                        }
                        ?>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total In-Kind Donations</small>
                            <h5 class="me-2 mb-0"><?php echo $totalDonations; ?></h5>
                          </div>
                        </div>
                      <!--  <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>-->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Total Cash Donation By Date (Bar Graph)</p>
                    <canvas id="cash-deposits-chart-bar" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>
<?php
        // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT type, COUNT(*) as count FROM inkind GROUP BY type";
$result = $conn->query($sql);

// Prepare data for the pie chart
$labels = [];
$data = [];
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['type'];
    $data[] = (int)$row['count'];
}


?>
        <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <p class="card-title">Total In-Kind Donations (Pie Chart)</p>
            <canvas id="inkind-donations-chart-pie" style="width: 100%;"></canvas>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('inkind-donations-chart-pie').getContext('2d');
    var inkindDonationsChartPie = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Total In-Kind Donations',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    '#E7625F',
                    '#C85250',
                    '#F7BEC0',
                    '#E9EAE0',
                    '#391306',
                    '#AA1945'
                ],
                borderColor: [
                  '#391306',
                    '#391306',
                    '#391306',
                    '#391306',
                    '#391306',
                    '#391306'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            title: {
                display: true,
                text: 'Total In-Kind Donations'
            }
        }
    });
</script>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Total Cash Donation By Date (Line Chart)</p>
                    <canvas id="cash-deposits-chart-line" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to initialize and configure the bar graph
        var ctxBar = document.getElementById('cash-deposits-chart-bar').getContext('2d');
        var myBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['January', 'March', 'June', 'September', 'December'], // Example labels
                datasets: [{
                    label: 'Cash Donation',
                    data: [1000, 1000, 1500, 3000, 2500], // Example data
                    backgroundColor: [
                      '#E7625F',
                    '#C85250',
                    '#F7BEC0',
                    '#E9EAE0',
                    '#391306',
                    '#AA1945'
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

       

        // JavaScript to initialize and configure the line chart
        var ctxLine = document.getElementById('cash-deposits-chart-line').getContext('2d');
        var myLineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'], // Example labels
                datasets: [{
                    label: 'Cash Donation',
                    data: [1000, 2000, 1500, 3000, 2500], // Example data
                    borderColor: 'orange',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                // Add options here (if needed)
            }
        });
    </script>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title mt-2">List of Users</h4>
                </div>
                <div class="col-4">                
                    <div class="d-flex justify-content-end mb-2">
                        <form method="post" action="manage_users.php" class="manage-users-btn">
                            <button type="submit" name="manage_users" class="btn btn-dark btn-sm">
                                Manage Users <i class="fas fa-users" style="font-size: 1.2em;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add the table for users inside the card body -->
            <div class="table-responsive">
                <table id="usersTable" class="table">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Contact Number</th>
                          <th>User Status</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            $users_result = $db->prepare("SELECT id, first_name, middle_name, last_name, email, address, contact_number, status FROM login ORDER BY id DESC");
                            $users_result->execute();
                            $i = 1;
                            while ($user_row = $users_result->fetch()) {
                                $status = $user_row['status'];
                                $statusText = '';
                                $statusColor = '';

                                switch ($status) {
                                    case 0:
                                        $statusText = 'Pending';
                                        $statusColor = '#EE9626';
                                        break;
                                    case 1:
                                        $statusText = 'Verified';
                                        $statusColor = 'green';
                                        break;
                                    case 2:
                                        $statusText = 'Disabled';
                                        $statusColor = 'red';
                                        break;
                                    default:
                                        $statusText = 'Unknown';
                                        $statusColor = 'black';
                                        break;
                                }
                                // Concatenate first name, middle name, and last name
                                $fullName = $user_row['first_name'] . ' ' . $user_row['middle_name'] . ' ' . $user_row['last_name'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $fullName; ?></td>
                                    <td><?php echo $user_row['email']; ?></td>
                                    <td><?php echo $user_row['address']; ?></td>
                                    <td><?php echo $user_row['contact_number']; ?></td>
                                    <td style="color: <?php echo $statusColor; ?>"><?php echo $statusText; ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- End of users table -->
            </div>
        </div>
    </div>
</div>

<!-- DataTables script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<!-- End DataTables script -->
<script>
    $(document).ready(function () {
    $('#usersTable').DataTable();
  });
  function confirmLogout() {
    var isConfirmed = confirm('Are you sure you want to log out?');
    if (isConfirmed) {
      window.location.href = 'logout.php';
    }
  }
</script>

</body>
</html>

