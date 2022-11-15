<?php

/***ayuda a saber el equivalente de las columnas en el json que viene de la app
 * son las columnas de las tablas de la app
 * @author Marisol
 *
 */
class ContratoInformes {
   
    const  ID="id";
    
    const VISITASID="visitasId";
    const CONSECUTIVO="consecutivo";
    const PRIMERAMUESTRA="primeraMuestra";
    const SEGUNDAMUESTRA="segundaMuestra";
    const TERCERAMUESTRA="terceraMuestra";
    const PLANTASID="plantasId";
  
   
    const CLIENTESID="clientesId";
    
    const COMENTARIOS="comentarios";
    const TICKETCOMPRA="ticket_compra";
    const CONDICIONESTRASLADO="condiciones_traslado";
    const CAUSANOCOMPRA="causa_nocompra";
    
    
  
    const ESTATUS="estatus";
  
    
}

class ContratoInformesDet {
 
    const  ID="id";
    
    
    const INFORMESID="informesId";
  
    
    const  PRODUCTOID="productoId";
    const  PRODUCTO ="producto";
    const  TAMANIOID="tamanioId";
  
    const  EMPAQUESID="empaquesId";
    const CODIGO="codigo";
    const CADUCIDAD="caducidad";
    
    const  ORIGEN="origen";
    const  COSTO="costo";
    const  FOTOCODIGOPROD="foto_codigo_produccion";
    const  ENERGIA="energia";
    const  PRODUCTOEX="producto_exhibido";
    const  FOTONUMTIENDA="foto_num_tienda";
    const  MARCATRAS="marca_traslape";
    const  ATRIBUTOA="atributoa";
    const  FOTOATRA="foto_atributoa";
    const  ATRIBUTOB="atributob";
    const  FOTOATRB="foto_atributob";
    const  ATRIBUTOC="atributoc";
    const  FOTOATRC="foto_atributoc";
    const  AZUCARES="azucares";
    const  QR="qr";
    const  ETIQUETAEVAL="etiqueta_evaluacion";
    const  TIPOMUESTR="tipoMuestra";
    
    const  TIPOANA="tipoAnalisis";
    
    const  NUMMUESTRA="numMuestra";
    
    const  COMENT="comentarios";
    const  COMPRASID="comprasId";
    const  COMPRASDETID="comprasDetId";
    
    const  CREATEDAT="createdAt";
    const  SIGLASPROD="siglas";
    const  UPDATEDAT="updatedAt";
    const ESTATUS="estatus";
    const  COMPRASIDBU="comprasIdbu";
    const COMPRASDETIDBU="comprasDetIdbu";
      
    
}


class ContratoVisitas{
    
    const  ID="id";
    const INDICE="indice";
    
    const PAISID="paisId";
    const TIENDAID="tiendaId";
    const TIENDANOMBRE="tiendaNombre";
    const CIUDADID="ciudadId";
    const CVEUSUARIO="claveUsuario";
    const COMPLEMENTODIR="complementodireccion";
    const  CREATEDAT="createdAt";
    
    const  UPDATEDAT="updatedAt";
    const  ESTATUS="estatus";
    const FOTOFACHADA="fotoFachada";
    const GEOLOCALIZACION="geolocalizacion";
    const DIRECCION="direccion";
    const TIPOTIENDAID="tipoId";
    const PUNTOCARDINAL="puntoCardinal";
    
    
}
class ContratoImagenes{
    
    const  ID="id";
    const DESCRIPCION="descripcion";
    
    const ESTATUS="estatus";
    const RUTA="ruta";
   
    
}
class ContratoUneImagenes{
    
    const  ID="ui_id";
    const UNEID="ui_uneid";
    const CLIENTEID="ui_clienteid";
    const TICKET="ui_ticket";
    const EXHIBIDOR="ui_exhibidor";
    const EXINDICE="ui_exindice";
    const TIKINDICE="ui_tikindice";
    const EXRECOLECTOR="ui_exrecolector";
    const TIKRECOLECTOR="ui_tikrecolector";
    
    
}
class ContratoProductoEx{
    
    const  ID="id";
    const VISITASID="visitasId";
    
    const IMAGENID="imagenId";
    const CLIENTESID="clienteId";
   
    
    
    
}
class ContratoSupValidacion{
    const  ID= "id"; //val_id
const INFORMESID= "informesId";
const  PLANTASID="plantasId";
const  PLANTANOMBRE="plantaNombre";
const  CLIENTESID="clientesId";
const  CLIENTENOMBRE="clienteNombre";
const  INDICE="indice";
const  NOMBRETIENDA="nombreTienda";
const  DESCRIPCIONFOTO="descripcionFoto";
const  DESCRIPCIONID="descripcionId";
const  NUMFOTO="numFoto"; //para inf etapa será el id del detalle, para compra el id de imagendet
const  MOTIVO="motivo";
const  TOTALFOTOS="total_fotos";
const  ETAPA="etapa";
const  ESTATUS="estatus";
const  ESTATUSSYNC="estatusSync";

const CREATEDAT= "createdAt";
}

class ContratoCorreccion{
    
    const  ID="id";
   
    const VALID="solicitudId";
    const  CREATEDAT="createdAt";
 
    const  ESTATUS="estatus";
    const RUTAFOTO1="ruta_foto1";
    const RUTAFOTO2="ruta_foto2";
    const RUTAFOTO3="ruta_foto3";
   const NUMFOTO="numfoto";
    
    
}

class ContratoInfEtapa {
    
    const  ID="id";
   const PLANTASID="plantasId";
   const CLIENTESID="clientesId";
   const INDICE="indice";
  const ETAPA="etapa";
      
    const COMENTARIOS="comentarios";
    const TOTALCAJAS="total_cajas";
    const TOTALMUESTRAS="total_muestras";
    const CAUSANOCOMPRA="causa_nocompra";
    
    const CREATEDAT= "createdAt";
    
    

    
    
}
class ContratoInfEtapaDet {
    
    const  ID="id";
   
    const INFETAPAID="informeEtapaId";
    const ETAPA="etapa";
    const RUTAFOTO="ruta_foto";
    const QR="qr";
    const NUMMUESTRA="num_muestra";
    const DESCRIPCIONID="descripcionId";   
    const NUMCAJA="num_caja";
    
    
    
}

