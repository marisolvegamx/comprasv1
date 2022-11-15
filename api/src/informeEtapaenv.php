<?php
namespace api\src;

 class InformeEtapaEnv {
   
     public  $informeEtapa;
     public  $informeEtapaDet; //es un arreglo
     public  $detalleCaja; //es un arreglo
     public $imagendetalle; //es un arreglo
   

    /**
     * @return mixed
     */
    public function getImagendetalle()
    {
        return $this->imagendetalle;
    }

    /**
     * @param mixed $imagendetalle
     */
    public function setImagendetalle($imagendetalle)
    {
        $this->imagendetalle = $imagendetalle;
    }

    /**
     * @return mixed
     */
    public function getInformeEtapa()
    {
        return $this->informeEtapa;
    }

    /**
     * @return mixed
     */
    public function getInformeEtapaDet()
    {
        return $this->informeEtapaDet;
    }

    /**
     * @return mixed
     */
    public function getDetalleCaja()
    {
        return $this->detalleCaja;
    }

  

    /**
     * @param mixed $informeEtapa
     */
    public function setInformeEtapa($informeEtapa)
    {
        $this->informeEtapa = $informeEtapa;
    }

    /**
     * @param mixed $informeEtapaDet
     */
    public function setInformeEtapaDet($informeEtapaDet)
    {
        $this->informeEtapaDet = $informeEtapaDet;
    }

    /**
     * @param mixed $detalleCaja
     */
    public function setDetalleCaja($detalleCaja)
    {
        $this->detalleCaja = $detalleCaja;
    }
    
    

    
   
}

