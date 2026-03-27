<?php
if (isset($_SESSION['REMOTE_ADDR'])) {
  if ($_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
    //terminar la session
    header('Location: ../Proyectos');
    http_response_code(403);
    die;
  }
} else {//session_start();

  header('Location: ../Proyectos');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calidad Sg</title>
  <!-- ESTILOS RESPONSIVE -->
  <link rel="stylesheet" href="assets/dist/css/responsive2.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/full_calendar/css/fullcalendar.css" type="text/css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="assets\dist\js\validaciones.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
  

  <!-- SweetAlert CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <style>
    @media (max-width: 720px) {
      #Graficas {
        display: none !important;
      }
    }
  </style> -->

</head>
<?php //echo "este es un operario" ?>
<body class="hold-transition sidebar-mini sidebar-collapse">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a  class="nav-link res-tittle" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-user"> <?php echo strtoupper($_SESSION['fullName']); ?></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        </li>
        <li class="nav-item">
          <a href="?c=usuarios&a=cerrar" class="nav-link">
            <i class="fa fa-power-off"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="?c=usuarios&a=home" class="brand-link">
        <img src="assets\dist\img\prueba.png" alt="Logo" class="brand-image " style="opacity: .8">
        <span class="brand-text font-weight-light">CalidadSG</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Configuración
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="?c=plantillas&a=index" class="nav-link">
                    <i class="fa fa-file nav-icon"></i>
                    <p>Plantillas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?c=procesos&a=index" class="nav-link">
                    <i class="fa fa-server nav-icon"></i>
                    <p>Procesos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?c=permisos&a=index" class="nav-link">
                    <i class="fa fa-key nav-icon"></i>
                    <p>Seguridad</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  CRM
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?c=usuarios&a=usuarios" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>Funcionarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?c=clientes&a=interesados" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Interesados</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?c=clientes&a=index&tp=1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Prospectos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?c=clientes&a=index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>
              </ul>
            </li> -->


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                   Proyectos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?c=proyectos&a=IndexOperario" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>Asignados</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="?c=proyectos&a=indexoff" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactivos</p>
                  </a>
                </li> -->
              </ul>
            </li>

            <!-- <li class="nav-item">
              <a href="?c=informes&a=reportes" class="nav-link">
                <i class="nav-icon fa fa-balance-scale" aria-hidden="true"></i>
                <p>Reporte</p>
              </a>
            </li> -->

            <!-- <li class="nav-header">Agenda</li>
            <li class="nav-item">
              <a href="views/horarios/obtener.php" class="nav-link" target="_blank">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendario
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li> -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="?c=usuarios&a=home">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo ucwords($_REQUEST['c']) ?></a></li>
                <li class="breadcrumb-item active"><?php echo ucwords($_REQUEST['a']) ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- /.content-wrapper -->