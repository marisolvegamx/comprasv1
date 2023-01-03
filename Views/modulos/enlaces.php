
 <?php

require "Controllers/menuController.php";
 ?>
  
  
   <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
         <?php $menuController=new MenuController();
        echo $menuController->desplegarMenu();?>
     

         
             
              <li class="nav-item">
                <a href='index.php?salir=1' class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salir</p>
                </a>
              </li>
              
            
    
      </nav>
     