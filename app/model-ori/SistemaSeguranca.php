<?php

class SistemaSeguranca extends TRecord
{
    const TABLENAME  = 'sistema_seguranca';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('sistema_seguranca');
            
    }

    /**
     * Method getSistemaSegurancaTipos
     */
    public function getSistemaSegurancaTipos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('sistema_seguranca_id', '=', $this->id));
        return SistemaSegurancaTipo::getObjects( $criteria );
    }
    /**
     * Method getPontoSistemaSegurancas
     */
    public function getPontoSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('sistema_seguranca_id', '=', $this->id));
        return PontoSistemaSeguranca::getObjects( $criteria );
    }

    
}

