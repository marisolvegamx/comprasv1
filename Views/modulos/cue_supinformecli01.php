<?php

        $informeCont=new SupInfmuestraController();
        $informeCont->vistaSupInfMuesController();
        $dirimg= $informeCont->getdirimg();
        $idimg= $informeCont->getidimg();
        $idticket= $informeCont->getidticket();
        $idprodex= $informeCont->getidprodex();
        $nomticket= $informeCont->getnomtick();
        $nomprodex= $informeCont->getnomprodex();
        //var_dump($nomprodex);
        $nomprodexc= $informeCont->getnompexc();
        $idplanta= $informeCont->getidplanta();
        //var_dump($nomprodexc);
        $server="/comprasv1/fotografias/";
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
        $opcsel = $informeCont->getopcsel();
        $stimg = $informeCont->getestfot();
        $nomciudad= $informeCont->getnomciu();
        $idsup= $informeCont->getidsup();
        $causaNOC= $informeCont->getcausaNOC();
        $NomcausaNOC= $informeCont->getNomcausaNOC();
        //var_dump($idsup);
       
        include "Utilerias/leevar.php";
        if ($admin=="cor"){
            $informeCont->noaceptarprodex(); 
          } else if ($admin=="aceptar"){
            $informeCont->aceptarsec();   
          } else if ($admin=="act"){
            $informeCont->actualizacom();   
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
                <div class="col-md-3 tituloSupBotones" ><a 
                href="index.php?action=suplistatiendas&admin=li&idmes='.$idmes.'&idsup='.$idsup.'&idciu='.$nomciudad.'&eta=2"><img src="Views/dist/img/retroceder-lista.jpg"></a>

                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli01&idmes='.$idmes.'&idrec='.$idrec.'&idsup='.$idsup.'&id='.$idinf.'&cli='.$idcli.'&sec='.$sec.'&eta=2"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&idsup='.$idsup.'&cli='.$idcli.'&nummues=1&pan=5&eta=2"><img src="Views/dist/img/Avanza-1.jpg"></a>
                  


                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&idsup='.$idsup.'&cli='.$idcli.'&sec='.$sec.'&nummues=1&pan=9&eta=2"><img src="Views/dist/img/Avanza-Final.jpg"></a>
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
                   href="index.php?action=supinformecli01&idmes='.$idmes.'&idrec='.$idrec.'&id='.$first.'&cli='.$idcli.'&sec='.$sec.'&eta=2&idsup='.$idsup.'"';
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
                    href="index.php?action=supinformecli01&idmes='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$ant.'&sec='.$sec.'&eta=2&idsup='.$idsup.'"';
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
                href="index.php?action=supinformecli01&idmes='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$sig.'&sec='.$sec.'&eta=2&idsup='.$idsup.'"';
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
                href="index.php?action=supinformecli01&idmes='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$last.'&sec='.$sec.'&eta=2&idsup='.$idsup.'"';
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

      <div class="col-md-1 labelAzul1">¿SE COMPRO?    </div>
      <div class="col-md-5 labelAzulDato">
      <?php
         if ($causaNOC) {
            echo "NO";
         } else {
            echo "SI";
         }
        ?>  
        
      </div>
    </div>
     <?php 
        //$admin="edI";
          if ($admin=="edI"){
             echo '<form role="form" method="post" action="index.php?action=supinformecli01&admin=act">';
          }   
         ?>
     
    <div class="row">
      <div class="col-md-1 labelAzul1">CAUSA:     </div>
      <div class="col-md-2 labelAzulDato">
      <?php
         if ($causaNOC) {
            echo $NomcausaNOC;
         } else {
            echo "";
         }
        ?>

            </div>
    
        

      
      <div class="col-md-1 labelAzul1">COMENTARIOS:     </div>
      <div class="col-md-8 labelAzulDato">
          <?php
        if ($admin=="edI"){

           echo '<input class="form-control form-control-informes" type="text" placeholder="" id="coment" name="coment" value="'.$coment.'">';

           echo '
                 <input type="hidden" name="id" id="id" value="'.$id.'">
                 <input type="hidden" name="indice" id="idmes" value="'.$idmes.'">
                 <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">
                 <input type="hidden" name="idcli" id="idrec" value="'.$idcli.'">
                 <input type="hidden" name="idplan" id="idplan" value="'.$idplanta.'">';
        }else{  
        echo $coment;
        }
        ?>
      </div>
    </div>
     <div class="row">
      <div class="col-md-12 areaBotonDer">
       <?php 
        if ($admin=="edI"){
          echo '    
          <button type="submit" class="btn btn-informes btn-sm btn-block">Guardar</button>';

        } else {
             echo '
            <a href="index.php?action=supinformecli01&admin=edI&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idinf.'&cli='.$idcli.'&numpant='.$numpant.'&nummues='.$nummues.'" class="btn btn-informes btn-sm btn-block ">EDITAR</a>';
        } 
        ?>
      </div>
           <?php 
        //$admin="edI";
          if ($admin=="edI"){
             echo '</form>';
          }   
         ?>     
   
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 areaImagen areaScrollP4">
      <div>
         <div> 
          <div class="img-magnifier-container ">
           <img id="myimage" class="d-block w-100"  src=
            <?php
                if ($nomprodex) {
                   $img1=$server.$dirimg.'/'.$nomprodex;
                   echo $img1; 
              } else {
                echo '"Views/dist/img/sin-foto.jpg"';
              }
            ?>
            />
          </div>
          <div style="height: 100px"></div>
            <div class="img-magnifier-container ">
                <img id="myimage2" class="d-block w-100"  src= <?php
        //      $idprodex="IMG_4_20220221_132038.jpg";
                if ($nomticket) {
                   $img=$server.$dirimg.'/'.$nomticket;
                   echo $img; 
                 } else {
                   echo '"Views/dist/img/sin-foto.jpg"';
                 }
            ?>
                 />
            </div>
          </div>  
      </div>
    </div>

      <div class="col-md-6 areaImagenDer areaScrollP4  img-magnifier-container">
      <img id="myimage3" class="w-100" src=
 <?php 
      // $idticket2="IMG_4_20220221_132144.jpg";
        if ($nomprodexc) {
        $img2=$server.$dirimg.'/'.$nomprodexc;
          echo $img2;
        } else {
          echo '"Views/dist/img/sin-foto.jpg"';
        }  
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
      if ($stimg==1){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
 echo '
      <a href="#" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">CORREGIR</a>';
   
    ?> 
        
      </div>

      
      <div class="col-md-2 areaBoton"><a href=
          <?php
           if ($stimg==2){
              $clase= "btn-informesActivado";
           } else {
              $clase= "btn-informes";
           }
        echo '
              "index.php?action=supinformecli01&pan=1&admin=cor&est=2&eta=2&indice='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$idinf.'&img='.$idimg.'" class="btn '.$clase. ' btn-sm btn-block "';
        ?>        
               >CANCELAR</a>
      </div>
      <div class="col-md-2 areaBoton"><a href=
<?php
           if ($stimg==3){
              $clase= "btn-informesActivado";
           } else {
              $clase= "btn-informes";
           }
        echo '
              "index.php?action=supinformecli01&pan=1&admin=cor&est=3&eta=2&indice='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$idinf.'&img='.$idimg.'" class="btn '.$clase. ' btn-sm btn-block " class="btn '.$clase.' btn-sm btn-block "';
        ?>

        >ACEPTAR</a>
      </div>
      <div class="col-md-6 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">ACTUALIZAR</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
</div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario">¿HAY EVIDENCIA DE QUE VENDEN PRODUCTOS DE LA MARCA EN LA TIENDA VISITADA?
      </div>
      <div class="col-md-2 areaBoton" >
      <?php 
       if ($opcsel==1){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }

      $href= '
        <a href="index.php?action=supinformecli01&admin=aceptar&pan=1&indice='.$idmes.'&idrec='.$idrec.'&cli='.$idcli.'&id='.$idinf.'&sec=4&eta=2&acep=1&noa=0"';

       echo $href.' class="btn '.$clase.' btn-sm btn-block ">SI</a>';
       
      ?>

      </div>
      <div class="col-md-2 areaBoton">
      <?php 

       if ($opcsel==3){
          $clasen= "btn-informesActivado";
          
      } else {
        $clasen= "btn-informes";
          }
       $hrefn= '
        <a href="index.php?action=supinformecli01&admin=aceptar&pan=1&indice='.$idmes.'&idrec='.$idrec.'&cli='.$idcli.'&id='.$idinf.'&sec=4&eta=2&acep=0&noa=0"';

       echo $hrefn.' class="btn '.$clasen.' btn-sm btn-block ">NO</a>';
      
      ?>
       
      </div>
      <div class="col-md-2 areaBoton">
          <?php 

       if ($opcsel==2){
          $clasen= "btn-informesActivado";
          
      } else {
        $clasen= "btn-informes";
          }
       $hrefn= '
        <a href="index.php?action=supinformecli01&admin=aceptar&pan=1&indice='.$idmes.'&idrec='.$idrec.'&cli='.$idcli.'&id='.$idinf.'&sec=4&eta=2&acep=0&noa=1"';

       echo $hrefn.' class="btn '.$clasen.' btn-sm btn-block "> NO APLICA </a>';
      
      ?>
        
      </div>
    </div>


<!-- /.formulario modal para corregir foto-->
        <div class="modal fade" id="modal-correccion">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">CORREGIR</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            


            <form role="form" method="post" action=

        <?php
              echo '
              "index.php?action=supinformecli01&pan=1&admin=cor&est=1&eta=2&indice='.$idmes.'&cli='.$idcli.'&idrec='.$idrec.'&id='.$idinf.'&img='.$idimg.'"';
            ?>
              >
              
              <p> Escribe el motivo de corrección</p>
              <input type="text"  name="observ" id="observ" style="width: 450px;">
              <p>  </p>

              <button type="submit" class="btn btn-primary">Enviar</button>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 </div>

<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage", 2);
</script>
<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage2", 2);
</script>
<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage3", 2);
</script>
