<?php

class PEvitarPerigo extends TRecord
{
    const TABLENAME  = 'p_evitar_perigo';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('classificacao');
        parent::addAttribute('possibilidade_evitar');
            
    }

    /**
     * Method getPontos
     */
    public function getPontos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('p_evitar_perigo_id', '=', $this->id));
        return Ponto::getObjects( $criteria );
    }

    
}

