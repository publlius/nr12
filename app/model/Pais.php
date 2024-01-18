<?php

class Pais extends TRecord
{
    const TABLENAME  = 'pais';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('sigla');
            
    }

    /**
     * Method getEmpresaUnidades
     */
    public function getEmpresaUnidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pais_id', '=', $this->id));
        return EmpresaUnidade::getObjects( $criteria );
    }
    /**
     * Method getEstados
     */
    public function getEstados()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pais_id', '=', $this->id));
        return Estado::getObjects( $criteria );
    }

    
}

