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
  <link rel="stylesheet" href="Views/dist/css/informes.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="Views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
 <!--   <script src="Views/dist/js/jquery-3.0.0.min.js"></script> -->
<!-- jQuery -->
<script src="Views/plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
<script src="Views/plugins/jquery-ui/jquery-ui.min.js"></script>

  <link rel="stylesheet" href="Views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="Views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 <link rel="stylesheet" href="Views/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  
  
 <link rel="stylesheet" href="Views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- script lupa -->
 <script>

function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);
  /*create magnifier glass:*/
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");
  /*insert magnifier glass:*/
  img.parentElement.insertBefore(glass, img);
  /*set background properties for the magnifier glass:*/
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;
  /*execute a function when someone moves the magnifier glass over the image:*/
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);
  /*and also for touch screens:*/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /*prevent the magnifier glass from being positioned outside the image:*/
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /*set the position of the magnifier glass:*/
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /*display what the magnifier glass "sees":*/
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
</script>
<!-- termina script lupa -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
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
    </ul>

   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <img src="Views/dist/img/muesmerc_logo.png">
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
             <img src="Views/dist/img/User-Icon.jpg" class="img-circle" alt="User Image">
           
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php
              $datini=UsuarioController::Obten_NomUsuario();
                echo $datini;               
                 ?> </a>
        </div>
      </div>
     

      
      <!-- Sidebar Menu -->
  <?php
  include "modulos/enlaces.php"

?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
        <?php

         $mvc= new MvcController();
         $mvc-> enlacesPaginasController();
  
         ?>

  </div>
</div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="Views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="Views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- bs-custom-file-input -->
<script src="Views/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Views/dist/js/demo.js"></script>

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});
</script>
<!-- Bootstrap 3.3.7 -->
<script src="Views/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="Views/plugins/input-mask/jquery.inputmask.js"></script>
<script src="Views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="Views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- bootstrap datepicker -->
<script src="Views/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script> 
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
      //Date picker
    //$('#datepicker').datepicker({
    //  autoclose: true
   // })

    $('#datepicker2').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy' 
    })

   $('#datepicker').datepicker({
       autoclose: true,
       format: 'dd/mm/yyyy' 
   });
  
  })
</script>
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
