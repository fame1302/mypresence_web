<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My Presence - <?= $page_data['title']; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url(); ?>/sb_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>/sb_admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">


  <link href="<?= base_url(); ?>/sb_admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <?php if ($page_data['sub_title'] == 'Lokasi') : ?>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css" type="text/css" />
    <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

  <?php endif ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-address-card"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My Presence</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= ($page_data['sub_title'] == 'Dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url(); ?>/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Kelola Karyawan
      </div>

      <!-- Nav Item - Jabatan -->
      <li class="nav-item <?= ($page_data['title'] == 'Jabatan') ? 'active' : ''; ?>">
        <a class="nav-link" href="/admin/jabatan">
          <i class="fas fa-fw fa-id-badge"></i>
          <span>Jabatan</span></a>
      </li>

      <!-- Nav Item - Karyawan -->
      <li class="nav-item <?= ($page_data['title'] == 'Karyawan') ? 'active' : ''; ?>">
        <a class="nav-link  <?= ($page_data['title'] == 'Karyawan') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded=" <?= ($page_data['title'] == 'Karyawan') ? 'true' : 'false'; ?>" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-users"></i>
          <span>Karyawan</span>
        </a>
        <div id="collapseUtilities" class="collapse <?= ($page_data['title'] == 'Karyawan') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Karyawan</h6>
            <a class="collapse-item <?= (($page_data['sub_title'] == 'Daftar Karyawan') || ($page_data['sub_title'] == 'Edit Karyawan')) ? 'active' : ''; ?>" href="<?= base_url(); ?>/admin/karyawan">Lihat Karyawan</a>
            <a class="collapse-item <?= ($page_data['sub_title'] == 'Tambah Karyawan') ? 'active' : ''; ?>" href="<?= base_url(); ?>/admin/tambah_karyawan">Tambah Karyawan</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Kelola Jadwal
      </div>

      <!-- Nav Item - Karyawan -->
      <li class="nav-item <?= ($page_data['title'] == 'Jadwal') ? 'active' : ''; ?>">
        <a class="nav-link  <?= ($page_data['title'] == 'Jadwal') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded=" <?= ($page_data['title'] == 'Jadwal') ? 'true' : 'false'; ?>" aria-controls="collapseUtilities2">
          <i class="fas fa-fw fa-calendar-check"></i>
          <span>Jadwal</span>
        </a>
        <div id="collapseUtilities2" class="collapse <?= ($page_data['title'] == 'Jadwal') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Jadwal</h6>
            <a class="collapse-item <?= (($page_data['sub_title'] == 'Tambah Profil Jadwal') || ($page_data['sub_title'] == 'Profil Jadwal')) ? 'active' : ''; ?>" href="<?= base_url(); ?>/admin/profil_jadwal"><span class="fa fa-tasks mr-2"></span> Profil Jadwal</a>
            <a class="collapse-item <?= (($page_data['sub_title'] == 'Tambah Profil Jadwal') || ($page_data['sub_title'] == 'Lokasi')) ? 'active' : ''; ?>" href="<?= base_url(); ?>/admin/lokasi"><span class="fas fa-map-marker mr-2"></span> Lokasi</a>
            <a class="collapse-item <?= ($page_data['sub_title'] == 'Tambah Jadwal') ? 'active' : ''; ?>" href="<?= base_url(); ?>/admin/tambah_Jadwal">Tambah Jadwal</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Fahmi Pamungkas</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->


        <?= $this->renderSection('content'); ?>


        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Fahmi Pamungkas 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?= $this->renderSection('scripts'); ?>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url(); ?>/sb_admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/sb_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url(); ?>/sb_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url(); ?>/sb_admin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url(); ?>/sb_admin/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url(); ?>/sb_admin/js/demo/chart-area-demo.js"></script>
  <script src="<?= base_url(); ?>/sb_admin/js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url(); ?>/sb_admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>/sb_admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url(); ?>/sb_admin/js/demo/datatables-demo.js"></script>

  <!-- custom -->
  <script src="<?= base_url(); ?>/js/script.js"></script>
  <script src="<?= base_url(); ?>/js/location.js"></script>
</body>

</html>