<?php
namespace api\src;

 class InformeEnvio {
    public /*Visita*/ $visita; //todos son arreglos
    public  $informeCompra;
    public  $informeCompraDetalles; //es un arreglo
    public  $imagenDetalles; //es un arreglo
    public  $productosEx; //es un arreglo
    
    public function getVisita() {
        return $this->visita;
    }
    
    public function setVisita($visita) {
        $this->visita = $visita;
    }
    
    public function getInformeCompra() {
        return $this->informeCompra;
    }
    
    public function setInformeCompra($informeCompra) {
        $this->informeCompra = $informeCompra;
    }
    
    public  function getInformeCompraDetalles() {
        return $this->informeCompraDetalles;
    }
    
    public function setInformeCompraDetalles($informeCompraDetalles) {
        $this->informeCompraDetalles = $informeCompraDetalles;
    }
    
    public function getImagenDetalles() {
        return $this->imagenDetalles;
    }
    
    public function setImagenDetalles($imagenDetalles) {
        $this->imagenDetalles = $imagenDetalles;
    }
    
    public  function getProductosEx() {
        return $this->productosEx;
    }
    
    public function setProductosEx($productosEx) {
        $this->productosEx = $productosEx;
    }
  /*  public function toJson($informe) {
        //  $this->inf_visitasIdlocal=informe.getVisitasId();
        $sdf = "yyyy-MM-dd hh:mm:ss";
        
        
        
        //  Gson gson = new Gson();
        $informejson=gson.toJson(informe.informeCompra);
        $JSON = gson.toJson(informe);
        return  $JSON;
        
    }*/
}

