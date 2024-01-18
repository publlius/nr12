<?php

class TipoSistemaSeguranca extends TRecord
{
    const TABLENAME  = 'tipo_sistema_seguranca';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_sistema_seguranca');
            
    }

    /**
     * Method getPontoSistemaSegurancas
     */
    public function getPontoSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_sistema_seguranca_id', '=', $this->id));
        return PontoSistemaSeguranca::getObjects( $criteria );
    }
    /**
     * Method getSistemaSegurancas
     */
    public function getSistemaSegurancas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_sistema_seguranca_id', '=', $this->id));
        return SistemaSeguranca::getObjects( $criteria );
    }

    
}

