<?php
include "../connect.php";

// Check if SESS_USERNAME and admin_role are set to avoid errors
$loggedInUser = isset($_SESSION['SESS_USERNAME']) ? $_SESSION['SESS_USERNAME'] : '';
$adminRole = isset($_SESSION['admin_role']) ? $_SESSION['admin_role'] : '';

// Query to fetch the image filename associated with the logged-in user
$sql = "SELECT image FROM table_admin WHERE username = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $loggedInUser);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userImage = $row['image']; // Store the image filename in a variable
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
  <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
  <script src="../admin/ckeditor/ckeditor.js"></script>
</head>
<body>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="index.php"><img src="images/logo3.png" alt="logo" style="height: 50px;"></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo3.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group"></div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <span class="count"></span>
          <div class="dropdown-menu dropdown-menu-right"></div>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="uploads/<?php echo $userImage; ?>" alt="profile"/>
              <span class="nav-profile-name"><?php echo $_SESSION['SESS_USERNAME']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#" onclick="confirmLogout()">
                <i class="mdi mdi-logout text-primary"></i>
                <span>Log Out</span>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas sticky-sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
            <i class="mdi mdi-calendar menu-icon"></i>
              <span class="menu-title">Manage Events</span>
      
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
             
                <li class="nav-item"> <a class="nav-link" href="add_event.php">Add Events</a></li>
                <li class="nav-item"> <a class="nav-link" href="all_events.php">All Events</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-newspaper menu-icon"></i>
              <span class="menu-title">Manage News</span>
      
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
             
                <li class="nav-item"> <a class="nav-link" href="composenews.php">Compose News</a></li>
                <li class="nav-item"> <a class="nav-link" href="allnews.php">All News</a></li>
              </ul>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
              <i class="mdi mdi-cash-multiple menu-icon"></i>
              <span class="menu-title">Manage Donations</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic3">
              <ul class="nav flex-column sub-menu">
             
                <li class="nav-item"> <a class="nav-link" href="manageMonetary.php">Monetary Donations</a></li>
                <li class="nav-item"> <a class="nav-link" href="manageinkind.php">In-kind Donations</a></li>
                <li class="nav-item"> <a class="nav-link" href="manageInventory.php">In-kind Inventory</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
            <i class="mdi mdi-account-circle menu-icon"></i>
              <span class="menu-title">Manage Admins</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic4">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_admin.php">Admin List</a></li>
                <li class="nav-item"> <a class="nav-link" href="admin_logs.php">Admin Logs</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="manage_users.php">
            <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Manage Users</span>
            </a>
          </li>
               <!--    <i class="menu-arrow"></i>
            </a>
       <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="managevolunteers.php">
              <i class="mdi mdi-human-handsup menu-icon"></i>
              <span class="menu-title">Manage Volunteers</span>
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="addwhoweare.php">
          <i class="mdi mdi-account-multiple-outline menu-icon"></i>
              <span class="menu-title">Who We Are</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addwhatwedo.php">
              <i class="mdi mdi-briefcase-check menu-icon"></i>
              <span class="menu-title">What We Do</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">
              <i class="mdi mdi-message-processing menu-icon"></i>
              <span class="menu-title">Messages</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">


       <!-- plugins:js -->
      <script src="vendors/base/vendor.bundle.base.js"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script src="vendors/chart.js/Chart.min.js"></script>
      <script src="vendors/datatables.net/jquery.dataTables.js"></script>
      <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
      <!-- End plugin js for this page-->
      <!-- inject:js -->
      <script src="js/off-canvas.js"></script>
      <script src="js/hoverable-collapse.js"></script>
      <script src="js/template.js"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="js/dashboard.js"></script>
      <script src="js/data-table.js"></script>
      <script src="js/jquery.dataTables.js"></script>
      <script src="js/dataTables.bootstrap4.js"></script>
      <!-- End custom js for this page-->
      

      <script src="js/jquery.cookie.js" type="text/javascript"></script>

      <script>
      function confirmLogout() {
        var isConfirmed = confirm('Are you sure you want to log out?');
        if (isConfirmed) {
          window.location.href = 'logout.php';
        }
      }
      </script>

</body>
</html>