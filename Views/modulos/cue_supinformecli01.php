<?php

        $informeCont=new SupInfmuestraController();
        $informeCont->vistaSupInfMuesController();
        $dirimg= $informeCont->getdirimg();  
        $idticket= $informeCont->getidticket();
        $idprodex= $informeCont->getidprodex();
        $server="/compras/fotografias/";
        $numinf= $informeCont->getidinf();
        $idmes= $informeCont->getidmes();
        $idrec= $informeCont->getidrec();
        $idcli= $informeCont->getidcli();
        $indice =$informeCont->getindice();
        $coment =$informeCont->getcoment();
        $nomrec =$informeCont->getnomrec();
        $fecrep =$informeCont->getfecrep();
        $horrep =$informeCont->gethorarep();
        $nomclien =$informeCont->getnomclien();
        $nomplan =$informeCont->getnomplan();
        $nomtien =$informeCont->getnomtien();
        $idinf =$informeCont->getidinf();
        $idtien =$informeCont->getidtien();
        $numtien =$informeCont->getnumtien();
        $first =$informeCont->getidfirst();        
        $ant =$informeCont->getidant();
        $sig = $informeCont->getidsig();
        $last = $informeCont->getlast();

        include "Utilerias/leevar.php";
        if ($admin=="cor"){
            $informeCont->noaceptarprodex(); 
          } else if ($admin=="aceptar"){
            $informeCont->aceptarsec1();   
          } else if ($admin=="noap"){
            $informeCont->noaplicasec1();
          } else if ($admin=="solcor"){  
            $informeCont->solcorreccion();
          } else if ($admin=="actcat"){  
            $informeCont->actcatalogoimg();  
           } else if ($admin=="edic"){
 
          }
?>




<div class="row" style="margin-top: 5px;">
      <div class="col-md-10 tituloSup" >INFORME DE COMPRA
      </div>
      <div class="col-md-1 tituloSup2" >PANTALLA 4
      </div>
      <div class="col-md-1 " >
              <div class="row">
                <?php
                echo '
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli01&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&cli='.$idcli.'"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli01&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&cli='.$idcli.'"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&cli='.$idcli.'"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&cli='.$idcli.'"><img src="Views/dist/img/Avanza-Final.jpg"></a>
                </div>
                ';
                ?>
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">CLIENTE:
      </div>
      <div class="col-md-2 labelAzulDato">
        <?php
        echo $nomclien;
        ?>
        
      </div>
      <div class="col-md-1 labelAzul1">ÍNDICE:
      </div>
      <div class="col-md-2 labelAzulDatoFecha">
        <?php
        echo $indice;
        ?>
      </div>
      <div class="col-md-1 labelAzul1">PLANTA:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php
        echo $nomplan;
        ?>
      </div>
      <div class="col-md-1 labelAzul1">TIENDA 
        <?php
        echo $numtien;
        ?>

      </div>
      <div class="col-md-1 ">
      <div class="row">
               <div class="col-md-3 tituloSupBotones" ><a 
                <?php

                if ($first){
                    echo '  
                   href="index.php?action=supinformecli01&idmes='.$idmes.'&idrec='.$idrec.'&id='.$first.'&cli='.$idcli.'"';
                } else {
                  echo 'href="#"';
                }
                
                
                ?>
                ><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>
               <div class="col-md-3 tituloSupBotones" ><a 
                 <?php
                 if ($ant){
                echo '
                href="index.php?action=supinformecli01&idmes='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$ant.'"';
                } else {
                  echo 'href="#"';
                }
                
                ?>
                ><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
               <div class="col-md-3 tituloSupBotones" ><a 
                 <?php
                 if ($sig){
                echo '
                href="index.php?action=supinformecli01&idmes='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$sig.'"';
                } else {
                  echo 'href="#"';
                }
                ?>
                ><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
               <div class="col-md-3 tituloSupBotones" ><a 
                 <?php
                 if ($last){    
                 echo ' 
                href="index.php?action=supinformecli01&idmes='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$last.'"';
                } else {
                  echo 'href="#"';
                }
                ?>
                ><img src="Views/dist/img/Avanza-Final.jpg"></a>
                </div>
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">TIENDA:
      </div>
      <div class="col-md-2 labelAzulDato">
       <?php
        echo $nomtien;
        ?>   
      </div>
      <div class="col-md-1 labelAzul1">ID TIENDA:
      </div>
      <div class="col-md-2 labelAzulDato">
        <?php
        echo $idtien;
        ?>   
      </div>
      <div class="col-md-1 labelAzul1">FECHA:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php
        echo $fecrep;
        ?>
      </div>
      <div class="col-md-1 labelAzul1">HORA:
      </div>
      <div class="col-md-1 labelAzulDato">
        <?php
        echo $horrep;
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">RECOLECTOR:
      </div>
      <div class="col-md-2 labelAzulDato">
        <?php
        echo $nomrec;
        ?>
      </div>
      <div class="col-md-1 labelAzul1">ID INFORME:
      </div>
      <div class="col-md-2 labelAzulDato">
        <?php
        echo $idinf;
        ?>
      </div>
      <div class="col-md-1 labelAzul1">COMENTARIOS:
      </div>
      <div class="col-md-5 labelAzulDato">
        <?php
        echo $coment;
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 areaImagen areaScrollP2">
      <div class="carousel slide" id="carousel-920444" data-interval="0">

<div class="carousel-inner">
  <div class="carousel-item active">
        <img class="d-block w-100"  src=
        <?php
            $img=$server.$dirimg.'/'.$idprodex;
            echo $img; 
        ?>
        />
      </div>

      <div class="carousel-item">
        <img class="d-block w-100"  src=
<?php
            $img2=$server.$dirimg.'/'.$idticket;
          echo $img2;
        ?>
         />
      </div>
  </div> 	
  <a class="carousel-control-prev" href="#carousel-920444" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="sr-only">Anterior</span></a>
  <a class="carousel-control-next" href="#carousel-920444" data-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="sr-only">Siguiente</span></a>
</div>
</div>
      <div class="col-md-6 areaImagenDer areaScrollP2">
      <img class="img-fluid"   src=
 <?php 
        $img2=$server.$dirimg.'/'.$idticket;
          echo $img2;
      ?> 
      />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">

      <div class="col-md-2 areaBoton" > 
    <?php
      if ($opcsel==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
 echo '
      <a href="#" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">CORREGIR</a>';
   
    ?> 
        
      </div>

      
      <div class="col-md-2 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">CANCELAR</a>
      </div>
      <div class="col-md-2 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">ACEPTAR</a>
      </div>
      <div class="col-md-6 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">ACTUALIZAR</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
</div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario">¿VENDEN PRODUCTOS DE LA MARCA EN LA TIENDA VISITADA?
      </div>
      <div class="col-md-1 areaBoton" ><a href="#" class="btn btn-informes btn-sm btn-block ">SI</a>
      </div>
      <div class="col-md-1 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">NO</a>
      </div>
      <div class="col-md-4 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">NO HAY SUFICIENTE EVIDENCIA</a>
      </div>
    </div>


<!-- /.formulario modal para corregir foto-->
        <div class="modal fade" id="modal-correccion">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">CORREGIR POR</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            


            <form role="form" method="post" action=

        <?php
              echo '
    
              "index.php?action=supinformecli01&pan=1&admin=cor&est=1&eta=2&indice='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$idinf.'"';
            ?>
              >
              
              <p> Escribe el motivo de corrección</p>
              <input type="text"  name="observ" id="observ" style="width: 450px;">
              <p>  </p>

              <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 </div>


