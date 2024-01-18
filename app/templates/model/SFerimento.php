<?php

class SFerimento extends TRecord
{
    const TABLENAME  = 's_ferimento';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('classificacao');
        parent::addAttribute('severidade');
            
    }

    /**
     * Method getPontos
     */
    public function getPontos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('s_ferimento_id', '=', $this->id));
        return Ponto::getObjects( $criteria );
    }

    
}

