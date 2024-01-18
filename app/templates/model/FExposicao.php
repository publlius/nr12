<?php

class FExposicao extends TRecord
{
    const TABLENAME  = 'f_exposicao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('classificacao');
        parent::addAttribute('frequencia');
            
    }

    /**
     * Method getPontos
     */
    public function getPontos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('f_exposicao_id', '=', $this->id));
        return Ponto::getObjects( $criteria );
    }

    
}

