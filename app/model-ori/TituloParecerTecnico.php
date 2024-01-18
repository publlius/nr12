<?php

class TituloParecerTecnico extends TRecord
{
    const TABLENAME  = 'titulo_parecer_tecnico';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('titulo_parecer_tecnico');
            
    }

    /**
     * Method getItemNormas
     */
    public function getItemNormas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('titulo_id', '=', $this->id));
        return ItemNorma::getObjects( $criteria );
    }
    /**
     * Method getPontoParecerTecnicos
     */
    public function getPontoParecerTecnicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('titulo_parecer_tecnico_id', '=', $this->id));
        return PontoParecerTecnico::getObjects( $criteria );
    }

    
}

