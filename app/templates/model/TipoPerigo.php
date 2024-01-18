<?php

class TipoPerigo extends TRecord
{
    const TABLENAME  = 'tipo_perigo';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_perigo');
            
    }

    /**
     * Method getPontoRiscos
     */
    public function getPontoRiscos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_perigo_id', '=', $this->id));
        return PontoRisco::getObjects( $criteria );
    }
    /**
     * Method getPontoPerigos
     */
    public function getPontoPerigos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_perigo_id', '=', $this->id));
        return PontoPerigo::getObjects( $criteria );
    }
    /**
     * Method getRiscos
     */
    public function getRiscos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_perigo_id', '=', $this->id));
        return Risco::getObjects( $criteria );
    }
    /**
     * Method getPerigos
     */
    public function getPerigos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_perigo_id', '=', $this->id));
        return Perigo::getObjects( $criteria );
    }

    
}

