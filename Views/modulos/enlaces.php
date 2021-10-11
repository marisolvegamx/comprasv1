 <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      
      <!-- Sidebar Menu -->
     <ul class="sidebar-menu" data-widget="tree">
  
         <?php
            $ingreso = new enlacesController();
            $ingreso -> listaopciones();
            ?>  

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>