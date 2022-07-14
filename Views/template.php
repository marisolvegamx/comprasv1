<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script scr="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap" async defer></script>
   
  <title>Muesmerc | Sistema de Compras</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="Views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
 <!--   <script src="Views/dist/js/jquery-3.0.0.min.js"></script> -->

<!-- jQuery -->
<script src="Views/plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
<script src="Views/plugins/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="Views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="Views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 <link rel="stylesheet" href="Views/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/dist/css/adminlte.css">
  <link rel="stylesheet" href="Views/plugins/select2/css/select2.min.css">
 <link rel="stylesheet" href="Views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


</head>


<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
<header >
<div class="wrapper ">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-gray">
      <!-- Sidebar toggle button-->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
     
           <ul class="navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          

          <!-- Notifications Menu -->
          
          <!-- Tasks Menu -->
         
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">

            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-togglen" data-toggle="dropdown">
              </br>
              <img src="Views/dist/img/User-Icon.jpg" class="user-image" >

              <span style="color: #000000;">
              <?php
              $datini=UsuarioController::Obten_NomUsuario();
                echo $datini;               
                 ?> 

              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="Views/dist/img/User-Icon.jpg" class="img-circle" alt="User Image">
                <p>
                <?php
                  $datini=UsuarioController::Obten_NomUsuario();
                  echo $datini;

                  $cargo=UsuarioController::Obten_Cargo();
                  echo "<small>".$cargo."</small>";               
                 ?>
                  
                  </p>
                
              </li>
              
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                  <a href='index.php?salir=1' class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
            
     </li>     
         
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>  <!-- /.navbar -->

</header>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <img src="Views/dist/img/muesmerc_logo.png">
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Catalogos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=listan1" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listan2&admin=lis" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Regiones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listan3&admin=lis" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Paises</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listaciures" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Ciudades con Geocercas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=listan4&admin=lis" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Ciudades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listan5&admin=lis" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Plantas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listan6&admin=lis" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Siglas de Planta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listamesas&op=mes&admin=lis" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Indices</p>
                </a>
              </li>

               

              <li class="nav-item">
                <a href="index.php?action=listarecolector" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Recolectores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listaunegocio" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Tiendas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listaprod" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listaatributos" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Daños</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listasustitucion" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Listas de Sustitución</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="index.php?action=listacausas" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Causas de NO Compra</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=listacatalogos&admin=1" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Generales</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Planeación
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=listacompra" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Listas de Compra</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=presentamapa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Geocerca</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=direccion" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direccion</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-thumbs-up"></i>
              <p>
                Supervisión
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=suplistainformes" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Asignación</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=suplistainformes" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>Reportes</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v1</p>
                    </a>
                  </li>
                </ul>
              </li>
             
            </ul>
          </li>
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
        <?php

         $mvc= new MvcController();
         $mvc-> enlacesPaginasController();
  
         ?>

  </div>
</div>
</div>
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>


  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="Views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/dist/js/adminlte.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/dist/js/adminlte.js"></script>
<script src="Views/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Views/dist/js/demo.js"></script>


<!-- Bootstrap 3.3.7 -->
<script src="Views/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="Views/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/plugins/inputmask/jquery.inputmask.js"></script>

<script src="Views/dist/js/adminlte.min.js"></script>

<script src="Views/bower_components/moment/min/moment.min.js"></script>
<script src="Views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="Views/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="Views/dist/js/demo.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script src="Views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="Views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="Views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="Views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="Views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="Views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="Views/plugins/jszip/jszip.min.js"></script>
<script src="Views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="Views/plugins/pdfmake/vfs_fonts.js"></script>
<script src="Views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="Views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="Views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Views/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
