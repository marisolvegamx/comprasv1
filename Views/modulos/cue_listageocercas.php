

<table>
                <tbody><tr>
                
                  <th style="width: 20%">REGION</th>
                  <th style="width: 10%">BORRAR</th>
                </tr>
              <?php if($geocercaCon->listageo !=null) 
                  foreach($geocercaCon->listageo as $ren ){?>
  <tr>
	                  <td><?php echo $geocercaCon->arrreg[$ren["geo_region"]]?></td>
	                 
	                 
	                 
<td> <a type="button" href="javascript:eliminar(<?php echo $ren["geo_id"] ?>);" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>
	                <?php }?>
					 
               </tbody>
           </table>