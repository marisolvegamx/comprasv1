 <script type="text/javascript" src="js/MEScomboboxunineg_nu.js"></script>
<script type="text/javascript" language="javascript1.1">
function Validar(form){

	

	if(form.grupo.value=='cli' || form.grupo.value == 'muf')
	 {	
	    if(!selectVacio(form.uscliente,'cliente'))return false;
	  	
	 
	  if(form.SelectNivel.value==0)
		 {	alert('Por favor, seleccione un nivel de consulta');
		 	form.SelectNivel.focus();
			return false;
		}
	}
	if(form.grupo.value=='cue')
	 {	
	   if(!selectVacio(form.uscliente,'cliente'))return false;
	  	if(!selectVacio(form.usservicio,'servicio'))return false;
	  if(!selectVacio(form.cta,'cuenta'))
		 {	
			return false;
		}
	}
	
	
return true;	

}
function selectVacio(campo, nombre)
{
	
	 if(campo.value=='0'){
		alert("Por favor, seleccione "+nombre);
		campo.focus();
		
		return false;
		}
		return true;
}

function cargaNivel(nvel,accion)
{
	if(accion=="EDITAR")
	 
	document.form1.action="index.php?action=snuevousuario&nuevo=E&nvel="+nvel.value;
	else
		document.form1.action="index.php?action=snuevousuario&nvel="+nvel.value;
	
	//document.form1.action="MESprincipal.php?op=Bgrup&admin=usuarios&nuevo=S&id="+id+"&nvel="+nvel.value;
	document.form1.target="_self";
	document.form1.submit();
}
function cargaContenidoCliente(a)
{
	if(a>0){
	var parametro={"claclien":a};

	$.ajax({
		data:parametro,
	url:"comboboxclienteserv.php",
	type:"post",
	beforeSend:function(){
		$("#idserv").html("cargando...");
	},
	success:function(response){
		$("#idserv").append("<option value='0'>- TODOS -</option>");
		$("#idserv").append(response);
	}
	});
	}else
	{	
		$("#idserv").html("cargando...");
		$("#idserv").append("<option value='0'>- TODOS -</option>");
	}
}

function cargaOpciones(nvel)
{
	
document.getElementById('gpo_cliente').style.display='none';
	document.getElementById('gpo_cuenta').style.display='none';
	
	if(nvel=='cli' || nvel=='muf')
	{	
		document.getElementById('gpo_cliente').style.display='block';
	document.getElementById('gpo_cuenta').style.display='none';
	}
		if(nvel=='lab')
	{	
		document.getElementById('gpo_cliente').style.display='block';
	document.getElementById('gpo_cuenta').style.display='none';
	}
	if(nvel=='cue')
	{
		document.getElementById('gpo_cliente').style.display='none';
	document.getElementById('gpo_cuenta').style.display='block';
	}
}

function cargaContenidoServ(clave, campo,accion)
{
		//algo = Request.Querystring(op) 
		if(accion=="EDITAR")
	document.form1.action="index.php?action=snuevousuario&nuevo=E";
		else
			document.form1.action="index.php?action=snuevousuario";
		
	document.form1.target="_self";
	document.form1.submit();
	
}
function validarEmail(email) 
{ 
 var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ 
 return email.match(re) 
}
</script>
<?php include 'Controllers/usuarioPermisosController.php';

$usuarioCon= new UsuarioPermisosController();
$usuarioCon->vistaNuevoUsuario();
?>
<section class="content-header">

<h1>USUARIOS</h1>
<h1><?php echo $usuarioCon->getTITULO5()?></h1>

</section>
  <section class="content container-fluid">
<form name="form1" method="post" action="index.php?action=slistausuarios&id=<?php echo $usuarioCon->getOp()?>&admin=<?php echo $usuarioCon->getAccion()?>&nivel=<?php $usuarioCon->getNV()?>" onsubmit="return Validar(this); ">
<div class="box box-info">
      <div class="box-header with-border">

<h3 class="box-title"><?php echo $usuarioCon->getAccion()?> USUARIO</h3>
     </div>
   <div class="box-body">
   <div class="form-group col-md-6">
                  <label>NOMBRE DEL EMPLEADO :</label>
       
          <input name="nomusu" type="text" class="form-control"  id="nomusu" value="<?php echo $usuarioCon->getUsuario()['nombre']?>" size="35" maxlength="40" required />
        </div>
 
        <div class="form-group col-md-6">
                 
       <input name="clagrup" type="hidden" value="<?php echo $usuarioCon->getOp()?>" disabled="disabled" />
          <input  class="form-control"type="hidden" name="login" type="text" id="login" value="<?php echo $usuarioCon->getUsuario()['log']?>" size="35" maxlength="20" />
           <input name="grupo" id="grupo" type="hidden" value="<?php echo $usuarioCon->getOp()?>" />
           <input name="login_ant" type="hidden" id="login_ant" value="<?php echo $usuarioCon->getUsuario()['login_ant']?>"  />
       
                  <label>CONTRASE&Ntilde;A :</label>
       
          <input name="contras" type="text" class="form-control"  id="contras" value="<?php  echo $usuarioCon->getUsuario()['pass']?>" size="35" maxlength="20" required/>
        </div>
   
   
       <div class="form-group col-md-6">
                  <label>CARGO :</label>
      
          <input name="cargo" type="text" class="form-control"  id="cargo" value="<?php echo $usuarioCon->getUsuario()['carg']?>" size="35" maxlength="40" />
        </div>
    
      <div class="form-group col-md-6">
                  <label>TELEFONO :</label>
        
          <input name="tel" type="text" class="form-control"  id="tel" value="<?php echo $usuarioCon->getUsuario()['tele']?>" size="35" maxlength="40" />
        </div>
     
      <div class="form-group col-md-6">
                  <label>EMAIL :</label>
        
          <input name="email" type="email" class="form-control"  id="email" value="<?php echo $usuarioCon->getUsuario()['correo']?>" size="35" maxlength="40" required />
        </div>
     
  
  
  </div>
  <div class="box-footer col-md-12">
                 
      <button class="btn btn-default pull-right" style="margin-left: 10px" type="button"  onclick="document.location='index.php?action=slistausuarios&id=<?php echo $usuarioCon->getOp()?>';"  >CANCELAR</button>
     <button type="submit" class="btn btn-info pull-right">GUARDAR</button>
   </div>
 </div>
 
</form>
</section>
<script type="text/javascript">
  cargaOpciones('<?php echo $usuarioCon->getOp()?>');
 /* if(document.getElementById('grupo').value=='ext'&&document.getElementById('tipo_usu').value!='')
  	cargaNivel1({tipo_usu});*/
  </script>
  <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="js/jquery.cascading-drop-down.js"></script>

<script>



    $('.cascada').ssdCascadingDropDown({

        nonFinalCallback: function (trigger, props, data, self) {



            trigger.closest('form')

                    .find('input[type="submit"]')

                    .attr('disabled', true);



        },

        finalCallback: function (trigger, props, data) {



            if (props.isValueEmpty()) {

                trigger.closest('form')

                        .find('input[type="submit"]')

                        .attr('disabled', true);

            } else {

                trigger.closest('form')

                        .find('input[type="submit"]')

                        .attr('disabled', false);

            }



        }

    });

</script>